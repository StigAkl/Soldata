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

function production_today() {
    global $db;
    $start_day = strtotime("today midnight");
    $end_day = strtotime("tomorrow midnight");

    $start = date("Y-m-d H:i:s", $start_day);
    $end = date("Y-m-d H:i:s", $end_day);

    $sql = "SELECT * FROM power WHERE date >= '$start' AND date < '$end'";
    $stmt = $db->prepare($sql);
    $stmt->execute();


    $today_array = [
        "00" => 0,
        "01" => 0,
        "02" => 0,
        "03" => 0,
        "04" => 0,
        "05" => 0,
        "06" => 0,
        "07" => 0,
        "08" => 0,
        "09" => 0,
        "10" => 0,
        "11" => 0,
        "12" => 0,
        "13" => 0,
        "14" => 0,
        "15" => 0,
        "16" => 0,
        "17" => 0,
        "18" => 0,
        "19" => 0,
        "20" => 0,
        "21" => 0,
        "22"=> 0,
        "23" => 0
    ];

    while($result = $stmt->fetch()) {
        $date = DateTime::createFromFormat("Y-m-d H:i:s", $result['date']);
        $h = $date->format("H");

        $today_array[$h] = $today_array[$h] + intval($result['value']);
    }


    return $today_array;
}

function production_at_day($date) {
    global $db;

    //Setter start_date og end_date til samme dag, men setter tidspunkt fra 00:00:00-23:59:59 for å hente ut data for hele dagen

    $start_date = DateTime::createFromFormat("Y-m-d H:i:s", $date);
    $start_date->setTime(0, 0, 0);
    $end_date = DateTime::createFromFormat("Y-m-d H:i:s", $date);
    $end_date->setTime(23, 59, 59);

    //Konverterer DateTime til string
    $start = $start_date->format("Y-m-d H:i:s");
    $end = $end_date->format("Y-m-d H:i:s");

    $sql = "SELECT * FROM power WHERE date >= '$start' AND date < '$end'";
    $stmt = $db->prepare($sql);
    $stmt->execute();


    $today_array = [
        "00" => 0,
        "01" => 0,
        "02" => 0,
        "03" => 0,
        "04" => 0,
        "05" => 0,
        "06" => 0,
        "07" => 0,
        "08" => 0,
        "09" => 0,
        "10" => 0,
        "11" => 0,
        "12" => 0,
        "13" => 0,
        "14" => 0,
        "15" => 0,
        "16" => 0,
        "17" => 0,
        "18" => 0,
        "19" => 0,
        "20" => 0,
        "21" => 0,
        "22"=> 0,
        "23" => 0
    ];

    while($result = $stmt->fetch()) {
        $date = DateTime::createFromFormat("Y-m-d H:i:s", $result['date']);
        $h = $date->format("H");

        $today_array[$h] = $today_array[$h] + intval($result['value']);
    }


    return $today_array;
}
?>