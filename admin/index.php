<?php
require('./db_connection.php');
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
	<link rel="stylesheet" href="./style.css">

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
			<li class="active">
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

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				
			</div>

			<ul class="box-info">

				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<?php
				// Total users 
				$totalUsersQuery="SELECT * FROM `Users` WHERE 1";
				$totalUsersQueryRun=mysqli_query($connection, $totalUsersQuery);

				if ($userTotal = mysqli_num_rows($totalUsersQueryRun)){
					echo"
					<h3>".$userTotal."</h3>
					<p>Total Readers</p>
					</span>";
				}
				?>
				</li>
				<li>
					<i class='bx bx-book'></i>
					<span class="text">
					<?php
				// Total users 
				$totalBooksQuery="SELECT * FROM `book` WHERE 1";
				$totalBooksQueryRun=mysqli_query($connection, $totalBooksQuery);

				if ($bookTotal = mysqli_num_rows($totalBooksQueryRun)){
					echo"
					<h3>".$bookTotal."</h3>
					<p>Total Books</p>
					</span>";
				}
				?>

				</li>
				
			</ul>


			<div class="table-data">
				<div class="todo">
					<div class="head">
						<h3>Books</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<?php
				// Book List
				$totalBooksQuery="SELECT * FROM `book`";
				$bookResult=$connection->query($totalBooksQuery);
                while ($bookRow=$bookResult->fetch_assoc()) {
					$book=$bookRow['Title'];
                    echo" <li class=\"completed\">
					<p>$book</p>
					</li>";
                }
				?>
<hr><br><br>
<div class="order">
	<div class="head">
		<h3 style="text-decoration:underline;">Recommended Books</h3>
	</div>
	<table>
		<thead>
			<tr>
				<th>Book</th>
				<th>User</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql="select * from Safari_final_project.recommendation";
			$result=$connection->query($sql);
			while($row=$result->fetch_assoc())
			{
				$bookname=$row['book_name'];
				$userId=$row['user_id'];
				// $rollno=$row['RollNo'];
				$usernameQuery= "SELECT `user_name` FROM `Users` WHERE `id`= '$userId'";
				$userResult = $connection->query($usernameQuery);
				$rowResultUser=$userResult->fetch_assoc();
				$name = $rowResultUser['user_name'];
				?>
					<tr>
						<td><?php echo $bookname ?></td>
						<td><?php echo $name?></td>
						
					</tr>
					<?php } ?>
					
				</tbody>
			</table>
		</div>
	</ul>
	</div>
		<!-- <li class="completed">
	<p>Todo List</p>
	<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li> -->
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>