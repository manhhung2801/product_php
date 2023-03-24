<?php
if(!isset($_SESSION['auth'])){
    redirect("login.php", "login to cotinue");
}
?>