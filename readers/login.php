<?php

include 'db_connection.php';

error_reporting(0);

session_start();

if (isset($_SESSION['id'])){
    header("location: dashboard.php");
}

if (isset($_POST['btn_register'])){
    $regname = $_POST['user'];
    $regemail = $_POST['email'];
    $password =md5($_POST['password']);
    $cpassword =md5($_POST['cpassword']);

    if ($password == $cpassword){
        $checkQuery = "SELECT * FROM  `Users` where `user_name` ='$name'";
        $check = mysqli_query($connection, $checkQuery);
        $num =mysqli_num_rows($result);

        if ($num == 0){
            $Get_image_name = $_FILES['image'];
            // $image =new imagick("./assets/images/profile.jpg");
            // $profile = $image->getImageBlob();
            // $profile= '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';
            $profile = $_FILES['./assets/images/profile.jpg'];
            $regQuery = "INSERT INTO `Users`(`id`, `user_name`, `user_email`, `user_password`, `pic`) VALUES (NULL,'$regname','$regemail','$password','$profile')";
            $save = mysqli_query($connection, $regQuery);
            if ($save){
                echo "<script>alert('Registration Complete')</script>";
                $regname="";
                $regemail= "";
                $_POST["password"]= "";
                $_POST["cpassword"]= "";

                header("location:login.php");
            }else{
                echo "<script>alert('whoops, Something went wrong')</script>";
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
    $pass = md5($_POST['password']);

    $s = "select * from  Users where user_name ='$name' && user_password = '$pass'";

    $result = mysqli_query($connection, $s);

    $num =mysqli_num_rows($result);

    if ($num == 1){
        $select= "select * from Users where user_name='$name'";
        $sql = mysqli_query($connection,$select);
        $row = mysqli_fetch_assoc($sql);
        $id = $row['id'];
        $_SESSION['id'] = $id;
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
            <form id="login" action="login.php" method="post" class="input-group">
                <input name="user"type="text" class="input-field" placeholder="User Name" required>
                <input name="password" type="password" class="input-field" placeholder="Enter Password" required>
                <input type="checkbox" name="" id="" class="login-check-box"><span class="rem">Remember Password</span>
                <button name="btn_login" type="submit" class="submit-btn">Login</button>
            </form>
            <form id="register" action="login.php" class="input-group" method= "POST">
                <input name= "user" type="text" class="input-field" placeholder="User Name" required>
                <input name= "email"type="email" class="input-field" placeholder="Email address" required>
                <input name= "password" type="password" class="input-field" placeholder="Enter Password" required>
                <input name= "cpassword" type="password" class="input-field" placeholder="Confirm Password" required>
                <input type="checkbox" name="" id="" class="login-check-box" required><span class="rem">I agree to the terms & conditions</span>
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