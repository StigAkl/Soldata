<?php
include_once ("db_connect.php");
/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 14.34
 */


$db =  Db::getInstance();

function get_production_now(){
    global $db;
    $sql = "SELECT * FROM power ORDER BY date DESC LIMIT 1;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $last = $stmt->fetch();
    return $last['value'];
}


function get_production_last_week() {

    global $db;

    $d = strtotime("today");
    $start_week = strtotime("last monday midnight",$d);
    $end_week = strtotime("next sunday",$d);
    $start = date("Y-m-d",$start_week);
    $end = date("Y-m-d",$end_week);

    $sql = "SELECT * FROM power WHERE date > '$start' AND date < '$end'";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $week_days = [
        'Mon' => 0,
        'Tue' => 0,
        'Wed' => 0,
        'Thu' => 0,
        'Fri' => 0,
        'Sat' => 0,
        'Sun' => 0
    ];


    while($result = $stmt->fetch()) {
        $datestr = $result['date'];

        $date = DateTime::createFromFormat("Y-m-d H:i:s", $datestr);
        $day = $date->format("D");

        $week_days[$day] = $week_days[$day] + $result['value'];
    }


    return $week_days; 
}

?>