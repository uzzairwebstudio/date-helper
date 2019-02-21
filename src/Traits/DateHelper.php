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
    
    public function setDateObject(string $date_format, string $date_value): object
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
    * Generate date range given start date and end date as Carbon objects
    *
    * @param Carbon $start_date
    * @param Carbon $end_date
    * @return array
    */
    public function generateDateRange(Carbon $start_date, Carbon $end_date): array

    {
                
        $dates = [];

        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {

            $dates[] = $date;

        }

        return $dates;

    }

    /**
     * Convert array of dates to given format. You should use it together with generateDateRange() method since * it return the dates as Carbon objects
     * As for the format, you have to type in the desired string format e.g: 'l' for days full name
     * input  [2019-02-19, 2019-02-20];
     * output ['Tuesday','Wednesday'];
     * 
     * @param array $datesArray
     * @param string $dateFormat
     * @return array
     */
    
    public function formatDateRange(array $dates_array, string $date_format): array
    
    {

        $dates = collect($dates_array);

        $formatted_dates = $new->map(function ($date, $key) {
            return $date->format($date_format);
        });

        return $formatted_dates->toArray();
    }


    /**
     * Return an array of days count given an array of dates
     * 
     * e.g: [ 'Tuesday'=>3, 'Monday'=> 3 ]
     * 
     * @param array $datesArray    
     * @return array
     */

    public function countDaysInDateRange(array $dates_array): array
    
    {
        
        return count_array_values($dates_array);
        
    }


}