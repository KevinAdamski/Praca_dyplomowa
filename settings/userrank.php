<?php
session_start();
require_once("../db.php");

    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin'] ))
{
     header('Location: ../index.php');

}
if (($_SESSION['admin']) ==1){

}else{
     header('Location: ../index.php');

}
$user_id=$_GET['user_id'];
$link=connect();
if(isset($_POST['canDoTask'])){
  $canDoTask_update=$_POST['canDoTask'];
  $update_canDoTask = mysqli_query($link, "UPDATE `users` SET canDoTask = '$canDoTask_update' WHERE idu = '$user_id'");
}

if(isset($_POST['canCreateTask'])){
  $canCreateTask_update=$_POST['canCreateTask'];
  $update_canCreateTask = mysqli_query($link, "UPDATE `users` SET canCreateTask = '$canCreateTask_update' WHERE idu = '$user_id'");
}

if(isset($_POST['canTeam'])){
  $canTeam_update=$_POST['canTeam'];
  $update_canTeam = mysqli_query($link, "UPDATE `users` SET canTeam = '$canTeam_update' WHERE idu = '$user_id'");
}
if(isset($_POST['canNews'])){
  $canNews_update=$_POST['canTeam'];
  $update_canNews = mysqli_query($link, "UPDATE `users` SET canNews = '$canNews_update' WHERE idu = '$user_id'");
}
if(isset($_POST['canDoTest'])){
  $canDoTest_update=$_POST['canDoTest'];
  $update_canDoTest = mysqli_query($link, "UPDATE `users` SET canDoTest = '$canDoTest_update' WHERE idu = '$user_id'");
}
if(isset($_POST['canCreateTest'])){
  $canCreateTest_update=$_POST['canCreateTest'];
  $update_canCreateTest = mysqli_query($link, "UPDATE `users` SET canCreateTest = '$canCreateTest_update' WHERE idu = '$user_id'");
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Użytkownicy</title>



    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
    <link href="settings.css" rel="stylesheet">
  </head>
	<div class="wrapper bg-white mt-sm-5">
        <?php
        $link=connect();
        $result = mysqli_query($link, "SELECT * FROM users WHERE idu='$user_id'");
        $record = mysqli_fetch_array($result);
        $name=$record['name'];
        $surname=$record['surname'];
        $avatar=$record['avatar'];
        $canDoTask=$record['canDoTask'];
        $canCreateTask=$record['canCreateTask'];
        $canTeam=$record['canTeam'];
        $canNews=$record['canNews'];
        $canDoTest=$record['canDoTest'];
        $canCreateTest=$record['canCreateTest'];
        $NS=$name . " " . $surname;
        if($avatar === NULL){
          $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
          else{
        $avatar_path="avatar/" . $idu . "/" . $avatar;}
        ?>

    <h2 class="pb-4 border-bottom"><img src=<?php echo $avatar_path; ?> style='width: 60px;height: 60px;float:left'>
    &nbsp <?php echo $NS; ?> </h2>


    <form method="post" action="" enctype='multipart/form-data'>

<h3>
<div class='form-check form-switch'>
<input type='hidden' name='canDoTask'  value='0'/>
<input class='form-check-input' type='checkbox' value='1' name='canDoTask' <?php if($canDoTask == 1){ echo "checked" ;} ?>>
Wykonywanie zadań
</div></h3>

<br>
<h3>
<div class='form-check form-switch'>
<input type='hidden' name='canCreateTask'  value='0'/>
<input class='form-check-input' type='checkbox' value='1' name='canCreateTask' <?php if($canCreateTask == 1){ echo "checked" ;} ?>>
Tworzenie zadań
</div></h3>
<br>

<h3>
<div class='form-check form-switch'>
<input type='hidden' name='canTeam'  value='0'/>
<input class='form-check-input' type='checkbox' value='1' name='canTeam' <?php if($canTeam == 1){ echo "checked" ;} ?>>
Tworzenie zespołów
</div></h3>

<br>
<h3>
<div class='form-check form-switch'>
<input type='hidden' name='canNews'  value='0'/>
<input class='form-check-input' type='checkbox' value='1' name='canNews' <?php if($canNews == 1){ echo "checked" ;} ?>>
Pisanie Aktualności
</div></h3>
<br>
<h3>
<div class='form-check form-switch'>
<input type='hidden' name='canDoTest'  value='0'/>
<input class='form-check-input' type='checkbox' value='1' name='canDoTest' <?php if($canDoTest == 1){ echo "checked" ;} ?>>
Wykonywanie Testów
</div></h3>
<br>
<h3>
<div class='form-check form-switch'>
<input type='hidden' name='canCreateTest'  value='0'/>
<input class='form-check-input' type='checkbox' value='1' name='canCreateTest' <?php if($canCreateTest == 1){ echo "checked" ;} ?>>
Tworzenie testów
</div></h3>
<br>
<button type="submit" class="btn btn-primary">Aktualizuj</button>
</div><br>
</form>

</div>


	<script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</html>
<?php include '../footer.php'; ?>
