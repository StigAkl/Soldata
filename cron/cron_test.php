<?php
include_once ("../functions/functions.php");
include_once ("../access/db_connect.php");
/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 14.49
 */



$power = mt_rand();
$energy = mt_rand();
$date = get_datetime();

$db = Db::getInstance();
$sql = "INSERT INTO solar (date, energy, power) VALUES (:date, :energy, :power)";

$stmt = $db->prepare($sql);

$stmt->bindParam(":date", $date->format("Y-m-d H:i:s"));
$stmt->bindParam(":energy", $energy);
$stmt->bindParam(":power", $power);

$stmt->execute();



?>