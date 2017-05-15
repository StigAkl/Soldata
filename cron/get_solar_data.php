<?php
include_once ("../functions/functions.php");
include_once ("../access/database_functions.php");

/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 15.22
 */



if($_GET['code'] == "ofaejoefwoijfe") {

    $db = Db::getInstance();
    $start_date = get_start_date($db);

    //Error oppstått her skal logges i /error/err_log.txt
    ini_set("error_log", dirname(__FILE__) . "/error/err_log.txt");
    if(!validateDate($start_date, "Y-m-d H:i:s")) {
        echo "invalid2: " . $start_date;
        $start_date = last_date_power();
        $start_date_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $start_date);
        //Legger til 15 minutter slik at startintervallet blir de neste 15 minuttene etter siste tidstempel
        $start_date_datetime->add(new DateInterval("PT15M"));
        $start_date = $start_date_datetime->format("Y-m-d H:i:s");
    }

    $start_date = str_replace(" ", "%20", $start_date);
    $end_date = get_datetime()->format("Y-m-d H:i:s");
    $end_date = str_replace(" ", "%20", $end_date);

    //Request URL
    $url3 = "https://monitoringapi.solaredge.com/site/278561/power.json?api_key=87SFOBPSXXAOI3WIUW13NK65GPCUN02A&startTime=" . $start_date . "&endTime=" . $end_date;
    $string = file_get_contents($url3);

    //Hvis file_get_contents feiler, send epost til admin.
    if(!$string) {
        $error = error_get_last();
        error_log("[".date("Y-m-d H:i:s") . "]: " . $error['message'] . "Type: " . $error['type'] . "\nFile: " . $error['file'] . "\nLine: " . $error['line'], 1, $ADMIN_EMAIL,
            "Subject: Cronjob Power: file_get_contents failed");
        exit();
    }

    $result = json_decode($string);

    //Hvis json-decodingen går galt, send epost til admin
    if(json_last_error() != JSON_ERROR_NONE) {
        $error = error_get_last();
        error_log("[".date("Y-m-d H:i:s") . "]: " . $error['message'] . "Type: " . $error['type'] . "\nFile: " . $error['file'] . "\nLine: " . $error['line'], 1, $ADMIN_EMAIL,
            "Subject: Cronjob Power: json_decode failed");
        exit();
    }

    $values = $result->power->values;

    $count = count($values);
    echo "Count: " . $count;
    echo "<br/>";

    $stmt = $db->prepare("INSERT INTO power (value, date) VALUES(:value, :date)");
    $stmt->bindParam(":value", $value);
    $stmt->bindParam(":date", $date);

    $count_inserts = 0;
    for ($x = 0; $x < $count - 1; $x++) {
        $value = $values[$x]->value;
        $date = $values[$x]->date;
        if (empty($value))
            $value = 0.0;

        $stmt->execute();
        $count_inserts++;
    }

    set_new_start_date($db, $values[$count - 1]->date);

    $log =
        "CRONJOB EXECUTED: ".PHP_EOL.
        "Date: ".get_datetime()->format("d.m.Y H:i:s")."]".PHP_EOL.
        "Type: Power".PHP_EOL.
        "Start-Date: " . $start_date.PHP_EOL.
        "End-Date: " . $end_date.PHP_EOL.
        "Insertions: " . $count_inserts.PHP_EOL.
        "--------------------------------".PHP_EOL
    ;

    $date = get_datetime();
    if (!file_exists("log/".$date->format("F"))) {
        mkdir("log/".$date->format("F"), 0777, true);
    }

    file_put_contents("log/".$date->format("F")."/log_".get_datetime()->format("d.m.Y").".txt", $log, FILE_APPEND);

}
function get_start_date($db) {
    $sql = "SELECT * FROM  cron_job_power WHERE id=1";
    $stmt = $db->prepare($sql);

    $stmt->execute();
    $result = $stmt->fetch();
    return $result['start_date'];
}

function set_new_start_date($db, $start_date) {
    $date_now2 = get_datetime();
    $date_now_str = $date_now2->format("Y-m-d H:i:s");
    $sql = "UPDATE cron_job_power SET start_date = '$start_date', last_update ='$date_now_str'";
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