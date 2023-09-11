<?php
session_start();
require_once("../db.php");
$link=connect();
  $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canCreateTest'] ==1){
}else{     header('Location: ../index.php'); }

if(isset($_GET['id'])){
  $question_id=$_GET['id'];
  $id_check=mysqli_query($link, "SELECT * FROM questions WHERE idu=$idu AND id_question=$question_id");
  if(mysqli_num_rows($id_check)==0){ header('Location: ../index.php'); }
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

  <form method="post" action="questionEditRun.php" enctype='multipart/form-data'>
     <div class="form-group">
<?php
if(isset($_GET['id'])){
print "<input type='hidden' name='edit' value='$question_id'>";
$question_edit_search = mysqli_query($link, "SELECT * FROM questions WHERE id_question='$question_id'");
$edit_grid = mysqli_fetch_array($question_edit_search);
  $text_edit=$edit_grid['text'];
  $answer_a_edit=$edit_grid['answer_a'];
  $answer_b_edit=$edit_grid['answer_b'];
  $answer_c_edit=$edit_grid['answer_c'];
  $answer_d_edit=$edit_grid['answer_d'];
  $value_a_edit=$edit_grid['value_a'];
  $value_b_edit=$edit_grid['value_b'];
  $value_c_edit=$edit_grid['value_c'];
  $value_d_edit=$edit_grid['value_d'];

  $image_path="question_files/" . $question_id . "/";
  $image_array=scandir($image_path);
  $image=$image_array[2];
  if(isset($image)){
    $image_show=$image_path . $image;
  echo  "<img src='$image_show' class='img-fluid' style='max-height:400px'><br>";
  }
} ?>
       <label for="exampleFormControlTextarea1">Treść pytania</label><br>
       <textarea class="form-control" id="text" name="text" required rows="4" cols="75"> <?php if(isset($_GET['id'])){echo $text_edit;} ?>
       </textarea><br>


<div class="form-check" style="font-size:28px">
  <input class="form-check-input" type="radio" name="correct_answer" value='1' <?php if(isset($_GET['id']) && $value_a_edit==1){echo "checked";}?> required>
  <label class="form-check-label" for="flexRadioDefault1">
    <input type="text" class="form-control" id="answer_a" name="answer_a" <?php if(isset($_GET['id'])){ print "value=$answer_a_edit";} ?> required><br>
  </label>
</div>
<div class="form-check" style="font-size:28px">
  <input class="form-check-input" type="radio" name="correct_answer"  value='2'<?php if(isset($_GET['id']) && $value_b_edit==1){echo "checked";}?> >
  <label class="form-check-label" for="flexRadioDefault1">
    <input type="text" class="form-control" id="answer_b" name="answer_b" <?php if(isset($_GET['id'])){ print "value=$answer_b_edit";} ?> required><br>
  </label>
</div>
<div class="form-check" style="font-size:28px">
  <input class="form-check-input" type="radio" name="correct_answer" value='3'<?php if(isset($_GET['id']) && $value_c_edit==1){echo "checked";}?>>
  <label class="form-check-label" for="flexRadioDefault1">
    <input type="text" class="form-control" id="answer_c" name="answer_c" <?php if(isset($_GET['id'])){ print "value=$answer_c_edit";} ?> required><br>
  </label>
</div>
<div class="form-check" style="font-size:28px">
  <input class="form-check-input" type="radio" name="correct_answer" value='4'<?php if(isset($_GET['id']) && $value_d_edit==1){echo "checked";}?>>
  <label class="form-check-label" for="flexRadioDefault1">
    <input type="text" class="form-control" id="answer_d" name="answer_d" <?php if(isset($_GET['id'])){ print "value=$answer_d_edit";} ?> required><br>
  </label>
</div>
<?php if(isset($_GET['id']) && isset($image)){
  print "<div class='form-check'>
  <input type='hidden' name='delete_file_path'  value='$image_show'/>
  <input type='hidden' name='delete_file'  value='0'/>
  <input class='form-check-input' type='checkbox' value='1' name='delete_file'>
  <label class='form-check-label' for='flexCheckIndeterminate'>
    Usuń plik
  </label>
</div>";
}?>
<div style="width:300px">
<label for="formFile" class="form-label" >Dodaj załącznik</label>
<input class="form-control" type="file" id="file" name="file"/>
</div>
<br></br>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  </div>
  </div>
</div>
<?php include '../footer.php'; ?>
