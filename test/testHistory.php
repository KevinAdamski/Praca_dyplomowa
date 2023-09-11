<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
  $link=connect();
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canDoTest'] ==1){
}else{     header('Location: ../index.php'); }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historia testów</title>



    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>
<br></br>
<div class="container">
  <div class="row">
<div class="col-sm">
  <div class='d-grid gap-2'>
  <div class='list-group'>


<?php
$search_users_test=mysqli_query($link, "SELECT * FROM test_results WHERE idu=$idu ORDER BY datatime DESC");
  while ($search_users_grid = mysqli_fetch_array($search_users_test)) {
    $test_id=$search_users_grid[1];
    $points_1=$search_users_grid[3];
    $points_2=$search_users_grid[4];
    $datatime=$search_users_grid[5];
$search_test_values=mysqli_query($link, "SELECT * FROM test WHERE id_test=$test_id");
$search_test_grid = mysqli_fetch_array($search_test_values);
$name=$search_test_grid['name'];
$pass_value=$search_test_grid['pass_value'];
$pass_percentage=$pass_value * 0.01;
$pass_question_number=ceil($pass_percentage * $points_2);

print "<div class='list-group-item list-group-item-action flex-column align-items-start'>
  <div class='d-flex w-100 justify-content-between'>
    <h5 class='mb-1'>$name</h5>
    <small>$datatime</small>
  </div>
  <p class='mb-1'>";
if($points_1 >= $pass_question_number){
  echo "<b style='color:green'>Test zaliczony </b>";
}else{
  echo "<b style='color:red'>Test niezaliczony</b>";
}
echo "</br>Punktacja: " . $points_1 . "/" . $points_2;
  print "</small>
</div>";
}
?>
</div>


  </div>
  </div>
  </div>
</div>
<?php include '../footer.php'; ?>
