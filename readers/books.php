<?php
require('db_connection.php');
?>

<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("location: index.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <!-- CSS connection  -->
    <link rel="stylesheet" href="./assets/bootstrap/css/trial.css">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">

    <!-- JS connection  -->
    <script src="./assets/bootstrap/js/jquery-3.4.0.js"></script>
    <script src="./assets/bootstrap/js/popper.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.js"></script>
</head>

<body>
     <?php echo"<h1>Welcome". $_SESSION['user']."</h1>" ?>
     <a href="logout.php">Logout</a>
     <a href="current.php">current books</a>
     <a href="logout.php">Logout</a>
     <!-- Search button  -->
    <div class="searcher">
        <form class="Search_area" action="books.php" method="post">
            <div class="search_box">
                <!-- <input type="search"> -->
                <input type="text" id="title" name="title" placeholder="Enter Name/ID of Book" class="span8" required>
                <button name= "submit">
                <img src="./assets/images/search-solid.png" alt="search">
                </button>
            </div>
    </div>

    </form>
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
            <div class="book col-md-6">
                <div class="book_cover">
                    <!-- <img src="./assets/images/themountainisyou.jpg" alt=""> -->
                    <?php echo '<img src = "data:image/png;base64,' . base64_encode($row['cover']) . '" width = "50px" height = "50px"/>'?>
                    <span class="tag">Category</span>
                </div>
                <div class="book_listing">
                    <div class="content">
                        <h1 class="title"><?php echo $name ?></h1>
                        <p class="synopsis">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis quisquam
                            natus
                            corporis, consequuntur fugit officia molestias sunt perspiciatis nemo obcaecati.</p>

                        <p class="availability"><?php
                                           if ($avail > 0) {
                                               echo "<font color=\"green\">AVAILABLE</font>";
                                           } else {
                                               echo "<font color=\"red\">NOT AVAILABLE</font>";
                                           } ?>
                                                 	
                                                 </b></p>
                        <div class="btn_and_rating_box">
                            <div class="rating">
                                <img src="./images/" alt="star">
                                <img src="./images/" alt="star">
                                <img src="./images/" alt="star">
                                <img src="./images/" alt="star">
                                <img src="./images/" alt="star">
                            </div>
                            <button class="btn_borrow">Borrow</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
                                    } ?>
    </section>
</body>

</html>
