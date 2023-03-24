<?php
session_start();   
include("../config/dbcon.php");

if(isset($_SESSION["auth"])) {

    if(isset($_POST["scope"])) {

        $scope = $_POST["scope"];

        switch($scope){
            case "add":
                $prod_id = $_POST["prod_id"];
                $prod_qty = $_POST["prod_qty"];

                $user_id = $_SESSION["auth_user"]["user_id"];

                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";

                $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

                if(mysqli_num_rows($chk_existing_cart_run) > 0){
                    $_SESSION["message"] = "Product already in cart";
                }else{

                    $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES('$user_id', '$prod_id', '$prod_qty')";
                    $insert_query_run = mysqli_query($conn, $insert_query);

                    

                    if($insert_query_run){
                        $_SESSION["message"] = "Product added to cart";
                        echo 201;
                    }else {
                        echo 500;
                    }
                }

            break;
            case "update":
                $prod_id = $_POST["prod_id"];
                $prod_qty = $_POST["prod_qty"];

                $user_id = $_SESSION["auth_user"]["user_id"];

                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";

                $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

                if(mysqli_num_rows($chk_existing_cart_run) > 0){
                    $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                    $update_query_run = mysqli_query($conn, $update_query);
                    if($update_query_run){
                        echo 200;
                    }else {
                        echo 500;
                    }
                }else{

                    echo "something went wrong";
                }

            break;
            case "delete":
                $cart_id = $_POST["cart_id"];
        
                $user_id = $_SESSION["auth_user"]["user_id"];

                $chk_existing_cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id' ";

                $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

                if(mysqli_num_rows($chk_existing_cart_run) > 0){
                    $delete_query = "DELETE FROM carts WHERE id='$cart_id' ";
                    $delete_query_run = mysqli_query($conn, $delete_query);
                   
                    if($delete_query_run){
                        
                        echo 200;
                    }else {
                        echo 500;
                    }
                }else{

                    echo "something went wrong";
                }

            break;
            default:
                $_SESSION["message"] = "Something went wrong";
                echo 500;

        }
    }
    
 }else {
    $_SESSION["message"] = "Login to continue";
    echo 401;
}
?>