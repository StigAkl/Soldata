<?php
include_once("../functions/functions.php");
include_once("../access/db_connect.php");
include_once("../access/database_functions.php");

/**
 * Created by PhpStorm.
 * User: Stig
 * Date: 19.04.2017
 * Time: 15.22
 */


if ($_GET['code'] == "ofaejoefwoijfe") {

    $db = Db::getInstance();

    //Error oppstått her skal logges i /error/err_log.txt
    ini_set("error_log", dirname(__FILE__) . "/error/err_log.txt");


    $start_date = get_start_date($db);
    $start_date_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $start_date);

    $end_date = get_datetime()->format("Y-m-d H:i:s");
    $end_date_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $end_date);

    $url2 = "https://monitoringapi.solaredge.com/site/278561/energy.json?api_key=87SFOBPSXXAOI3WIUW13NK65GPCUN02A&timeUnit=QUARTER_OF_AN_HOUR&startDate=" . $start_date_datetime->format("Y-m-d") . "&endDate=" . $end_date_datetime->format("Y-m-d");
    $string = file_get_contents($url2);

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
            "Subject: Cronjob Energy: json_decode failed");
        exit();
    }

    $values = $result->energy->values;

    $count = count($values);

    $stmt = $db->prepare("INSERT INTO energy (value, date) VALUES(:value, :date)");
    $stmt->bindParam(":value", $value);
    $stmt->bindParam(":date", $date);

    $last_date = $start_date;
    $count_inserts = 0;

    $end_date_datetime->sub(new DateInterval("PT15M"));


    for ($x = 0; $x < $count - 1; $x++) {
        $value = $values[$x]->value;
        $date = $values[$x]->date;
        if (empty($value))
            $value = 0.0;

        $date_object = DateTime::createFromFormat("Y-m-d H:i:s", $date);

        echo $date_object->format("Y-m-d H:i:s") . ":" . $end_date_datetime->format("Y-m-d H:i:s");

        if ($date_object >= $start_date_datetime && $date_object < $end_date_datetime) {
            $last_date = $date;
            $count_inserts++;
            $stmt->execute();
            echo "added <br>";
        } else {
            if($date_object > $end_date_datetime)
                echo "date_objec > end_date<br>";
            else
                if($date_object < $start_date_datetime)
                    echo "date_object < start_date";
        }
    }

    $last_date_datetime = DateTime::createFromFormat("Y-m-d H:i:s", $last_date);
    $last_date_datetime->add(new DateInterval("PT15M"));
    set_new_start_date($db, $last_date_datetime->format("Y-m-d H:i:s"));

    echo "Finished. " . $count_inserts . " values inserted";

    $log =
        "CRONJOB EXECUTED: ".PHP_EOL.
        "Date: ".get_datetime()->format("d.m.Y H:i:s")."]".PHP_EOL.
        "Type: Energy".PHP_EOL.
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
function get_start_date($db)
{
    $sql = "SELECT * FROM  cron_job_energy WHERE id=1";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['next_date'];
}

function set_new_start_date($db, $start_date)
{
    $date_now = get_datetime();
    $date_now_str = $date_now->format("Y-m-d H:i:s");
    $sql = "UPDATE cron_job_energy SET next_date = '$start_date', last_update ='$date_now_str'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}

?>