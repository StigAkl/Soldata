<?php
/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 14.58
 */


function get_datetime() {
    $now = new DateTime();
    $now->add(new DateInterval("PT2H"));
    return $now; 
}

function validateDate($date, $format = "Y-m-d H:i:s")
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function format_number($number) {
    if(is_numeric($number)) {
        return number_format($number, 2, ",", " ");
    }
    return $number;
}

function get_server_hour_delay() {
    return 2;
}
?>