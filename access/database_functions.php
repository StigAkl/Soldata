<?php
include_once ("db_connect.php");
/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 14.34
 */

$connection = TRUE;
$db =  Db::getInstance();

if(!$db)
    $connection = FALSE;

function get_production_now(){
    global $db;
    $sql = "SELECT * FROM power ORDER BY date DESC LIMIT 1;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $last = $stmt->fetch();
    return $last['value'];
}

function get_all_power() {
    global $db;
    $sql = "SELECT * FROM power";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
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


function get_data_month($date_str)
{
    $date = DateTime::createFromFormat("Y-m-d H:i:s", $date_str);

    if (!validateDate($date_str)) {
        $date = get_datetime();
    }

    $month = $date->format("n");
    $year = $date->format("Y");


    global $db;
    $sql = "SELECT  
      SUM(CASE WHEN DAY(date) = 1 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_1, 
      SUM(CASE WHEN DAY(date) = 2 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_2, 
      SUM(CASE WHEN DAY(date) = 3 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_3, 
      SUM(CASE WHEN DAY(date) = 4 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_4, 
      SUM(CASE WHEN DAY(date) = 5 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_5, 
      SUM(CASE WHEN DAY(date) = 6 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_6, 
      SUM(CASE WHEN DAY(date) = 7 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_7, 
      SUM(CASE WHEN DAY(date) = 8 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_8, 
      SUM(CASE WHEN DAY(date) = 9 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_9, 
      SUM(CASE WHEN DAY(date) = 10 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_10, 
      SUM(CASE WHEN DAY(date) = 11 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_11, 
      SUM(CASE WHEN DAY(date) = 12 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_12, 
      SUM(CASE WHEN DAY(date) = 13 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_13, 
      SUM(CASE WHEN DAY(date) = 14 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_14, 
      SUM(CASE WHEN DAY(date) = 15 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_15, 
      SUM(CASE WHEN DAY(date) = 16 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_16, 
      SUM(CASE WHEN DAY(date) = 17 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_17, 
      SUM(CASE WHEN DAY(date) = 18 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_18, 
      SUM(CASE WHEN DAY(date) = 19 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_19, 
      SUM(CASE WHEN DAY(date) = 20 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_20, 
      SUM(CASE WHEN DAY(date) = 21 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_21, 
      SUM(CASE WHEN DAY(date) = 22 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_22, 
      SUM(CASE WHEN DAY(date) = 23 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_23, 
      SUM(CASE WHEN DAY(date) = 24 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_24, 
      SUM(CASE WHEN DAY(date) = 25 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_25, 
      SUM(CASE WHEN DAY(date) = 26 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_26, 
      SUM(CASE WHEN DAY(date) = 27 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_27, 
      SUM(CASE WHEN DAY(date) = 28 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_28, 
      SUM(CASE WHEN DAY(date) = 29 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_29, 
      SUM(CASE WHEN DAY(date) = 30 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_30,
      SUM(CASE WHEN DAY(date) = 31 AND MONTH(date) = $month AND YEAR(date) = $year THEN value END) AS day_31
      FROM power";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

    return $result;
}


/*
 * Return an associative array with all the data for a specific year
 */
function get_power_year($year) {
    $sql = "SELECT * FROM power WHERE YEAR(date) = $year";
    global $db;

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


/*
 * Return date and time for last database update
 */
function last_update() {
    $sql = "SELECT * FROM cron_job_power WHERE id=1";
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

    $date = DateTime::createFromFormat("Y-m-d H:i:s", $result['last_update']);
    return $date->format("d.m H:i:s");
}

function last_date_power() {
    $sql = "SELECT * FROM power ORDER BY date DESC LIMIT 1";
    global $db;

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch();

    return $result['date'];
}

function last_date_energy() {
    $sql = "SELECT * FROM energy ORDER BY date DESC LIMIT 1";
    global $db;

    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetch();

    return $result['date'];
}


?>