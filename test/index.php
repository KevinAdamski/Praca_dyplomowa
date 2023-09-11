<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canDoTest'] ==1 || $_SESSION['canCreateTest'] ==1){
}else{     header('Location: ../index.php'); }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Testy</title>



    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>
<br></br>
<div class="container">
  <div class="row">
<div class="col-sm">
  <div class='d-grid gap-2'>
  <a href='testHistory.php' class='btn btn-outline-success' type='button'>Historia Testów</a>
  <div class='list-group'>
<?php
$test_users_search=mysqli_query($link, "SELECT * FROM test_users WHERE idu=$idu AND value=0");
while ($users_grid = mysqli_fetch_array($test_users_search)) {
$test_users_id=$users_grid[0];
$test_id=$users_grid[2];

$test_search = mysqli_query($link, "SELECT * FROM test WHERE id_test=$test_id");
while ($test_grid = mysqli_fetch_array($test_search)) {
  $test_name=$test_grid[2];
  $test_MainPage_link="testMainPage.php?id=" . $test_users_id;

  print   "<div class='list-group'>
      <a href='$test_MainPage_link' class='list-group-item list-group-item-action flex-column align-items-start'>
        <div class='d-flex w-100 justify-content-between'>
          <h5 class='mb-1'>$test_name</h5>
        </div>
      </a>
    </div>";
  }
}
?>
</div>
	  </div>
  </div><br></br>
<?php
if($_SESSION['canCreateTest']==1){
print 	"<div class='col-sm'>

<div class='d-grid gap-2'>
<a href='questions.php' class='btn btn-outline-primary' type='button'>Pytania</a>
<a href='testList.php' class='btn btn-outline-primary' type='button'>Twoje Testy</a>
</div>
		   </div>";
}
       ?>
  </div>
</div>








	<script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
</html>
<?php include '../footer.php'; ?>
