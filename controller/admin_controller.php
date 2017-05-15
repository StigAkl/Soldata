<?php
/**
 * Created by PhpStorm.
 * User: EliseIGank
 * Date: 15.05.2017
 * Time: 21.23
 */

if(isset($_POST['admin_login'])) {
    $password = "tnwp_anes";
    $password_input = htmlspecialchars($_POST['password']);

    if($password_input == $password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
    } else {
        header("Location: index.php?page=page_not_found");
    }
}


//Kode for å besvare hendelser

?>