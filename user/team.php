<?php
session_start();
require_once("../db.php");

    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');

}
if (($_SESSION['canTeam']) ==1){

}else{
     header('Location: ../index.php');

}

include "bottombar.php";
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zespoły</title>

    <!-- Bootstrap -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>

<div class="container">
  <div class="row">
<div class="col-3">
      <?php include 'sidebar.php';?>
	  </div>

	<div class="col-md-auto">
		<br><br>
		<?php
		if($_GET['team_added'] == true){
			print "<div class='alert alert-success' role='alert'>
 Zespół dodany pomyślnie
</div>";
    }?>
<form method="post" action="create_team.php" enctype='multipart/form-data'>
	<button type="submit" class="btn btn-primary">Utwórz nowy zespół</button></form><br><br>

		<?php
  $link=connect();
$team_search = mysqli_query($link, "SELECT * FROM teams WHERE creator_user_id = '$idu'");
while ($team_db = mysqli_fetch_array($team_search)) {
	$team_id=$team_db[0];
	$name=$team_db[2];
	$description=$team_db[23];
	$image=$team_db[4];

		print	"<form method='post' action='team_page.php' enctype='multipart/form-data'>
    <button type='submit' class='btn btn-outline-dark btn-lg' style='width: 400px;font-size: 28px;text-align:left'>&nbsp$name
    <img src='$image' style='width: 70px;height: 70px;float:left'>
    <input type='hidden' name='team_id' id='$team_id' value='$team_id'/>
    </button></form>
    ";}
?>

		   </div>
  </div>
</div>









	<script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
</html>
