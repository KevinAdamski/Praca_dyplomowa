<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
  $link=connect();
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canCreateTest'] ==1){
}else{     header('Location: ../index.php'); }

if(isset($_GET['id'])){
  $test_id=$_GET['id'];
  $id_check=mysqli_query($link, "SELECT * FROM test WHERE idu=$idu AND id_test=$test_id");
  if(mysqli_num_rows($id_check)==0){ header('Location: ../index.php'); }

  $test_name_search = mysqli_query($link, "SELECT * FROM test WHERE id_test='$test_id'");
  $test_name_grid = mysqli_fetch_array($test_name_search);
    $test_name=$test_name_grid['name'];
    $pass_value=$test_name_grid['pass_value'];
    $time=$test_name_grid['time'];
}
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
  <div class="list-group">
    <form method="post" action="testEditRun.php" enctype='multipart/form-data'>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Tytuł testu</label>
        <input type="text" class="form-control" name='title' placeholder="Nazwa testu" <?php if(isset($_GET['id'])){echo "value='$test_name'";}?> required>
        <label for="exampleFormControlInput1" class="form-label">Procent poprawnych odpowiedzi wymagany za zaliczenie</label>
        <input type="number" class="form-control" name='pass_value' style='width:90px' <?php if(isset($_GET['id'])){echo "value='$pass_value'";}?>  min="1" max="100" required>
        <label for="exampleFormControlInput1" class="form-label">Czas na wykonanie testu(w minutach)</label>
        <input type="number" class="form-control" name='time' style='width:90px' <?php if(isset($_GET['id'])){echo "value='$time'";}?> >
      </div>
<?php
$question_search_querry="SELECT * FROM questions WHERE idu=$idu";
if(isset($_GET['id'])){
  print "<a class='btn btn-primary' href='testUsers.php?id=$test_id' role='button'>Przydziel test</a><br><br>";
  echo "Usuń pytania<br>";
  print "<input type='hidden' name='edit' value='$test_id'>";

    $questions_actual_search = mysqli_query($link, "SELECT * FROM questions WHERE id_question IN (SELECT id_question
      FROM test_questions WHERE id_test='$test_id')");
    while ($question_actual_grid = mysqli_fetch_array($questions_actual_search)) {
      $question_id=$question_actual_grid[0];
      $text=$question_actual_grid[2];
      $answer_a=$question_actual_grid[3];
      $answer_b=$question_actual_grid[4];
      $answer_c=$question_actual_grid[5];
      $answer_d=$question_actual_grid[6];
    print "<a class='list-group-item list-group-item-action flex-column align-items-start '>
      <div class='d-flex w-100 justify-content-between'>
      </div>
      <div class='form-check' style='float:right;font-size:30px'>
        <input class='form-check-input' type='checkbox' value='$question_id' name='question_to_delete[]'>
      </div>
      <p class='mb-1'><b>$text</b></p>
      <small>
        a)$answer_a  &nbsp
        b)$answer_b  &nbsp
        c)$answer_c &nbsp
        d)$answer_d</small>
    </a>";
}
$question_search_querry="SELECT * FROM questions WHERE id_question NOT IN (SELECT id_question
  FROM test_questions WHERE id_test='$test_id')";
}
echo "<br>Dodaj pytania<br>";
$questions_search = mysqli_query($link, $question_search_querry);
while ($question_grid = mysqli_fetch_array($questions_search)) {
	$question_id=$question_grid[0];
  $text=$question_grid[2];
  $answer_a=$question_grid[3];
  $answer_b=$question_grid[4];
  $answer_c=$question_grid[5];
  $answer_d=$question_grid[6];
print "<a class='list-group-item list-group-item-action flex-column align-items-start '>
  <div class='d-flex w-100 justify-content-between'>
  </div>
  <div class='form-check' style='float:right;font-size:30px'>
    <input class='form-check-input' type='checkbox' value='$question_id' name='question_to_add[]'>
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
<br></br>
<button type="submit" class="btn btn-primary">Aktualizuj test</button>
</form>
</div>


  </div>
  </div>
  </div>
</div>
<?php include '../footer.php'; ?>
