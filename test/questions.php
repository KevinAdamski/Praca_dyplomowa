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
  <a href='questionEdit.php' class='btn btn-outline-primary' type='button'>Dodaj pytanie</a>
  <br>
  <div class="list-group">
<?php
$questions_search = mysqli_query($link, "SELECT * FROM questions WHERE idu=$idu");
while ($question_grid = mysqli_fetch_array($questions_search)) {
	$question_id=$question_grid[0];
  $text=$question_grid[2];
  $answer_a=$question_grid[3];
  $answer_b=$question_grid[4];
  $answer_c=$question_grid[5];
  $answer_d=$question_grid[6];
  $address=$site_link . "questionEdit.php?id=" . $question_id;
print "<a href='$address' class='list-group-item list-group-item-action flex-column align-items-start '>
  <div class='d-flex w-100 justify-content-between'>
  </div>
  <p class='mb-1'><b>$text</b></p>
  <small>
    a)$answer_a  &nbsp
    b)$answer_b  &nbsp
    c)$answer_c &nbsp
    d)$answer_d</small>
</a>";

}
?>

</div>


  </div>
  </div>
  </div>
</div>
<?php include '../footer.php'; ?>
