<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
  $link=connect();
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }
if(isset($_GET['id'])){
  $test_users_id=$_GET['id'];
  $id_check=mysqli_query($link, "SELECT * FROM test_users WHERE idu=$idu AND id_test_users=$test_users_id AND value=0");
  if(mysqli_num_rows($id_check)==0){ header('Location: ../index.php'); }
}else{
  header('Location: ../index.php');
}
$test_values_search = mysqli_query($link, "SELECT * FROM test WHERE id_test IN(SELECT id_test FROM test_users WHERE id_test_users=$test_users_id)");
        while ($test_values_grid = mysqli_fetch_array($test_values_search)) {
          $test_id=$test_values_grid[0];
          $test_name=$test_values_grid[2];
          $test_time=$test_values_grid[3];
          $test_pass_value=$test_values_grid[4];
        }
$test_count_search = mysqli_query($link, "SELECT COUNT(id_question) AS counted_questions FROM test_questions WHERE id_test='$test_id'");
$test_count_grid = mysqli_fetch_array($test_count_search);
$question_count=$test_count_grid['counted_questions'];

$pass_percentage=$test_pass_value * 0.01;
$pass_question_number=ceil($pass_percentage * $question_count);
$time_formatted=$test_time . ":00";

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
  <form method="post" id="testForm" action='testCheckResult.php' enctype='multipart/form-data'>
 <?php
  $test_link="testStart.php?id=" . $test_users_id;
  echo "<h3>$test_name</h3><br>";
  echo "<div>Pozostały czas <span id='timer'></span></div>";
  echo   "<ul class='list-group'>";
 $question_number=0;
  $questions_search=mysqli_query($link, "SELECT * FROM questions WHERE id_question IN(SELECT id_question FROM test_questions WHERE id_test=$test_id)");
    while ($questions_grid = mysqli_fetch_array($questions_search)) {
      $id_question=$questions_grid[0];
      $text_question=$questions_grid[2];
      $answer_a=$questions_grid[3];
      $answer_b=$questions_grid[4];
      $answer_c=$questions_grid[5];
      $answer_d=$questions_grid[6];
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
echo "<div class='form-check'>
  <input class='form-check-input' type='radio' name='$id_question' value='1'>
  <label class='form-check-label' for='flexRadioDefault1'> $answer_a
  </label>
</div>
<div class='form-check'>
  <input class='form-check-input' type='radio' name='$id_question' value='2'>
  <label class='form-check-label' for='flexRadioDefault1'> $answer_b
  </label>
</div>
<div class='form-check'>
  <input class='form-check-input' type='radio' name='$id_question' value='3'>
  <label class='form-check-label' for='flexRadioDefault1'> $answer_c
  </label>
</div>
<div class='form-check'>
  <input class='form-check-input' type='radio' name='$id_question' value='4'>
  <label class='form-check-label' for='flexRadioDefault1'> $answer_d
  </label>
</div>";

echo   "</li>";
echo "<input type='hidden' name='test_id' value='$test_id'/>";
echo "<input type='hidden' name='test_users_id' value='$test_users_id'/>";
}
  echo "</ul>";
$time_in_miliseconds=$test_time * 60000;
  ?>

<br></br>  <button type="submit" class="btn btn-primary">Potwierdź</button>
</div>


  </div>
  </div>
  </div>
</div>
<script>
//Przypisanie czasu w milisekundach
var varTimerInMiliseconds = <?php echo $time_in_miliseconds;?>;
setTimeout(function(){

  //Przesłanie formularza po upływie czasu
    document.getElementById("testForm").submit();
}, varTimerInMiliseconds);

//Wyświetlenie początkowego licznika
document.getElementById('timer').innerHTML =
  <?php echo $test_time;?> + ":" + 00;
startTimer();

//Funkcja odliczająca czas
function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if(m<0){
    return
  }

  //Aktualizacja licznika
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  console.log(m)
  setTimeout(startTimer, 1000);
}

//funkcja sprawdzająca sekundy
function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec};
  if (sec < 0) {sec = "59"};
  return sec;
}
</script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <?php include '../footer.php'; ?>
