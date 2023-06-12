<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index($search = null) {
        try {
            DB::beginTransaction();
            $eventDB = Event::query()
                ->where('status', 'Ativo')->get();

            DB::commit();
            return [
                'status' => 'success',
                'code' => 200,
                'data' => $eventDB
            ];
        }catch(\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'fail',
            ];
        }

    }

    public function find($idEvent = null) {

        try {
            DB::beginTransaction();
            $eventDB = new Event();
            $eventDB = $eventDB->query()->with('tickets')->findOrFail($idEvent)->toArray();

            DB::commit();
            return [
                'status' => 'success',
                'code' => 200,
                'data' => $eventDB
            ];
        }catch(\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'fail',
            ];
        }
    }

    public function updateOrCreate($idEvent = null, $request) {

        if(isset($request['value'])) {
            $request['value'] = (float) str_replace(',', '.', $request['value']);
        }

        $validatorRequest = Validator::make($request, [
            'image' => 'required',
            'description' => 'required',
            'name' => 'required',
            'final_validity' => 'required',
            'initial_validity' => 'required',
            'value' => 'required|numeric',
            'tickets.*' => 'required',
        ], [
            'tickets.*' => 'O valor deve ser preenchido corretamente.'
        ])->validate();

        try {
            DB::beginTransaction();
            $event['name'] = $validatorRequest['name'];
            $event['description'] = $validatorRequest['description'];
            $event['image'] = $validatorRequest['image'];

            $eventDB = new Event();

            if($idEvent) {
                $eventDB = $eventDB->findOrFail($idEvent)->update($event);
            }else {
                $event['initial_validity'] = $validatorRequest['initial_validity'];
                $event['final_validity'] = $validatorRequest['final_validity'];
                $event['value'] = $validatorRequest['value'];

                $origin = date_create($event['initial_validity']);
                $target = date_create($event['final_validity']);
                $interval = date_diff($origin, $target);

                $days =  $interval->format('%a');

                $diference_days = (int)$days + 1;
                $tickets = $request['tickets'];

                $eventDB = $eventDB->create($event);

                $ticketDB = Ticket::query();

                $event_id = $idEvent ?? $eventDB->id;

                for ($i = 0; $i < $diference_days; $i++) {
                    foreach ($tickets as $key => $itemTickets) {
                        for ($j = 0; $j < (int)$itemTickets; $j++) {
                            $itemTicketDB =  [
                                'event_id' => $event_id,
                                'hour' => $key,
//                                'event_date' => $origin->format('Y-m-') . ($origin->format('d')+1),
                            ];
                            $ticketDB->create($itemTicketDB);
                        }

                    }
                }

            }

            DB::commit();
            return [
                'status' => 'success',
                'code' => 200,
                'data' => $eventDB
            ];
        }catch(\Exception $exception) {
            DB::rollBack();

            return [
                'status' => 'fail'
            ];
        }


    }

    public function delete($idEvent = null) {

        try {
            DB::beginTransaction();
            Ticket::query()->where('event_id', $idEvent)->delete();
            $eventDB = Event::query()->findOrFail($idEvent);

            Storage::drive('s3')->delete($eventDB['image']);
            $eventDB->delete();

            if($eventDB) {
                DB::commit();
                return [
                    'status' => 'success',
                ];
            }
        }catch(\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'fail'
            ];
        }
    }

    public function getHours($event_id) {
        $TicketDB = Ticket::query()
            ->where('event_id',$event_id)
            ->where('event_id',$event_id)
            ->whereNull('buy_date')
            ->get()
            ->groupBy('hour')
            ->toArray();

        return [
            'status' => 'success',
            'code' => 200,
            'data' => $TicketDB
        ];
    }

    public function buyTicket($event_id, $request) {
        $validatorRequest = Validator::make($request, [
            'date' => 'required',
            'hour' => 'required',
        ])->validate();

        try {
            DB::beginTransaction();
            $ticket_number = $this->generateNumberTicket($event_id);

            $ticketDB = Ticket::query()
                ->where('event_id', $event_id)
                ->where('hour', $validatorRequest['hour'])
                ->where('buy_date', null)
                ->limit(1);

//            if($ticketDB->count() < $validatorRequest[$key]['quantity']) {
//                return [
//                    'status' => 'error',
//                    'code' => 200,
//                    'data' => false,
//                ];
//            }

            $ticketDB->update([
                'user_id' => Auth::user()->id,
                'buy_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'event_date' => $validatorRequest['date'],
                'ticket_number' => $ticket_number
            ]);

            Mail::to(Auth::user()->email)->send(new SendEmail());
            DB::commit();
            return [
                'status' => 'success',
                'code' => 200,
                'data' => true,
            ];
        }catch(\Exception $exception) {
            DB::rollBack();
            return [
                'status' => 'fail'
            ];
        }



    }

    private function generateNumberTicket($event_id) {
        return((Auth::user()->id * $event_id) + now()->timestamp);
    }
}
