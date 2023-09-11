<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canCreateTest'] ==1){
}else{     header('Location: ../index.php'); }
$link=connect();


$test_title=$_POST['title'];
$pass_value=$_POST['pass_value'];
$time=$_POST['time'];

if(isset($_POST['edit'])){
  $test_id=$_POST['edit'];
  $edit_test_name = mysqli_query($link, "UPDATE `test` SET name='$test_title',pass_value=$pass_value,time='$time' WHERE id_test=$test_id");


  if(isset($_POST['question_to_add'])){
    $question_to_add=$_POST['question_to_add'];
    $y=0;
    $question_number =  sizeof($question_to_add);
    while($y < $question_number){
      $question_id=$question_to_add[$y];
      $y++;
      $add_question = mysqli_query($link, "INSERT INTO `test_questions` (`id_question`,`id_test`) VALUES ('$question_id','$test_id')");
}
}
if(isset($_POST['question_to_delete'])){
  $question_to_delete=$_POST['question_to_delete'];
  $y=0;
  $question_number =  sizeof($question_to_delete);
  while($y < $question_number){
    $question_id=$question_to_delete[$y];
    $y++;
    $delete_question = mysqli_query($link, "DELETE FROM `test_questions` WHERE id_question='$question_id'");
}
}

}else{

$insert = mysqli_query($link,"INSERT INTO `test` (`idu`,`name`,`pass_value`,`time`) VALUES ('$idu','$test_title','$pass_value','$time')");
$last_id = mysqli_insert_id($link);

if(isset($_POST['question_to_add'])){
  $question_to_add=$_POST['question_to_add'];
  $y=0;
  $question_number =  sizeof($question_to_add);
  while($y < $question_number){
    $question_id=$question_to_add[$y];
    $y++;

    $add_question = mysqli_query($link, "INSERT INTO `test_questions` (`id_question`,`id_test`) VALUES ('$question_id','$last_id')");

}
}
}
header('Location: testList.php');
?>
