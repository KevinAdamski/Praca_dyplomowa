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

if(isset($_POST['name'])){
  $team_id=$_POST['team_id'];
  $newname=$_POST['name'];
  $newimage=$_POST['image'];
  $newdescription=$_POST['opis'];
  $updateteam = mysqli_query($link, "UPDATE `teams` SET name = '$newname',description = '$newdescription', image = '$newimage' WHERE team_id = '$team_id'");
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zespoły</title>



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
}
?>
<form method="post" action='' enctype='multipart/form-data'>

			<label for="exampleInputEmail1">Nazwa zezspołu</label>
    <input type="text" class="form-control" id="name" name="name" value=" <?php echo $name; ?> "><br>


    Ikona zespołu<br>
		<ul>
  <li>
<label>
  <input type="radio" name="image" value="team_icons/1.jpg" <?php  if($image == 'team_icons/1.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/1.jpg" alt="Option 1">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/2.jpg" <?php  if($image == 'team_icons/2.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/2.jpg" alt="Option 2">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/3.jpg"<?php  if($image == 'team_icons/3.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/3.jpg" alt="Option 3">
</label>
			</li>
			 <li>
<label>
  <input type="radio" name="image" value="team_icons/4.jpg" <?php  if($image == 'team_icons/4.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/4.jpg" alt="Option 4">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/5.jpg"<?php  if($image == 'team_icons/5.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/5.jpg" alt="Option 5">
</label>
			</li>
			<br><br>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/6.jpg"<?php  if($image == 'team_icons/6.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/6.jpg" alt="Option 6">
</label>
			</li>
			 <li>
<label>
  <input type="radio" name="image" value="team_icons/7.jpg" <?php  if($image == 'team_icons/7.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/7.jpg" alt="Option 7">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/8.jpg"<?php  if($image == 'team_icons/8.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/8.jpg" alt="Option 8">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/9.jpg"<?php  if($image == 'team_icons/9.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/9.jpg" alt="Option 9">
</label>
			</li>
			<li>
<label>
  <input type="radio" name="image" value="team_icons/10.jpg"<?php  if($image == 'team_icons/10.jpg'){ echo 'checked'; }?>>
  <img src="team_icons/10.jpg" alt="Option 10">
</label>
			</li>
		</ul>
			<br>



    <label for="exampleFormControlTextarea1">Opis (opcjonalnie)</label><br>
<textarea class="form-control" id="opis" name="opis"  rows="4" cols="50" > <?php echo $description; ?>
	</textarea>
  <input type="hidden" name="team_id" id="team_id" value="<?php echo $team_id; ?>"/><br>
  <button type="submit" class="btn btn-primary">Potwierdź</button>
</form>


</div>
</div>
  </div>



	<script src="../../js/jquery-3.4.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
</html>
