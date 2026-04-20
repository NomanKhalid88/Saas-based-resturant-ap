<?php

use Illuminate\Support\Str;

if (!function_exists('generateUuidKey')) {
    function generateUuidKey()
    {
        $contractId = strtotime(date('Y-m-d H:i:s')) . '-' . Str::random(4) . '-' . Str::random(6) . '-' . Str::random(8) . '-' . Str::random(10) . '-' . Str::random(12);
        return $contractId;
    }
}
