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
	<link rel="stylesheet" href="style.css">

	<title>Book</title>
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
			<li class="active">
				<a href="./addbook.php">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Add Book</span>
				</a>
			</li>
			<li>
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
				<span class="num">8</span> -->
			</a>
			<a href="#" class="profile">
			<?php echo '<img src = "data:image/png;base64,' . base64_encode($profile) . '" width = "50px" height = "50px"/>'?>
				<!-- <img src="img/people.png"> -->
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<center>
				<form class="add_books" action="addbook.php" method="post">
					<h3 class="topic-heading">Add a Book</h3>
					<div class="input-field">
						<label class="label-field" for="file"><span>Cover <span class="required">*</span></span></label>
						<div class="input-here">

							<input type="file" name="cover" id="file" accept="image/*">
						</div>
					</div>
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
							<input type="text" id="author1" name="author1" class="span8" required>
							<input type="text" id="author2" name="author2" class="span8">
							<input type="text" id="author3" name="author3" class="span8">

						</div>
					</div>
					<div class="input-field">
						<label class="label-field" for="Publisher"><span>Publisher <span
									class="required">*</span></span></label>
						<div class="input-here">
							<input type="text" id="publisher" name="publisher" placeholder="Publisher" class="span8"
								required>
						</div>
					</div>
					<div class="input-field">
						<label class="label-field" for="Year"><span>Year <span class="required">*</span></span></label>
						<div class="input-here">
							<input type="text" id="year" name="year" placeholder="Year" class="span8" required>
						</div>
					</div>
					<div class="input-field">
						<label class="label-field" for="Availability"><span>Number of Copies <span
									class="required">*</span></span></label>
						<div class="input-here">
							<input type="text" id="availability" name="availability" placeholder="Number of Copies"
								class="span8" required>
						</div>
					</div>

					<div class="input-field">
						<label class="label-field" for="Category"><span>Category <span
									class="required">*</span></span></label>
						<div class="input-here">
							<input type="text" id="category" name="category" placeholder="Category" required>
						</div>
					</div>
					<div class="input-field">
						<label class="label-field" for="Title"><span>Synopsis <span
									class="required">*</span></span></label>
						<div class="input-here">
							<textarea name="synopsis" class="textarea-field"></textarea>
							<!-- <input type="text" id="title" name="title" placeholder="Title" class="span8" required> -->
						</div>
					</div>
					<div class="input-field">
						<label class="label-field" for="Path"><span>Path <span
									class="required">*</span></span></label>
						<div class="input-here">
							<input type="text" id="path" name="path" placeholder="Path" required>
						</div>
					</div>

					<div class="input-field">
						<div class="input-here">
							<button type="submit" name="submit" class="btn">Add Book</button>
						</div>
					</div>
				</form>
			</center>
		</main>
		<?php
if(isset($_POST['submit']))
{
	$cover=$_POST['cover'];
    $title=$_POST['title'];
    $author1=$_POST['author1'];
    $author2=$_POST['author2'];
    $author3=$_POST['author3'];
    $publisher=$_POST['publisher'];
    $year=$_POST['year'];
    $availability=$_POST['availability'];
	$category=$_POST['category'];
	$synopsis=$_POST['synopsis'];
	$path=$_POST['path'];

$sql1="insert into book (BookId,Title,Publisher,Year,Availability,cover,category,synopsis,path) values (NULL,'$title','$publisher','$year','$availability','$cover','$category','$synopsis','$path')";

if($connection->query($sql1) === TRUE){
$sql2="select max(BookId) as x from Safari_final_project.book";
$result=$connection->query($sql2);
$row=$result->fetch_assoc();
$x=$row['x'];
$sql3="insert into Safari_final_project.author values ('$x','$author1')";
$result=$connection->query($sql3);
if(!empty($author2))
{ $sql4="insert into Safari_final_project.author values('$x','$author2')";
  $result=$connection->query($sql4);}
if(!empty($author3))
{ $sql5="insert into Safari_final_project.author values('$x','$author3')";
  $result=$connection->query($sql5);}

echo "<script type='text/javascript'>alert('Success')</script>";
}
else
{
	echo $connection->error;
// echo "<script type='text/javascript'>alert('Error')</script>";
}
    
}
?>

		<script src="script.js"></script>
	</section>
</body>
</html>