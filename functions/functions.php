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
?>