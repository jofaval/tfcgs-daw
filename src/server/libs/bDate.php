<?php

class DateUtils
{
    public static function isDateInTime($firstDate, $secondDate = 'now')
    {
        return !(strtotime($firstDate) > strtotime($secondDate));
    }

    public static function addDays($date, $days, $format = "Y-m-d")
    {
        return date($format, strtotime($date . ' + ' . $days . ' days'));
    }

    public static function substractDays($date, $days, $format = "Y-m-d")
    {
        return date($format, strtotime($date . ' - ' . $days . ' days'));
    }

    public static function getCurrentDateTime($format = "Y-m-d H:i:s")
    {
        $date = new DateTime();
        return $date->format($format);
    }

    public static function getAllDatesFromInterval($startingDate, $endingDate)
    {
        $period = new DatePeriod(
            new DateTime($startingDate),
            new DateInterval('P1D'),
            new DateTime($endingDate)
        );

        $dates = [];
        foreach ($period as $key => $value) {
            $dates[] = $value->format('Y-m-d');
        }

        return $dates;
    }

}