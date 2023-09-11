<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
  $link=connect();
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canCreateTest'] ==1){
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
  <a href='testEdit.php' class='btn btn-outline-primary' type='button'>Nowy test</a>
  <br>
  <div class='list-group'>
<?php
$test_search = mysqli_query($link, "SELECT * FROM test WHERE idu=$idu ORDER BY id_test DESC");
while ($test_grid = mysqli_fetch_array($test_search)) {
	$test_id=$test_grid[0];
  $test_name=$test_grid[2];
  $test_edit_link="testEdit.php?id=" . $test_id;
  $question_number = mysqli_query($link, "SELECT COUNT(id_question) AS question_number FROM test_questions WHERE id_test=$test_id");
  $number_grid = mysqli_fetch_array($question_number);
    $number_of_q=$number_grid['question_number'];
  print   "<div class='list-group'>
      <a href='$test_edit_link' class='list-group-item list-group-item-action flex-column align-items-start'>
        <div class='d-flex w-100 justify-content-between'>
          <h5 class='mb-1'>$test_name</h5>
          <small>$number_of_q</small>
        </div>
      </a>
    </div>";
  }
?>
</div>


  </div>
  </div>
  </div>
</div>
<?php include '../footer.php'; ?>
