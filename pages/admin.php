<?php
include_once ("../functions/functions.php");
include_once ("../access/db_connect.php");

/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 15.22
 */

$start_date = DateTime::createFromFormat("Y-m-d", "2017-05-01");
$end_date = DateTime::createFromFormat("Y-m-d", "2017-05-11");

    $db = Db::getInstance();

    //Gjør start_date om til string
    $start_date_str = $start_date->format("Y-m-d");
    $start_date_str = str_replace(" ", "%20", $start_date_str);

    //GJør end_date om til string
    $end_date_str = $end_date->format("Y-m-d");
    $end_date_str = str_replace(" ", "%20", $end_date_str);

    $url = "https://monitoringapi.solaredge.com/site/278561/energy.json?api_key=87SFOBPSXXAOI3WIUW13NK65GPCUN02A&timeUnit=QUARTER_OF_AN_HOUR&startDate=".$start_date_str."&endDate=".$end_date_str;

    $string = file_get_contents($url);
    $result = json_decode($string);

    $values = $result->energy->values;

    $stmt = $db->prepare("INSERT INTO energy (value, date) VALUES(:value, :date)");
    $stmt->bindParam(":value", $value);
    $stmt->bindParam(":date", $date);

    $count = count($values);
    $num_values = 0;
    if($count == 0)
        echo "Count 0";

    for ($x = 0; $x < $count - 1; $x++) {
        $value = $values[$x]->value;
        $date = $values[$x]->date;
        $last_date = $date;

        if (empty($value))
            $value = 0.0;

        $stmt->execute();

        $num_values++;
    }

    echo $num_values . " inserted into energy";
?>