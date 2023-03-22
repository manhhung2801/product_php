<?php
// Start the sesion
session_start();

include("../config/dbcon.php");
include("./myfunctions.php");

    // define variablesand set to empty values
    $name = $phone = $email = $password = $cpassword = "";

    //mysqli_real_escape_string() Thoát các ký tự đặc biệt nếu có. hàm này được sử dụng để tạo một chuỗi SQL hợp pháp có thể được sử dụng trong một câu lệnh SQL

    // Hàm isset() kiểm tra xem một biến có được đặt hay không, có nghĩa là nó phải được khai báo và không phải là Null
    if(isset($_POST["register_btn"])){ 
        $name = mysqli_real_escape_string($conn, check_input($_POST["name"]));
        $phone = mysqli_real_escape_string($conn, check_input($_POST["phone"]));
        $email = mysqli_real_escape_string($conn, check_input($_POST["email"]));
        $password = mysqli_real_escape_string($conn, check_input($_POST["password"]));
        $cpassword =  $_POST["cpassword"];

        // function empty(): trống -  kiểm tra một biết có trống không. Đồng thời kiểm tra xem biến có được đặt/khai báo hay không
        if(empty($name) || empty($phone) || empty($email) || empty($password) || empty($cpassword)){
            // $_SESSION["message"] = "Infomation is required";
            // header('Location: http://localhost/phpecom/register.php');
            redirect("http://localhost/phpecom/register.php", "Infomation is required");
        }else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                // check if name only contains letters and whitespace
                // $_SESSION["message"] = "Name nnly letters and white space allowed";
                // header('Location: http://localhost/phpecom/register.php');
                redirect("http://localhost/phpecom/register.php", "Name nnly letters and white space allowed");
            
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
                // check if email address is well-formed
                // $_SESSION["message"] = "Invalid email format";
                // header('Location: http://localhost/phpecom/register.php');
                redirect("http://localhost/phpecom/register.php", "Invalid email format");
            
        }else if($password !== $cpassword){
            // $_SESSION["message"] = "Password !== Confirm password";
            // header('Location: http://localhost/phpecom/register.php');
            redirect("http://localhost/phpecom/register.php", "Password !== Confirm password");
        }else {
            $check_name = "";
            $check_email = "";

            $sql_check_name_email = "SELECT name, email FROM users";

            // hàm mysqli_query() thực hiện truy vấn đối với cơ sở dữ liệu
            $rel = mysqli_query($conn, $sql_check_name_email);

            // hàm mysqli_num_rows() trả về số hàng trong tập kết quả
            if(mysqli_num_rows($rel) > 0){
                
                // hàm mysqli_fetch_assoc() Tìm nạp kết quả dưới dạng một mảng kết hợp
                while($row = mysqli_fetch_assoc($rel)){
                    
                    $check_name = $row['name'];
                    $check_email = $row['email'];
                    
                    if($check_name == $name){
                        // $_SESSION["message"] = "Name already exits!";
                        // header('Location: http://localhost/phpecom/register.php');
                        redirect("http://localhost/phpecom/register.php", "Name already exits!");
                        break;
                    }
                    if($check_email == $email){
                        // $_SESSION["message"] = "Email already exits!";
                        // header('Location: http://localhost/phpecom/register.php');
                        redirect("http://localhost/phpecom/register.php", "Email already exits!");
                        break;
                    }
                }
            }

            if($check_name !== $name && $check_email !== $email){
                $insert_sql = "INSERT INTO users (name, phone, email, password) VALUES('$name', '$phone', '$email', '$password')";
                $result = mysqli_query($conn, $insert_sql);

                if(!$result){
                    // $_SESSION["message"] = "There was a problem, please come back later.";
                    // header('Location: http://localhost/phpecom/register.php');
                    redirect("http://localhost/phpecom/register.php", "There was a problem, please come back later.");
                }else {
                    header('Location: http://localhost/phpecom/login.php');
                }
            }

        }
    }else if(isset($_POST["login_btn"])){
        $email_login = mysqli_real_escape_string($conn, $_POST["email"]);
        $password_login = mysqli_real_escape_string($conn, $_POST["password"]);

        $login_query = "SELECT * FROM users WHERE email='$email_login' AND password='$password_login' ";

        $login_query_run = mysqli_query($conn, $login_query);

        $userdata = mysqli_fetch_array($login_query_run);

        $username = $userdata["name"];
        $useremail = $userdata["email"];
        $role_as = $userdata["role_as"];

        if(mysqli_num_rows($login_query_run) > 0){
            $_SESSION["auth"] = true;
            $_SESSION["auth_user"] = [
                'name' => $username,
                'email' => $useremail
            ];

            // check user admin role_as
            $_SESSION["role_as"] = $role_as;

            if($role_as == 1){
                
                redirect("http://localhost/phpecom/admin/index.php", "Welcome To Dashboard");
            }else{

                redirect("http://localhost/phpecom/index.php", "Logged In Successfully");
            }


        }else {
            
            redirect("http://localhost/phpecom/index.php", "Invalid Credentials");
        }
    }


    function check_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



?>