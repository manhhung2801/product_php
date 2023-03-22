<?php
include("../functions/myfunctions.php");

    if(isset($_SESSION["auth"])) {
        if($_SESSION["role_as"] != 1) {
            redirect("http://localhost/phpecom/index.php", "You are not authorized to access this page");
        }
    }else{
        redirect("http://localhost/phpecom/login.php", "Login to continue");
    }
?>