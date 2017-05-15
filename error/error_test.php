<?php
/**
 * Created by PhpStorm.
 * User: EliseIGank
 * Date: 14.05.2017
 * Time: 15.27
 */

ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__) . "/err_log.txt");
error_reporting(E_ALL);


    $content = file_get_contents("423423");

    if(!$content) {
        error_log("You messed up!", 1, "stg@hotmail.no");
    }


?>