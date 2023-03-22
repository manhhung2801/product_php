<?php
session_start();   
include("./config/dbcon.php");

if(isset($_SESSION["auth"])) {

    $scope = $_POST["scope"];
    switch($scope){

    }
    
 }else {
    echo 401;
}
?>