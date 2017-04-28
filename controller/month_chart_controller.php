<?php
include_once("functions/functions.php");
include_once ("access/database_functions.php");
/**
 * Created by PhpStorm.
 * User: EliseIGank
 * Date: 28.04.2017
 * Time: 20.26
 */


$month = date("F", strtotime("this month"));
$date_now = get_datetime();
$month_to_show = get_data_month($date_now->format("Y-m-d H:i:s"));

if(isset($_POST['month']))  {
    $date = htmlspecialchars($_POST['month']);

    if(validateDate($date, "Y-m-d H:i:s"))
        $month_to_show = get_data_month($date);

    $month = DateTime::createFromFormat("Y-m-d H:i:s", $date)->format("F");
}

?>