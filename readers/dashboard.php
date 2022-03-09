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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./assets/bootstrap/css/trial.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="dashboard/slick-1.8.1/slick/slick.css">
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard/style.css">



    <!-- JS connection  -->

    <title>Dashboard Sidebar Menu</title>
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

        <section class="home">
            <!-- <div class="text">Dashboard</div> -->
            <div class="hero-box">
                <div class="hero-box-title-text">Get your books</div>
                <section class="books">
                    <div class="book-box">
                        <h4>All books on your board</h4>
                        <a href="./dashboard.php"><p>select from a wide range of books</p></a>
                    </div>
                    <!-- <div class="book-box">
                        <h4>Currently Issued Books</h4>
                        <p>view the books that you have been reading</p>
                    </div> -->
                </section>
                <hr>
                <p class="text-center">Books</p>

               <!-- indian start -->
               <?php
                                    if (isset($_POST['submit'])) {
                                        $s=$_POST['title'];
                                        $sql="select * from Safari_final_project.book where BookId='$s' or Title like '%$s%'";
                                    } else {
                                        $sql="select * from Safari_final_project.book order by Availability DESC";
                                    }

                                    $result=$connection->query($sql);
                                    $rowcount=mysqli_num_rows($result);

                                    if (!($rowcount)) {
                                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                                    } else {
                                        ?>
    <section class="display row">
    <?php
                            
        //$result=$conn->query($sql);
        while ($row=$result->fetch_assoc()) {
            $bookid=$row['BookId'];
            $name=$row['Title'];
            $avail=$row['Availability'];
            $cover= $row['cover'];
            $category = $row['category'];
            $synopsis = $row['synopsis'];
            
            ?>
            <div class="book col-md-6 ">
                <div class="book_cover">
                    <!-- <img src="./assets/images/themountainisyou.jpg" alt=""> -->
                    <?php echo '<img src = "data:image/png;base64,' . base64_encode($row['cover']) . '" width = "50px" height = "50px"/>'?>
                    <span class="tag"><?php echo $category ?></span>
                </div>
                <div class="book_listing">
                    <div class="content">
                        <h1 class="title"><?php echo $name ?></h1>
                        <p class="synopsis"><?php echo $synopsis ?></p>

                        <p class="availability"><?php
                                           if ($avail > 0) {
                                               echo "<font color=\"green\">AVAILABLE</font>";
                                           } else {
                                               echo "<font color=\"red\">NOT AVAILABLE</font>";
                                           } ?>
                                                 	
                                                 </b></p>
                        <div class="btn_and_rating_box">
                            
                            <a href="./books/rater.php?id=<?php echo $bookid ?>"><button class="btn_borrow" name= "borrow_btn">Borrow</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
                                    } ?>
        </div>
        
               <!-- indian end -->
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

        <!-- end recent books -->

        <!-- previously borrowed books -->
        <h4 class="recent-books">Previously Borrowed Books</h4>

        <!-- end recent books -->

        <!-- Recommeded borrowed books -->
        <h4 class="recent-books">Recommended Books</h4>
        <section class="recents variable slider">

        </section>
        <!-- end recent books -->
    </section>



    <!-- End Beware -->
    <script src="dashboard/jquery.js"></script>
    <script src="dashboard/slick-1.8.1/slick/slick.js"></script>
    <script src="dashboard/script.js"></script>
<!-- 
    <script src="./assets/bootstrap/js/jquery-3.4.0.js"></script> -->
    <script src="./assets/bootstrap/js/popper.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.js"></script>

</body>

</html>