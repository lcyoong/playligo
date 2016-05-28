<?php

namespace App\Playligo\Facades;

use Illuminate\Support\Facades\Facade;

class FormErrorFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'formerror';
    }
}
