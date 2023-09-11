<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
  $link=connect();
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>
<br></br>
<div class="container">
  <div class="row">
<div class="col-sm">
<?php
$test_id=$_POST['test_id'];
$test_values_search = mysqli_query($link, "SELECT * FROM test WHERE id_test=$test_id");
        while ($test_values_grid = mysqli_fetch_array($test_values_search)) {
          $test_name=$test_values_grid[2];
          $test_time=$test_values_grid[3];
          $test_pass_value=$test_values_grid[4];
        }
$test_count_search = mysqli_query($link, "SELECT COUNT(id_question) AS counted_questions FROM test_questions WHERE id_test='$test_id'");
$test_count_grid = mysqli_fetch_array($test_count_search);
$question_count=$test_count_grid['counted_questions'];

$pass_percentage=$test_pass_value * 0.01;
$pass_question_number=ceil($pass_percentage * $question_count);

echo "<h3>$test_name</h3><br>";


echo   "<ul class='list-group'>";
$question_number=0;
$points=0;
$test_users_id=$_POST['test_users_id'];

$questions_search=mysqli_query($link, "SELECT * FROM questions WHERE id_question IN(SELECT id_question FROM test_questions WHERE id_test=$test_id)");
  while ($questions_grid = mysqli_fetch_array($questions_search)) {
    $id_question=$questions_grid[0];
    $text_question=$questions_grid[2];
    $answer_a=$questions_grid[3];
    $answer_b=$questions_grid[4];
    $answer_c=$questions_grid[5];
    $answer_d=$questions_grid[6];
    $value_a=$questions_grid[7];
    $value_b=$questions_grid[8];
    $value_c=$questions_grid[9];
    $value_d=$questions_grid[10];
    $question_number=$question_number +1;

//Pobieranie grafiki
    $image_path="question_files/" . $id_question . "/";
    $image_array=scandir($image_path);
    $image=$image_array[2];

//Wprowadzanie numeru Pytania
$text_question_show="<b>" . $question_number . ".</b>" . $text_question;
echo   "<li class='list-group-item'>";
if(isset($image)){
  $image_show=$image_path . $image;
echo  "<img src='$image_show' class='img-fluid' style='max-height:400px'><br>";
}
echo $text_question_show;
$question_value=$_POST[$id_question];

if($value_a==1 && $question_value==1){
  echo "<br><b style='color:green'>a)  $answer_a </b>";
  $points=$points+1;
}else if($value_a==0 && $question_value==1){
  echo "<br><b style='color:red'>a)  $answer_a </b>";
}else if($value_a==1){
    echo "<br><b style='color:green'>a)  $answer_a </b>";
}else{
  echo "<br>a)  $answer_a ";
}


if($value_b==1 && $question_value==2){
  echo "<br><b style='color:green'>b)  $answer_b </b>";
  $points=$points+1;
}else if($value_b==0 && $question_value==2){
  echo "<br><b style='color:red'>b)  $answer_b </b>";
}else if($value_b==1){
    echo "<br><b style='color:green'>b)  $answer_b </b>";
}else{
  echo "<br>b)  $answer_b ";
}

if($value_c==1 && $question_value==3){
  echo "<br><b style='color:green'>c)  $answer_c </b>";
  $points=$points+1;
}else if($value_c==0 && $question_value==3){
  echo "<br><b style='color:red'>c)  $answer_c </b>";
}else if($value_c==1){
    echo "<br><b style='color:green'>c)  $answer_c </b>";
}else{
  echo "<br>c)  $answer_c ";
}


if($value_d==1 && $question_value==4){
  echo "<br><b style='color:green'>d)  $answer_d </b>";
  $points=$points+1;
}else if($value_d==0 && $question_value==4){
  echo "<br><b style='color:red'>d)  $answer_d </b>";
}else if($value_d==1){
    echo "<br><b style='color:green'>d)  $answer_d </b>";
}else{
  echo "<br>d)  $answer_d ";
}
}
echo "</ul><br>";
$check_value=mysqli_query($link, "SELECT value FROM test_users WHERE id_test_users=$test_users_id");
$check_value_grid=mysqli_fetch_array($check_value);
$test_users_value=$check_value_grid['value'];
if($test_users_value==0){
$insert_results=mysqli_query($link, "INSERT INTO `test_results` (`id_test`,`idu`,`points_1`,`points_2`) VALUES ('$test_id','$idu','$points','$question_count')");
$end_test=mysqli_query($link, "UPDATE test_users SET value=2 WHERE id_test_users=$test_users_id");
}
if($points >=$pass_question_number){
    echo "<b style='color:green'>Test zaliczony </b>";
}else{
  echo "<b style='color:red'>Test niezaliczony</b>";
}
echo "<br>Punktacja: ";
echo $points . "/" . $question_count;
?>
<br>
<a class="btn btn-primary" href="index.php" role="button">Zakończ</a>
</div>

</div>
</div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
