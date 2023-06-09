<?php
use Carbon\Carbon;
if (!function_exists('formart_date')) {
    function formart_datetime($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i');
    }
}

if (!function_exists('formart_date')) {
    function formart_date($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }
}
