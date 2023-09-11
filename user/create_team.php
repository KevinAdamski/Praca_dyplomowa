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
		<form method="post" action="create_team_execute.php" enctype='multipart/form-data'>

			<label for="exampleInputEmail1">Nazwa zezspołu</label>
    <input type="text" class="form-control" id="name" name="name" required><br>
			Ikona zespołu<br>
		<ul>
  <li>
<label>
  <input type="radio" name="image" value="team_icons/1.jpg" checked>
  <img src="team_icons/1.jpg" alt="Option 1">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/2.jpg">
  <img src="team_icons/2.jpg" alt="Option 2">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/3.jpg">
  <img src="team_icons/3.jpg" alt="Option 3">
</label>
			</li>
			 <li>
<label>
  <input type="radio" name="image" value="team_icons/4.jpg" >
  <img src="team_icons/4.jpg" alt="Option 4">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/5.jpg">
  <img src="team_icons/5.jpg" alt="Option 5">
</label>
			</li>
			<br><br>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/6.jpg">
  <img src="team_icons/6.jpg" alt="Option 6">
</label>
			</li>
			 <li>
<label>
  <input type="radio" name="image" value="team_icons/7.jpg" >
  <img src="team_icons/7.jpg" alt="Option 7">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/8.jpg">
  <img src="team_icons/8.jpg" alt="Option 8">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/9.jpg">
  <img src="team_icons/9.jpg" alt="Option 9">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/10.jpg">
  <img src="team_icons/10.jpg" alt="Option 10">
</label>
			</li>
		</ul>
			<br>
			<label for="exampleFormControlTextarea1">Opis (opcjonalnie)</label><br>
<textarea class="form-control" id="opis" name="opis" rows="4" cols="50">
	</textarea>
			<br>
			Wybierz członków zespołu<br>
			<div class='list-group'>
				<?php
				$link=connect();
				$user_search = mysqli_query($link, "SELECT * FROM users WHERE canDoTask = 1 AND idu != '$idu'");
while ($user_db = mysqli_fetch_array($user_search)) {
	$idu=$user_db[0];
	$name=$user_db[1];
	$surname=$user_db[2];
	$avatar=$user_db[9];
	$NS=$name . " " . $surname;
	if($avatar === NULL){
		$avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
		else{
	  $avatar_path="../settings/avatar/" . $idu . "/" . $avatar;}

		print	"<label class='list-group-item' style='font-size: 2em'>
    <input class='form-check-input me-1' type='checkbox' value='$idu' name='user_id[]' >

    $NS
				<img src='$avatar_path' style='width: 60px;height: 60px;float:right'>
  </label>";}

			?>
				</div>


			<br>
			 <button type="submit" class="btn btn-primary">Submit</button>
</form>
	  </div>





	<script>
		$('.check input:checkbox').click(function() {
    $('.check input:checkbox').not(this).prop('checked', false);
});
	</script>


	<script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
</html>
