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


// $getDayta="SELECT * FROM `Team` WHERE 1";
// $dayta=$connection->query($getDayta);
// $rowDayta=$dayta->fetch_assoc();
// $daytaId=$rowDayta['id'];
// $firstName=$rowDayta['First Name'];
// $lastName=$rowDayta['Last Name'];
// $email=$rowDayta['email_address'];
// $profession=$rowDayta['Profession'];
// $phone=$rowDayta['phone_number'];
// $gitLink=$rowDayta['github_link'];
// $picture=$rowDayta['picture'];

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
			<li class="active">
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
        <!-- Main  -->
        <main>
            <?php
        $getDayta="SELECT `id`, `First_Name`, `Last_Name`, `email_address`, `Profession`, `phone_number`, `github_link`, `picture` FROM `Team` WHERE 1";
$dayta=$connection->query($getDayta);
while ($rowDayta=$dayta->fetch_assoc()) {
$daytaId=$rowDayta['id'];
$firstName=$rowDayta['First_Name'];
$lastName=$rowDayta['Last_Name'];
$email=$rowDayta['email_address'];
$profession=$rowDayta['Profession'];
$phone=$rowDayta['phone_number'];
$gitLink=$rowDayta['github_link'];
$picture=$rowDayta['picture'];

echo "
        <div class=\"team-container\">
  <div class=\"grid-7 element-animation\">

    <div class=\"card color-card card-elevation\">
      <ul>
        <li><i class=\"fas fa-arrow-left i-l w\"></i></li>
        <li><i class=\"fas fa-ellipsis-v i-r w\"></i></li>
        <li><i class=\"far fa-heart i-r w\"></i></li>
      </ul>
      " ?>
			<?php echo '<img class ="team-profile"src = "data:image/png;base64,' . base64_encode($picture) . '" width = "50px" height = "50px"/>'?>

      <?php echo "
        <h1 class=\"name\">".$firstName." ".$lastName."</h1>
      <p class=\"email\">". $email."</p>
      <div class=\"profession top\">
        <p>".$profession."</p>
      </div>

      
      <div class=\"team-container\">
        <div class=\"team-content\">
          <div class=\"grid-2\">
            <button class=\"color-d circule\"><i class=\"fab fa-github-alt fa-2x\"></i><a href=\"". $gitLink."\"</a></button>

          </div>
        </div>
      </div>
    </div>
  </div>"; } ?>

<!--   

  <div class="grid-7 element-animation">
    <div class="card color-card-2">
      <ul>
        <li><i class="fas fa-arrow-left i-l b"></i></li>
        <li><i class="fas fa-ellipsis-v i-r b"></i></li>
        <li><i class="far fa-heart i-r b"></i></li>
      </ul>
      <img src="https://images.unsplash.com/photo-1499557354967-2b2d8910bcca?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=7d5363c18112a02ce22d0c46f8570147&auto=format&fit=crop&w=635&q=80%20635w" alt="profile-pic" class="profile">
      <h1 class="title-2">Bevely Little</h1>
      <p class="job-title"> SENIOR PRODUCT DESIGNER</p>
      <div class="desc top">
        <p>Create usable interface and designs @GraphicSpark</p>
      </div>
      <button class="btn color-a top"> Hire me</button>

      <hr class="hr-2">
      <div class="container">
        <div class="content">
          <div class="grid-2">
            <button class="color-b circule"> <i class="fab fa-dribbble fa-2x"></i></button>
            <h2 class="title-2">12.3k</h2>
            <p class="followers">Followers</p>
          </div>
          <div class="grid-2">
            <button class="color-c circule"><i class="fab fa-behance fa-2x"></i></button>
            <h2 class="title-2">16k</h2>
            <p class="followers">Followers</p>
          </div>
          <div class="grid-2">
            <button class="color-d circule"><i class="fab fa-github-alt fa-2x"></i></button>
            <h2 class="title-2">17.8k</h2>
            <p class="followers">Followers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400" rel="stylesheet">
        </main>

		<script src="script.js"></script>
	</section>
</body>
</html>