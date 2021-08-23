<?php

namespace App\Traits;

trait FormatDate {

    /**
     * This method convert a date of one string
     * @param string $date A date in format string
     * @return string|false Returns a date to the language spanish in format string or return false
     */
    public function convertStringToDate(string $date)
    {
        setLocale(LC_ALL, 'spanish_ecuador.utf-8');
        $myDate = str_replace("/", "-", $date);
        $newDate = date('d-m-Y H:i:s', strtotime($myDate));
        return strftime('%A, %d de %B del %Y a las %T %p', strtotime($newDate));
    }
}
