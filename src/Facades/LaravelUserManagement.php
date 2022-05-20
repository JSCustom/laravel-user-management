<?php

namespace JSCustom\LaravelUserManagement\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelUserManagement extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-user-management';
    }
}
?>