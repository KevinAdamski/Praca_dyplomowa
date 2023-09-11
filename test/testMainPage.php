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


if(isset($_POST['cancel_test'])){
$cancel_test_query=mysqli_query($link, "UPDATE test_users SET value=1 WHERE id_test_users=$test_users_id");
  header('Location: index.php');
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $test_name; ?></title>




    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>
<br></br>
<div class="container">
  <div class="row">
<div class="col-sm">
  <?php
  $test_link="testStart.php?id=" . $test_users_id;
  echo "<h3>$test_name</h3><br>";
 echo "<b>Liczba pytań: </b> $question_count <br>";
 echo "<b>Poprawne odpowiedzi wymagane do zaliczenia: </b> $pass_question_number <br>";
 if($test_time != 0){
   echo "<b>Czas na wykonanie testu: </b> $time_formatted <br>";
 }
   ?>
   <br></br>
   <div style="display: inline-block;">
           <a href='<?php echo $test_link; ?>' class='btn btn-primary' type='button'>Rozpocznij Test</a>
           <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
           Zrezygnuj
         </button>

         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">

               <div class="modal-body">
                 Napewno chcesz zrezygnować z testu?
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                 <form method="post" action='' enctype='multipart/form-data'>
                   <input type='hidden' name='cancel_test' value='1'/>
                   <button type="submit" class="btn btn-danger">Rezygnuj</button>

                 </form>
               </div>
             </div>
           </div>
         </div>
        </div>
</div>


  </div>
  </div>
  </div>
</div>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <?php include '../footer.php'; ?>
