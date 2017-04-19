<?php
/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 15.22
 */

$options = array(
    'http' => array(
        'protocol_version' => '1.0',
        'method' => 'GET'
    )
);

$context = stream_context_create($options);

$url = "https://monitoringapi.solaredge.com/site/278561/power.json?api_key=87SFOBPSXXAOI3WIUW13NK65GPCUN02A&startTime=2017-04-19 15:00:00&endTime=2017-04-19 15:16:00";
$string = file_get_contents($url);
$result = json_decode($string);

echo $result->power;













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