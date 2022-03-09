<?php
require('../../db_connection.php');
?>

<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("location: admin-login.php");
}
$username = $_SESSION['admin'];
$userQuery="select * from Safari_final_project.admin_users where name='$username'";
$resultUser=$connection->query($userQuery);
$rowUser=$resultUser->fetch_assoc();
$id=$rowUser['id'];
$profile=$rowUser['picture'];

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
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="./addbook.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Add Book</span>
				</a>
			</li>
			<li>
				<a href="./message.php">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
				</a>
			</li>
			<li>
				<a href="./team.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li class= "active">
				<a href="./settings.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="./logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<!-- <a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a> -->
			<a href="#" class="profile">
			<?php echo '<img src = "data:image/png;base64,' . base64_encode($profile) . '" width = "50px" height = "50px"/>'?>
			</a>
		</nav>
		<!-- NAVBAR -->

        <script src="script.js"></script>
</body>
</html>