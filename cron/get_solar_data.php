<?php
include_once ("../functions/functions.php");
include_once ("../access/db_connect.php");

/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 15.22
 */



if($_GET['code'] == "ofaejoefwoijfe") {
    $db = Db::getInstance();
    $start_date = get_start_date($db);
    $start_date = str_replace(" ", "%20", $start_date);

    echo $start_date;
    $end_date = get_datetime()->format("Y-m-d H:i:s");
    $end_date = str_replace(" ", "%20", $end_date);
    $url2 = "https://monitoringapi.solaredge.com/site/278561/energy.json?api_key=87SFOBPSXXAOI3WIUW13NK65GPCUN02A&timeUnit=QUARTER_OF_AN_HOUR&startDate=2017-04-03&endDate=2017-04-04";
    $url3 = "https://monitoringapi.solaredge.com/site/278561/power.json?api_key=87SFOBPSXXAOI3WIUW13NK65GPCUN02A&startTime=" . $start_date . "&endTime=" . $end_date;
    $string = file_get_contents($url3);
    $result = json_decode($string);

    $values = $result->power->values;

    $count = count($values);
    echo "Count: " . $count;
    echo "<br/>";

    $stmt = $db->prepare("INSERT INTO power (value, date) VALUES(:value, :date)");
    $stmt->bindParam(":value", $value);
    $stmt->bindParam(":date", $date);

    for ($x = 0; $x < $count - 1; $x++) {
        $value = $values[$x]->value;
        $date = $values[$x]->date;
        if (empty($value))
            $value = 0.0;

        $stmt->execute();
    }

    set_new_start_date($db, $values[$count - 1]->date);

}
function get_start_date($db) {
    $sql = "SELECT * FROM  cron_job_power WHERE id=1";
    $stmt = $db->prepare($sql);

    $stmt->execute();
    $result = $stmt->fetch();
    return $result['start_date'];
}

function set_new_start_date($db, $start_date) {
    $sql = "UPDATE cron_job_power SET start_date = '$start_date'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}















//
//$db = Db::getInstance();
//$sql = "INSERT INTO solar (date, energy, power) VALUES (:date, :energy, :power)";
//$stmt = $db->prepare($sql);
//
//
//$stmt->bindParam(":date", $date->format("Y-m-d H:i:s"));
//$stmt->bindParam(":energy", $energy);
//$stmt->bindParam(":power", $power);
//$stmt->execute();


?>