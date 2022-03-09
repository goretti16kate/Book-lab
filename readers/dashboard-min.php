<?php
require('db_connection.php');
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

    <!-- Beware -->
    <section class="tiny">
        <div class="navbar">
            <ul>
                <li class="active">
                    <a href="./dashboard.php">
                        <i class='bx bx-home icon'></i>
                        <i class='bx bxs-home activeIcon'></i>
                    </a>
                </li>
                <li>
                    <a href="./profile.php">
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
            <!-- <input type="text" placeholder="Search...">
            <i class='bx bx-search icon'></i> -->
            <form class="search-box Search_area" action="dashboard-min.php" method="post">
                            <input type="text" id="title" name="title" style="height:50px; padding:20px" placeholder="Book Name/ID" required>
                            <button name= "submit"></button>
                        </form>
        </div>
        <div class="all-books">
            <div class="title">All Books on your board</div>
        </div>

        

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
            $cover= $row['cover']
            
            ?>
            <div class="book col-md-6 ">
                <div class="book_cover">
                    <!-- <img src="./assets/images/themountainisyou.jpg" alt=""> -->
                    <?php echo '<img src = "data:image/png;base64,' . base64_encode($row['cover']) . '" width = "50px" height = "50px"/>'?>
                    <span class="tag">Category</span>
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