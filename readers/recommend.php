<?php
require('db_connection.php');
?>

<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recommend</title>
            <link rel="stylesheet" href="./assets/bootstrap/css/trial.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="dashboard/slick-1.8.1/slick/slick.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard/style.css">
    <link rel="stylesheet" href="../admin/adminhub/style.css">
    </head>
    <body>
    <section class="nav-larger">
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="./dashboard/logo.png" alt="">
                    </span>

                    <div class="text logo-text">
                        <span class="name">Book-lab</span>
                        <?php 
                        $sessionId= $_SESSION['id'];
                        $getUser = "select * from Users where id ='$sessionId'";
                        $result=$connection->query($getUser);
                        $row=$result->fetch_assoc();
                        $username= $row['user_name'];
                        ?>
                        <?php echo " <span>@".$username."</span>" ?>
                    </div>
                </div>

                <i class='bx bx-chevron-right toggle'></i>
            </header>

            <div class="menu-bar">
                <div class="menu">

                    <li class="search-box">
                        <form class="search-box Search_area" action="dashboard.php" method="post">
                            <input type="text" id="title" name="title" style="height:50px; padding:20px" placeholder="Book Name/ID" required>
                            <button name= "submit"></button>
                        </form>
                    </li>
                    <ul class="menu-links">
                        <!-- <li class="nav-link" title="dashboard">
                            <a href="dashboard.php">
                                <i class='bx bx-home-alt bx-tada-hover icon'></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li> -->

                        <li class="nav-link" title="all books">
                            <a href="./dashboard.php">
                                <i class='bx bx-book-content bx-tada-hover icon'></i>
                                <span class="text nav-text">All Books</span>
                            </a>
                        </li>

                        <!-- <li class="nav-link" title="current books">
                            <a href="#">
                                <i class='bx bx-book-open bx-tada-hover icon'></i>
                                <span class="text nav-text">Current Books</span>
                            </a>
                        </li>
                        <li class="nav-link" title="notifications">
                            <a href="#">
                                <i class='bx bx-bell bx-tada-hover icon'></i>
                                <span class="text nav-text">Notifications</span>
                            </a>
                        </li> -->
                        <li class="nav-link" title="Recommend Books">
                            <a href="./recommend.php">
                                <i class='bx bx-book-bookmark bx-tada-hover icon'></i>
                                <span class="text nav-text">Recommend</span>
                            </a>
                        </li>

                        <li class="nav-link" title="profile">
                            <a href="./profile.php">
                                <i class='bx bx-user bx-tada-hover icon'></i>
                                <span class="text nav-text">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="bottom-content">
                    <li class="" title="logout">
                        <a href="logout.php">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>

                    <li class="mode">
                        <div class="sun-moon">
                            <i class='bx bx-moon icon moon'></i>
                            <i class='bx bx-sun icon sun'></i>
                        </div>
                        <span class="mode-text text">Dark mode</span>

                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </li>

                </div>
            </div>
        </nav> 
        <section class= "home">
        <center>
				<form style="margin-top:20px;"class="add_books" action="recommend.php" method="post">
					<h3 class="topic-heading">Recommend a Book</h3>
					<div class="input-field">
						<label class="label-field" for="Title"><span>Title <span
									class="required">*</span></span></label>
						<div class="input-here">
							<input type="text" id="title" name="title" placeholder="Title" class="span8" required>
						</div>
					</div>
					<div class="input-field">
						<label class="label-field" for="Author"><span>Authors <span
									class="required">*</span></span></label>
						<div class="input-here">
							<input placeholder="Author" type="text" id="author1" name="author1" class="span8" required>
						</div>
					</div>

					<div class="input-field">
						<div class="input-here">
							<button style= "width:150px;height:60px;"type="submit" name="submit" class="btn">Recommend Book</button>
						</div>
					</div>
				</form>
			</center>     
         </section>
<?php
if(isset($_POST['submit']))
{
    $title=$_POST['title'];
    $author=$_POST['author1'];
    $userId=$_SESSION['id'];

$sql1="insert into Safari_final_project.recommendation (r_id,book_name,user_id,author) values (NULL,'$title','$userId', '$author')"; 



if($connection->query($sql1) === TRUE){


echo "<script type='text/javascript'>alert('Success')</script>";
}
else
{//echo $conn->error;
echo "<script type='text/javascript'>alert('Error')</script>";
}
    
}
?> 

<script src="dashboard/jquery.js"></script>
    <script src="dashboard/slick-1.8.1/slick/slick.js"></script>
    <script src="dashboard/script.js"></script>
<!-- 
    <script src="./assets/bootstrap/js/jquery-3.4.0.js"></script> -->
    <script src="./assets/bootstrap/js/popper.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.js"></script>
    </body>

</html>

<?php