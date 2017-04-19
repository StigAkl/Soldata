<?php
include_once ("db_connect.php");
/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 14.34
 */

$db = Db::getInstance();

function add()
{
    global $db;
    $now = new DateTime();
    $now->add(new DateInterval("PT2H"));
    $power = 50.0;
    $energy = 42.94;
    $sql = "INSERT INTO solar (date, energy, power) VALUES(:date, :energy, :power)";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":date", $now->format("Y-m-d H:i:s"));
    $stmt->bindParam(":energy", $energy);
    $stmt->bindParam(":power", $power);

    $stmt->execute();
}



?>