<?php

include './db_connection.php';

error_reporting(0);

session_start();

if (isset($_SESSION['admin'])){
    header("location: dashboard.php");
}

if (isset($_POST['btn_login'])){

    $name = $_POST['admin'];
    $pass = $_POST['password'];

    $s = "select * from  admin_users where name ='$name' && password = '$pass'";

    $result = mysqli_query($connection, $s);

    $num =mysqli_num_rows($result);

    if ($num == 1){
        $_SESSION['admin'] = $name;
        header('location:index.php');
    }else { 
        header('location:../../login.php');
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

    <!-- Connect to bootstrap  -->
    <!-- Connect to css  -->
    <link rel="stylesheet" href="../../readers/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <!-- connect to javascript  -->
    <script src="../../readers/assets/bootstrap/js/jquery-3.4.0.js"></script>
    <script src="../../readers/assets/bootstrap/js/popper.min.js"></script>
    <script src="../../readers/assets/bootstrap/js/bootstrap.js"></script>

</head>

<body class="login_body">
    <center>
        <div class="container">
            <div class="login-box">
                <div class="row">
                    <div class="col-md-12 login-left">
                        <h2>Admin Login</h2>
                        <br>
                        <form action="admin-login.php" method="post">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="admin" class="form-control" placeholder="Admin Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" name= "btn_login"class="btn btn-primary">Login</button>
                        </form>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </center>
</body>

</html>