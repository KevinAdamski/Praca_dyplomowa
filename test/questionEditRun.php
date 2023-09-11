<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canCreateTest'] ==1){
}else{     header('Location: ../index.php'); }
$link=connect();
$text=$_POST['text'];
$radio=$_POST['correct_answer'];
$value_a=0;
$value_b=0;
$value_c=0;
$value_d=0;
if($radio==1){$value_a=1;}
else if($radio==2){$value_b=1;}
else if($radio==3){$value_c=1;}
else if($radio==4){$value_d=1;}
$answer_a=$_POST['answer_a'];
$answer_b=$_POST['answer_b'];
$answer_c=$_POST['answer_c'];
$answer_d=$_POST['answer_d'];

if(isset($_POST['edit'])){
  $edit_id=$_POST['edit'];
  $edit_questtion = mysqli_query($link, "UPDATE `questions` SET text = '$text',answer_a='$answer_a',answer_b='$answer_b',answer_c='$answer_c'
    ,answer_d='$answer_d',value_a='$value_a',value_b='$value_b',value_c='$value_c',value_d='$value_d' WHERE id_question = '$edit_id'");

    if(isset($_POST['delete_file']) && $_POST['delete_file']==1 || isset($_FILES['file'])){
      $image_to_delete=$_POST['delete_file_path'];
      unlink($image_to_delete);
    }
    if(isset($_FILES['file'])){
       $filename = $_FILES['file']['name'];
       $filepath = "question_files/" . $edit_id . "/";
       move_uploaded_file($_FILES['file']['tmp_name'],$filepath.$filename);  }

    header('Location: questions.php');
}else{
$insert = mysqli_query($link,
"INSERT INTO `questions` (`idu`,`text`,`answer_a`,`answer_b`,`answer_c`,`answer_d`,`value_a`,`value_b`,`value_c`,`value_d`)
        VALUES ('$idu','$text','$answer_a','$answer_b','$answer_c','$answer_d','$value_a','$value_b','$value_c','$value_d');");
        $last_id = mysqli_insert_id($link);
        $filepath = "question_files/" . $last_id . "/";
        mkdir($filepath,0777);

        if(isset($_FILES['file'])){
        	 $filename = $_FILES['file']['name'];
        	 move_uploaded_file($_FILES['file']['tmp_name'],$filepath.$filename);

        }
        header('Location: questions.php');
}






?>
