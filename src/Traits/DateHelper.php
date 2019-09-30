<?php

namespace UzzairWebstudio\DateHelper\Traits;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;

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
    public function generateDateRange(Carbon $start_date, Carbon $end_date, string $date_format = null): array

    {

        $dates = [];

        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {

            $dates[] = $date_format != null ? $date->format($date_format) : $date;
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

    /**
     * Return difference of days give n two dates
     * 
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @param bool $includeDates optional: include both dates in the interval
     * @return int
     */

    public function getDaysDifference(Carbon $start_date, Carbon $end_date, bool $includeDates = false): int
    {

        return $includeDates ? Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date))  + 1 : Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date));
    }

    /**
     * Return iterable period of date
     * 
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @param string $interval default=P1D
     * @return array
     */

    public function getDateInterval(Carbon $start_date, Carbon $end_date, string $interval = 'P1D'): iterable
    {
        // include end date to
        $end_date = $end_date->addDay()->setTime(0, 0, 1);

        return new DatePeriod($start_date, new DateInterval($interval), $end_date);
    }

    /**
     * Generate date range given start date and end date as Carbon objects.
     * But with addition of excluding Non working days or holidays
     * 
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @param array $holidays
     * @param array $nonWorkingDays
     * @return array
     */

    public function getDateRangeExcludingHolidaysOrNonWorkingDays(Carbon $start_date, Carbon $end_date, array $holidays = [], array $nonWorkingDays = [], bool $getCount = false)
    {
        // dd($end_date);
        $dates = [];

        $period = $this->getDateInterval($start_date, $end_date);

        foreach ($period as $dt) {

            if (in_array($dt->format('l'), $nonWorkingDays)) {                
                unset($dt);
            } elseif (in_array($dt->format('Y-m-d'), $holidays)) {                
                unset($dt);
            } else {
                $dates[] = $dt;
            }
        }

        return $getCount == true ? collect($dates)->count() : $dates;        
    }


     /**
     * Calculate date range count given start date and end date and exclusion of holidays or non working days. 
     * Return as integers.
     * 
     * 
     * @param Carbon $start_date
     * @param Carbon $end_date
     * @param array $holidays
     * @param array $nonWorkingDays
     * @return array
     */

    public function getDateRangeExcludingHolidaysOrNonWorkingDaysCount(Carbon $start_date, Carbon $end_date, array $holidays = [], array $nonWorkingDays = []): int
    {
        $date_range = $this->getDateRangeExcludingHolidaysOrNonWorkingDays($start_date, $end_date, $holidays, $nonWorkingDays);

        return collect($date_range)->count();
    }
}
