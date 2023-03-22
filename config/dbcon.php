<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpecom";

    // Creating database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check database connection
    if(!$conn) {
        die("Connection Failed:" . mysqli_connect_error($conn));
    }

?>