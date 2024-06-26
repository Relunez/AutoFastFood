<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ClienteFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ClienteService';
    }
}
