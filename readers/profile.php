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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <link rel="stylesheet" href="./profile.css">
    <!----======== CSS ======== -->
    <!-- <link rel="stylesheet" href="./assets/bootstrap/css/trial.css"> -->
    <!-- <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" href="dashboard/slick-1.8.1/slick/slick.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard/style.css">
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
                            <a href="./dashboard.php">
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
                        <li class="nav-link" title="previously borrowed books">
                            <a href="#">
                                <i class='bx bx-book-bookmark bx-tada-hover icon'></i>
                                <span class="text nav-text">Previously</span>
                            </a>
                        </li>
                        <li class="nav-link" title="notifications">
                            <a href="#">
                                <i class='bx bx-bell bx-tada-hover icon'></i>
                                <span class="text nav-text">Notifications</span>
                            </a>
                        </li> -->

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

        <section class="home">
            <!-- <div class="text">Dashboard</div> -->
            <div class="profile-card">
            <?php
                                $sessionId = $_SESSION['id'];
                                $getUser = "select * from Users where id ='$sessionId'";
                                $result=$connection->query($getUser);
                                $row=$result->fetch_assoc();
                                $username= $row['user_name'];
                                $id=$row['id'];
                                $email=$row['user_email'];
                                $pswd=$row['user_password'];
                                $picture= $row['pic'];
                                ?> 
            
                <!-- The background element  -->

                <div class="background">
                    <div class="shape"></div>
                    <div class="shape"></div>
                </div>

                <!-- Basic strucure of the profile card  -->
                <div class="wrapper">
                 <!-- Profile image  -->
                    <div class="img-area">
                        <div class="inner-area">
                        <?php
                        if ($picture ==NULL){
                                echo '<img src="./assets/images/profile.jpg" alt="">';
                        }else{

                            echo '<img src = "data:image/png;base64,' . base64_encode($row['pic']) . '" width = "50px" height = "50px"/>';
                        }

                        ?> 
                        </div>
                    </div>
                    <!-- Basic information  -->
                    <div class="user-name"><?php echo $username ?> </div>
                    <div class="email"><?php echo $email ?></div>
                    


                    <!-- Edit button  -->
                    <div class="buttons">
                        <a href="./edit.php?id=<?php echo $id ?>"><button class="edify" name="edit">Edit Profile</button></a>
                    </div>
                </div>

            </div>
        </section>
        
    </section>




    <!-- Beware -->
    <section class="tiny">
        <div class="navbar">
            <ul>
                <li class="active">
                    <a href="#">
                        <i class='bx bx-home icon'></i>
                        <i class='bx bxs-home activeIcon'></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-user icon'></i>
                        <i class='bx bxs-user activeIcon'></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-bell icon'></i>
                        <i class='bx bx-bell bx-tada-hover activeIcon'></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-cog icon '></i>
                        <i class='bx bxs-cog activeIcon'></i>
                    </a>
                </li>
                <li class="mode-small-screen" title="change color mode">
                    <a href="#">
                        <i class='bx bx-moon icon moon small-sun' id="small-sun"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="small-search">
            <input type="text" placeholder="Search...">
            <i class='bx bx-search icon'></i>
        </div>
       <a href="dashboard-min.php">
       <div class="all-books">
            <div class="title">All Books on your board</div>
            <div class="text">select from a wide range of books <i class='bx bx-chevrons-right bx-fade-right'></i></div>
        </div>
       </a>

        <!-- recent books -->
        <h4 class="recent-books">Downloaded Books</h4>
        <section class="recents variable slider">
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8Ym9va3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1558901357-ca41e027e43a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
        </section>
        <!-- end recent books -->

        <!-- previously borrowed books -->
        <h4 class="recent-books">Previously Borrowed Books</h4>
        <section class="recents variable slider">
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1558901357-ca41e027e43a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8Ym9va3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
        </section>
        <!-- end recent books -->

        <!-- Recommeded borrowed books -->
        <h4 class="recent-books">Recommended Books</h4>
        <section class="recents variable slider">
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8Ym9va3xlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1558901357-ca41e027e43a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTl8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
            <div class="shelve">
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTV8fGJvb2t8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60"
                    alt="" class="shelve-img">
            </div>
        </section>
        <!-- end recent books -->
    </section>



    <!-- End Beware -->
    <script src="dashboard/jquery.js"></script>
    <script src="dashboard/slick-1.8.1/slick/slick.js"></script>
    <script src="dashboard/script.js"></script>
<!-- 
    <script src="./assets/bootstrap/js/jquery-3.4.0.js"></script> -->
    <!-- <script src="./assets/bootstrap/js/popper.min.js"></script> -->
    <!-- <script src="./assets/bootstrap/js/bootstrap.js"></script> -->


</body>
</html>