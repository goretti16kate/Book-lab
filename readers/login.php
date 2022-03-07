<?php

include 'db_connection.php';

error_reporting(0);

session_start();

if (isset($_SESSION['user'])){
    header("location: dashboard.php");
}

if (isset($_POST['btn_register'])){
    $regname = $_POST['user'];
    $regemail = $_POST['email'];
    $password =$_POST['password'];
    $cpassword =$_POST['cpassword'];

    if ($password == $cpassword){
        $checkQuery = "SELECT * FROM  `Users` where `user_name` ='$name'";
        $check = mysqli_query($connection, $checkQuery);
        $num =mysqli_num_rows($result);

        if ($num == 0){
            $regQuery = "INSERT INTO `Users`(`id`, `user_name`, `user_email`, `user_password`) VALUES (NULL,'$regname','$regemail','$password')";
            $save = mysqli_query($connection, $regQuery);
            if ($save){
                echo "<script>alert('Registration Complete')</script>";
                $regname="";
                $regemail= "";
                $_POST["password"]= "";
                $_POST["cpassword"]= "";

                header("location:login.php");
            }else{
                echo "<script>alert('Whoops, Something went wrong')</script>";
            }
        }else{
            echo "<script>alert('Oops, Username already exists')</script>";
        }
    }else{
        echo "<script>alert('passwords not matched')</script>";
    }
}
if (isset($_POST['btn_login'])){

    $name = $_POST['user'];
    $pass = $_POST['password'];

    $s = "select * from  Users where user_name ='$name' && user_password = '$pass'";

    $result = mysqli_query($connection, $s);

    $num =mysqli_num_rows($result);

    if ($num == 1){
        $_SESSION['user'] = $name;
        header('location:dashboard.php');
    }else { 
        header('location:login.php');
}
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Link to the CSS files -->
    <link rel="stylesheet" href="./assets/css/style.css">


</head>
<body>
    <nav class="homepage_nav">
        <a href="#" class="logo">
            <!-- <img src="./images/logo1.jpg" alt="logo"> -->
            <caption class="logo">Book-Lab</caption>
        </a>
        <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span class="nav-icon"></span>
        </label>
        <ul class="menu">
            <li><a href="./index.html#" >Home</a></li>
            <li><a href="./index.html#about">About</a></li>
            <li><a href="./index.html#contact">Contact</a></li>
            <li><a class="active" href="./login.php">Login/Register</a></li>

        </ul>
    </nav>
    <div class="logger">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Login</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div>
            <!-- <div class="social-icons">
                <img src="#" alt="fb.png">
                <img src="#" alt="tw.png">
                <img src="#" alt="google.png">
            </div> -->
            <form id="login" action="login.php" method="post" class="input-group">
                <input name="user"type="text" class="input-field" placeholder="User Name" required>
                <input name="password" type="text" class="input-field" placeholder="Enter Password" required>
                <input type="checkbox" name="" id="" class="login-check-box"><span class="rem">Remember Password</span>
                <button name="btn_login" type="submit" class="submit-btn">Login</button>
            </form>
            <form id="register" action="login.php" class="input-group" method= "POST">
                <input name= "user" type="text" class="input-field" placeholder="User Name" required>
                <input name= "email"type="email" class="input-field" placeholder="Email address" required>
                <input name= "password" type="password" class="input-field" placeholder="Enter Password" required>
                <input name= "cpassword" type="password" class="input-field" placeholder="Confirm Password" required>
                <input type="checkbox" name="" id="" class="login-check-box"><span class="rem">I agree to the terms & conditions</span>
                <button name= "btn_register" type="submit" class="submit-btn">Register</button>
            </form>
        </div>
    </div>

    <script>
        var x = document.getElementById("login")
        var y = document.getElementById("register")
        var z = document.getElementById("btn")

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }


    </script>
</body>
</html>