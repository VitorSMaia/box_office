<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use App\Models\GroupPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrador',
            'Cliente'
        ];
        $permissions = [
            [
                'name' => 'Usuários',
                'permisssions' => [
                    [
                        'name' => 'list_users',
                        'label' => 'Visualizar usuários'
                    ],
                    [
                        'name' => 'create_users',
                        'label' => 'Inserir usuários'
                    ],
                    [
                        'name' => 'update_users',
                        'label' =>'Atualizar usuários'
                    ],
                    [
                        'name' => 'delete_users',
                        'label' => 'Deletar usuários'
                    ],
                ]
            ],
            [
                'name' => 'Eventos',
                'permisssions' => [
                    [
                        'name' => 'list_events',
                        'label' => 'Visualizar eventos'
                    ],
                    [
                        'name' => 'create_events',
                        'label' => 'Inserir eventos'
                    ],
                    [
                        'name' => 'update_events',
                        'label' =>'Atualizar eventos'
                    ],
                    [
                        'name' => 'delete_events',
                        'label' => 'Deletar eventos'
                    ],
                    [
                        'name' => 'buy_events',
                        'label' => 'Comprar ingresso'
                    ]
                ]
            ],
            [
                'name' => 'Permissões',
                'permisssions' => [
                    [
                        'name' => 'list_permissions',
                        'label' => 'Visualizar permissões'
                    ],
                    [
                        'name' => 'create_permissions',
                        'label' => 'Inserir permissões'
                    ],
                    [
                        'name' => 'update_permissions',
                        'label' =>'Atualizar permissões'
                    ],
                    [
                        'name' => 'delete_permissions',
                        'label' => 'Deletar permissões'
                    ],
                ]
            ],
            [
                'name' => 'Bilhetes',
                'permisssions' => [
                    [
                        'name' => 'list_tickets',
                        'label' => 'Visualizar bilhetes'
                    ],
                ]
            ],

        ];

        foreach ($roles as $key =>  $itemRole) {
            $roleRB = Role::query()->updateOrCreate([
                'name' => $itemRole
            ]);
        }
        foreach ($permissions as $itemPermission) {
            $groupPermissionDB = GroupPermission::query()->updateOrCreate([
                'name' => $itemPermission['name']
            ]);
            foreach ($itemPermission['permisssions'] as $item) {
                Permission::query()->updateOrCreate([
                    'name' => $item['name'],
                    'label' => $item['label'],
                    'guard_name' => 'web',
                    'group_permission_id' => $groupPermissionDB['id']
                ]);
                $role = Role::query()->findOrFail(1);
                $role->givePermissionTo($item['name']);
                if($item['name'] == 'buy_events' || $item['name'] == 'list_tickets' || $item['name'] == 'list_events') {
                    $role = Role::query()->findOrFail(2);
                    $role->givePermissionTo($item['name']);
                }
            }

        }

    }
}
