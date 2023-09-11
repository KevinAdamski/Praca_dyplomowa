<?php
session_start();
require_once("../db.php");

    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');

}
if (($_SESSION['admin']) ==1){

}else{
     header('Location: ../index.php');

}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Użytkownicy</title>

    <!-- Bootstrap -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
    <link href="settings.css" rel="stylesheet">
  </head>
	<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">Lista użytkowników</h4>
    <?php
				$link=connect();
				$user_search = mysqli_query($link, "SELECT * FROM users");
while ($user_db = mysqli_fetch_array($user_search)) {
	$idu=$user_db[0];
	$name=$user_db[1];
	$surname=$user_db[2];
	$avatar=$user_db[9];
	$NS=$name . " " . $surname;
  if($avatar === NULL){
    $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
    else{
	$avatar_path="avatar/" . $idu . "/" . $avatar;}
  $link = "userrank.php?user_id=" . $idu;

		print	"		<img src='$avatar_path' style='width: 60px;height: 60px;float:left'>
    <a href='$link' style=' text-decoration: none;color:black;'><h3> &nbsp $NS</h3></a>

  </label><br>";}

			?>


</div>








	<script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</html>
<?php include '../footer.php'; ?>
