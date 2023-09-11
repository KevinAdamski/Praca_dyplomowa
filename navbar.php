<?php
session_start();
require_once("db.php");
$avatar=$_SESSION['avatar'];

$link=connect();
$search_site_elements = mysqli_query($link, "SELECT * FROM site_config WHERE id_config = 1 ");
$record_site_elements = mysqli_fetch_array($search_site_elements);
$title=$record_site_elements['site_name'];
$site_icon=$record_site_elements['site_icon'];


$site_icon_path= "/img/site_icon/" . $site_icon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	background: #eeeeee;
	font-family: 'Varela Round', sans-serif;
}
.navbar {
	color: #fff;
	background: #0b5ed7 !important;
	padding: 5px 16px;
	border-radius: 0;
	border: none;
	box-shadow: 0 0 4px rgba(0,0,0,.1);
}
.navbar img {
	border-radius: 50%;
	width: 36px;
	height: 36px;
	margin-right: 10px;
}
.navbar .navbar-brand {
	color: #efe5ff;
	padding-left: 0;
	padding-right: 50px;
	font-size: 25px;
}
.navbar .navbar-brand:hover, .navbar .navbar-brand:focus {
	color: #fff;
}
.navbar .navbar-brand i {
	font-size: 25px;
	margin-right: 5px;
}

.navbar .nav-item i {
	font-size: 18px;
}
.navbar .nav-item span {
	position: relative;
	right: 8px;
	top: 3px;
}
.navbar .navbar-nav > a {
	float: right;
	color: #efe5ff;
	padding: 8px 15px;
	font-size: 14px;
}
.navbar .navbar-nav > a:hover, .navbar .navbar-nav > a:focus {
	color: #fff;
	text-shadow: 0 0 4px rgba(255,255,255,0.3);
}
.navbar .navbar-nav > a > i {
	display: block;
	text-align: center;
}
.navbar .dropdown-item i {
	font-size: 16px;
	min-width: 22px;
}
.navbar .dropdown-item .material-icons {
	font-size: 21px;
	line-height: 16px;
	vertical-align: middle;
	margin-top: -2px;
}
.navbar .nav-item.open > a, .navbar .nav-item.open > a:hover, .navbar .nav-item.open > a:focus {
	color: #fff;
	background: none !important;
}
.navbar .dropdown-menu {
	border-radius: 1px;
	border-color: #e5e5e5;
	box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .dropdown-menu a {
	color: #777 !important;
	padding: 8px 20px;
	line-height: normal;
	font-size: 15px;
}
.navbar .dropdown-menu a:hover, .navbar .dropdown-menu a:focus {
	color: #333 !important;
	background: transparent !important;
}
.navbar .navbar-nav .active a, .navbar .navbar-nav .active a:hover, .navbar .navbar-nav .active a:focus {
	color: #fff;
	text-shadow: 0 0 4px rgba(255,255,255,0.2);
	background: transparent !important;
}
.navbar .navbar-nav .user-action {
	padding: 9px 15px;
	font-size: 15px;
}
.navbar .navbar-toggle {
	border-color: #fff;
}
.navbar .navbar-toggle .icon-bar {
	background: #fff;
}
.navbar .navbar-toggle:focus, .navbar .navbar-toggle:hover {
	background: transparent;
}
.navbar .navbar-nav .open .dropdown-menu {
	background: #faf7fd;
	border-radius: 1px;
	border-color: #faf7fd;
	box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.navbar .divider {
	background-color: #e9ecef !important;
}
@media (min-width: 1200px){
	.form-inline .input-group {
		width: 350px;
		margin-left: 30px;
	}
}
@media (max-width: 1199px){
	.navbar .navbar-nav > a > i {
		display: inline-block;
		text-align: left;
		min-width: 30px;
		position: relative;
		top: 4px;
	}
	.navbar .navbar-collapse {
		 float: right;
		border: none;
		box-shadow: none;
		padding: 0;
	}
	.navbar .navbar-form {
		border: none;
		display: block;
		margin: 10px 0;
		padding: 0;
	}
	.navbar .navbar-nav {
		margin: 8px 0;
	}
	.navbar .navbar-toggle {
		margin-right: 0;
	}
	.input-group {
		width: 100%;
	}
}

</style>
</head>
<body>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
	<a href="#" class="navbar-brand"> <img src= <?php  echo $site_icon_path; ?> width="30" height="30"  alt=""> <?php echo $title; ?> </a>
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
		<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">

		<div class="navbar-nav ml-auto">
			<a href="https://serwer2241105.home.pl/" class="nav-item nav-link"><i class="fa fa-home"></i><span>Strona główna</span></a>
			 <?php
if (isset($_SESSION['loggedin'])){
$idu=$_SESSION['idu'];
$search = mysqli_query($link, "SELECT * FROM users WHERE idu='$idu'");
$record = mysqli_fetch_array($search);
$name=$record['name'];
$surname=$record['surname'];
$NS=$name . " " . $surname;
			print "<a href='https://serwer2241105.home.pl/user/' class='nav-item nav-link'><i class='fa fa-align-left'></i><span>Panel   </span></a>";

       if ($_SESSION['canCreateTask'] ==1){
			 print "<a href='https://serwer2241105.home.pl/user/qadd.php' class='nav-item nav-link'><i class='fa fa-plus'></i><span>Dodaj</span></a>";
		 }
		 if ($_SESSION['canTeam'] ==1){
		 print "<a href='https://serwer2241105.home.pl/user/team.php' class='nav-item nav-link'><i class='fa fa-users'></i><span>Zespoły</span></a>";
		 }


			if ($_SESSION['canDoTest'] ==1 || $_SESSION['canCreateTest'] ==1){
		print		"<a href='https://serwer2241105.home.pl/test/' class='nav-item nav-link'><i class='fa  fa-sticky-note'></i><span>Testy</span></a>"; }

			print "<a href='https://serwer2241105.home.pl/ranking/' class='nav-item nav-link'><i class='fa fa-signal'></i><span>Ranking</span></a>


			<div class='nav-item dropdown'>
				<a href='' data-toggle='dropdown' class='nav-item nav-link dropdown-toggle user-action'><img src='$avatar' class='avatar' alt='Avatar'> $NS <b class='caret'></b></a>
				<div class='dropdown-menu'>
					<a href='https://serwer2241105.home.pl/settings/' class='dropdown-item'><i class='fa fa-sliders'></i> Ustawienia</a>";
					if($_SESSION['admin'] == 1){
		print "<a href='https://serwer2241105.home.pl/settings/site_title.php' class='dropdown-item'><i class='fa fa-cogs'></i> Ustawienia Portalu</a>";
		print "<a href='https://serwer2241105.home.pl/settings/userlist.php' class='dropdown-item'><i class='fa fa-group'></i> Użytkownicy</a>";
		print "<a href='https://serwer2241105.home.pl/settings/logs.php' class='dropdown-item'><i class='fa fa-camera-retro'></i> Logi</a>";
	}

					print "<div class='divider dropdown-divider'></div>";




					print "<a href='https://serwer2241105.home.pl/logout.php' class='dropdown-item'><i class='	fa fa-user-times'></i> Wyloguj się</a>";
}else{
	print "<a href='https://serwer2241105.home.pl/login.php' class='nav-item nav-link'><i class='fa fa-user'></i><span>Zaloguj się</span></a>";
}

			?>
			</div>
			</div>
		</div>
	</div>
</nav>
</body>
</html>
