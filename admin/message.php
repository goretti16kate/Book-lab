<?php
require('./db_connection.php');
?>

<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("location: admin-login.php");
}

$username = $_SESSION['admin'];
$sql="select * from Safari_final_project.admin_users where name='$username'";
$result=$connection->query($sql);
$row=$result->fetch_assoc();
$Adminid=$row['id'];
$profile=$row['picture'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>Admin</title>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Book-Lab</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="./index.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="./addbook.php">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Add Book</span>
				</a>
			</li>
			<li class="active">
				<a href="./message.php">
					<i class='bx bxs-message-dots'></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="./team.php">
					<i class='bx bxs-group'></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="./logout.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<!-- <a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">8</span>
			</a> -->
			<a href="#" class="profile">
			<?php echo '<img src = "data:image/png;base64,' . base64_encode($profile) . '" width = "50px" height = "50px"/>'?>
				<!-- <img src="img/people.png"> -->
			</a>
		</nav>

<main class="messages">
    <center>
        <form class="add_books" action="message.php" method="post">
            <div class="input-field">
                <label class="label-field" for="Username"><b>Receiver User name:</b></label>
                <div class="input-here">
                    <input type="text" id="Username" name="Username" placeholder="Username" required>
                </div>
            </div>
            <div class="input-field">
                <label class="label-field" for="Message"><b>Message:</b></label>
                <div class="input-here">

                    <input type="text" id="Message" name="Message" placeholder="Enter Message" class="span8" required>
                </div>
                
            <div class="input-field">
                <div class="input-here">
                    <button type="submit" name="submit"class="btn">Add Message</button>
                </div>
            </div>
        </form>
	</center>
	<section class= "received">
	<div class="received-messages">
  <h2 class="messages-title">Messages</h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Message</div>
      <div class="col col-2">Date</div>
      <div class="col col-3">Time</div>
      <!-- <div class="col col-4">Payment Status</div> -->
	  <?php
                            $admin=$_SESSION['admin'];
                            $selectQuery="select * from Safari_final_project.messages where admin_id='$Adminid' order by Date DESC,Time DESC";
                            $resultQuery=$connection->query($selectQuery);
                            while ($rowQuery=$resultQuery->fetch_assoc()) {
                                $msg=$rowQuery['Msg'];
                                $date=$rowQuery['Date'];
                                $time=$rowQuery['Time'];
                            
                           
                                if ($msg == NULL) {
                                    echo "<br><center><h2><b><i>No Messages</i></b></h2></center>";
                                } else {
    echo "</li>
    <li class=\"table-row\">
      <div class=\"col col-1\" data-label=\"Job Id\">". $msg. "</div>
      <div class=\"col col-2\" data-label=\"Customer Name\">".$date."</div>
      <div class=\"col col-3\" data-label=\"Amount\">" .$time."</div>
    </li>";

}
}?>
	</ul>
	</div>
		
		</section>
</main>

<?php
// $username = $_SESSION['admin'];
// $sql="select * from Safari_final_project.admin_users where name='$username'";
// $result=$connection->query($sql);
// $row=$result->fetch_assoc();
// $id=$row['id'];
// $profile=$row['picture'];

if(isset($_POST['submit']))
{
    $name=$_POST['Username'];
    $message=$_POST['Message'];
	$findId="select * from Safari_final_project.admin_users where name='$name'";
	$resultId=$connection->query($findId);
	$rowId=$resultId->fetch_assoc();
	$receiverId=$rowId['id'];
	$msgQuery="INSERT INTO `messages`(`id`, `admin_id`, `Msg`, `Date`, `Time`) VALUES (NULL,'$receiverId','$message',curdate(),curtime())";

	if($connection->query($msgQuery) === TRUE){
	echo "<script type='text/javascript'>alert('Sent')</script>";
	}
	else{
	// {echo $connection->error;
	echo "<script type='text/javascript'>alert('Error')</script>";
	}	
}
?>

<script src="script.js"></script>
    </section>
</body>
</html>