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
$link=connect();
$team_id=$_POST['team_id'];
include "bottombar.php";
if(isset($_POST['user_id_delete'])){
  $user_id_delete=$_POST['user_id_delete'];
  $x=0;
  $number =  sizeof($user_id_delete);
  while($x < $number){
    $user_to_delete=$user_id_delete[$x];
    $x++;

    $delete_users = mysqli_query($link, "DELETE FROM `teams_users` WHERE idu = $user_to_delete AND team_id= $team_id");

}
}

if(isset($_POST['user_id_add'])){
  $user_id_add=$_POST['user_id_add'];
  $y=0;
  $number2 =  sizeof($user_id_add);
  while($y < $number2){
    $user_to_add=$user_id_add[$y];
    $y++;

    $add_users = mysqli_query($link, "INSERT INTO `teams_users` (`team_id`,`idu`) VALUES ('$team_id','$user_to_add')");

}
}
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
      <style>
	  ul {
  list-style-type: none;
}

li {
  display: inline-block;
}





label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}



	  [type=radio] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}


[type=radio] + img {
  cursor: pointer;
}


[type=radio]:checked + img {
  outline: 3px solid blue;
}

	  </style>
  </head>

<div class="container">
  <div class="row">
<div class="col-3">
      <?php include 'sidebar.php';?>
	  </div>

	<div class="col-md-auto">
		<br><br>
		<?php
if(isset($_POST['team_id'])){
$team_id=$_POST['team_id'];
$link=connect();
$team_search = mysqli_query($link, "SELECT * FROM teams WHERE team_id = '$team_id'");
while ($team_db = mysqli_fetch_array($team_search)) {
	$creator_user_id=$team_db[1];
	$name=$team_db[2];
	$description=$team_db[3];
    $image=$team_db[4];

}
print "<img src='$image' style='width: 100px;height: 100px;display: inline-block'>
&nbsp <h2 style='display: inline-block'>$name</h2>
<div class'opis' style=' max-width: 50%;'>$description</div> ";
}
?>
	<form method="post" action="team_edit.php" enctype='multipart/form-data'>
  <input type="hidden" name="team_id" id="team_id" value="<?php echo $team_id; ?>"/>
	<button type="submit" class="btn btn-primary">Edytuj</button></form>
<br><br>
<h3>Członkowie zespołu</h3>
<form method="post" action="" enctype='multipart/form-data'>
<div class='list-group'>
<?php

$user_team_search = mysqli_query($link, "SELECT * FROM teams_users WHERE team_id = $team_id ");
while ($user_team_db = mysqli_fetch_array($user_team_search)) {
	$user_id=$user_team_db[2];

	$user_in_team = mysqli_query($link, "SELECT * FROM users WHERE idu = $user_id ");
while ($user_in_team_db = mysqli_fetch_array($user_in_team)) {
  $name=$user_in_team_db[1];
	$surname=$user_in_team_db[2];
	$avatar=$user_in_team_db[9];
	$NS=$name . " " . $surname;
  if($avatar === NULL){
    $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
    else{
  $avatar_path="../settings/avatar/" . $user_id . "/" . $avatar;}
print "<label class='list-group-item' style='font-size: 2em;width:500px;'>
<input class='form-check-input me-1' type='checkbox' value='$user_id' name='user_id_delete[]'>
$NS
    <img src='$avatar_path' style='width: 60px;height: 60px;float:right'>
</label>";
}
}
print "<input type='hidden' name='team_id' id='$team_id' value='$team_id'/>";
?>

</div><br>
<button type="submit" class="btn btn-danger">Usuń zaznaczonych członków</button>
</form>







<br>
<br>
<h3>Dodaj do zespołu</h3>
<form method="post" action="" enctype='multipart/form-data'>
<div class='list-group'>
<?php
$user_add_team = mysqli_query($link, "SELECT * FROM users WHERE canDoTask = 1 AND  idu NOT IN
(SELECT idu FROM teams_users WHERE team_id=$team_id) AND idu != '$idu'");
while ($user_add_list = mysqli_fetch_array($user_add_team)) {
  $user_id=$user_add_list[0];
  $name=$user_add_list[1];
	$surname=$user_add_list[2];
	$avatar=$user_add_list[9];
	$NS=$name . " " . $surname;
  if($avatar === NULL){
    $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
    else{
      $avatar_path="https://serwer2241105.home.pl/settings/avatar/" . $idu . "/" . $avatar;}
print "<label class='list-group-item' style='font-size: 2em;width:500px;'>
<input class='form-check-input me-1' type='checkbox' value='$user_id' name='user_id_add[]'>
$NS
    <img src='$avatar_path' style='width: 60px;height: 60px;float:right'>
</label>";
}

print "<input type='hidden' name='team_id' id='$team_id' value='$team_id'/>";
?>

</div><br>
<button type="submit" class="btn btn-primary">Dodaj zaznaczonych członków</button>
</form>


</div>
</div>
  </div>



	<script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
</html>
