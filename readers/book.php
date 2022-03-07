<?php
require('db_connection.php');
?>

<!-- <?php 
// if ($_SESSION['user_name']) {
    ?> -->

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LMS</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="./css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>

                    <div class="span9">
                        <form class="search_btn" action="book.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="Search"><b>Search:</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Enter Name/ID of Book" class="span8" required>
                                                <button type="submit" name="submit"class="btn">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <br> 
                                    <?php
                                    if(isset($_POST['submit']))
                                        {$s=$_POST['title'];
                                            $sql="select * from Safari_final_project.book where BookId='$s' or Title like '%$s%'";
                                        }
                                    else
                                        $sql="select * from Safari_final_project.book order by Availability DESC";

                                    $result=$connection->query($sql);
                                    $rowcount=mysqli_num_rows($result);

                                    if(!($rowcount))
                                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                                    else
                                    {

                                    
                                    ?>
                                    
                        <!--  <table class="table" id = "tables">
                                  <thead>
                                    <tr>
                                      <th>Book id</th>
                                      <th>Book name</th>
                                      <th>Availability</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody> -->
                                    <?php
                             
                            //$result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                $bookid=$row['BookId'];
                                $name=$row['Title'];
                                $avail=$row['Availability'];
                            ?>
                            <div class="book">
                                        <div class="book_cover">
                                             <img src="./images/login.jpg" alt="">
                                             <span class="tag">Category</span>
                                        </div>
                                        <div class="book_listing">
                                             <div class="content">
                                                <h1 class="title"><?php echo $name ?></h1>
                                                <p class="synopsis">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis quisquam natus
                                                corporis, consequuntur fugit officia molestias sunt perspiciatis nemo obcaecati.</p>

                                                <p class="availability"><b><?php 
                                           if($avail > 0)
                                              echo "<font color=\"green\">AVAILABLE</font>";
                                            else
                                            	echo "<font color=\"red\">NOT AVAILABLE</font>";

                                                 ?>
                                                 	
                                                 </b></p>
                                                <div class="btn_and_rating_box">
                                                <?php echo $bookid ?>
                                                    <!-- <div class="rating">
                                                        <img src="./images/" alt="star">
                                                        <img src="./images/" alt="star">
                                                        <img src="./images/" alt="star">
                                                        <img src="./images/" alt="star">
                                                        <img src="./images/" alt="star">
                                                    </div> -->
                                                    <button class="btn_borrow">Borrow</button>
                                                    <a href="bookdetails.php?id=<?php echo $bookid; ?>" class="btn btn-primary">Details</a>
                                      	<?php
                                      	if($avail > 0)
                                      		echo "<a href=\"issue_request.php?id=".$bookid."\" class=\"btn btn-success\">Issue</a>";
                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                      <td><?php echo $bookid ?></td>
                                      <td><?php echo $name ?></td>
                                      <td><b><?php 
                                           if($avail > 0)
                                              echo "<font color=\"green\">AVAILABLE</font>";
                                            else
                                            	echo "<font color=\"red\">NOT AVAILABLE</font>";

                                                 ?>
                                                 	
                                                 </b></td>
                                      
                                    </tr>
                               <?php }} ?>
                               
                            </div>


<div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2018 Library Management System </b>All rights reserved.
            </div>
        </div>
        
        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      
    </body>

</html>

<!-- 
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} -->