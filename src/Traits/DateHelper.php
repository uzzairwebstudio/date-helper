<?php

namespace Uzzaircode\DateHelper\Traits;
use Carbon\Carbon;

trait DateHelper
{

    /**
    * Convert a string or timezone value into date object 
    *
    * @param string $date_format
    * @param string $date_value
    * @return object
    */
    
    public function setDateObject(string $date_format, string $date_value): Carbon
    {
        return Carbon::createFromFormat($date_format, $date_value);
    }
    
    /**     
    * Convert a Carbon date object to desired format
    * 
    * @param Carbon $date
    * @param string $date_format
    * @return string
    */
    
    public function setDateFormat(Carbon $date, string $date_format): string
    {
        
        return $date->format($date_format);
    }

    /**
    * Generate date range given start date and end date as Carbon objects.
    * This function will return array of date objects if no format argument is supplied.
    *
    * @param Carbon $start_date
    * @param Carbon $end_date
    * @return array
    */
    public function generateDateRange(Carbon $start_date, Carbon $end_date,string $date_format = null): array

    {
                
        $dates = [];
        
        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {

            $dates[] = isset($date_format) ? $date->format($date_format) : $date->format('Y-m-d');

        }

        return $dates;

    }    


    /**
     * Return an array of days count given an array of dates in string
     * 
     * e.g: [ 'Tuesday'=> 3, 'Monday'=> 3 ]
     * 
     * @param array $date_array    
     * @return array
     */

    public function countDaysInDateRange(array $dates_array): array
    
    {
        
        return array_count_values($dates_array);
        
    }


}