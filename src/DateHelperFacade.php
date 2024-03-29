<?php
namespace UzzairWebstudio\DateHelper;

use Illuminate\Support\Facades\Facade;

class DateHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'date-helper';
    }
}