<?php
session_start();
require_once("../db.php");
$link=connect();
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');
}

if (($_SESSION['canCreateTask']) ==1){

}else{
     header('Location: ../index.php');

}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edycja</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<?php include "bottombar.php"; ?>
	 <?php include '../navbar.php'; ?>
</head>



<body>
	<div class="container">
  <div class="row">
	 <div class="col-3">
      <?php include 'sidebar.php';?>
    </div>
	<?php $quest_id=$_POST['quest_id'];
    $edit_search = mysqli_query($link, "SELECT * FROM quest WHERE idq='$quest_id'");
    $record = mysqli_fetch_array($edit_search);
      $team_creator_id=$record['idu'];
      $title=$record['title'];
      $description=$record['text'];

    ?>
	<div class="col-md-auto">
<form method="post" action="quest_edit_execute.php" enctype='multipart/form-data'>
    <label for="exampleInputEmail1">Nazwa</label>
    <input type="text" class="form-control" id="name" name="name" value= <?php echo $title; ?> ><br>
    <label for="exampleFormControlTextarea1">Treść</label><br>
<textarea class="form-control" id="quest" name="description"  rows="4" cols="50">  <?php echo $description; ?>
</textarea><br>
	  <div class="field_wrapper">

</div>
<?php
$sq_search = mysqli_query($link, "SELECT * FROM subquest WHERE idq='$quest_id'");
while ($grid = mysqli_fetch_array($sq_search)) {
	$idsq=$grid[0];
	$text=$grid[2];
         print "<div id='inputFormRow'>
            <div class='input-group mb-3'>

                    <input type='text' name='$idsq' class='form-control'  autocomplete='off' value='$text'>
				<div class='input-group-append'>
                <button id='removeRow' type='button' class='btn btn-danger'> X </button>
                </div>
                </div>
</div>";

}  ?>
                <br></br>


            <div id="newRow"></div>
            <button id="addRow" type="button" class="btn btn-primary">Dodaj Etap</button>
	  <br></br>

      <input type='hidden' name='quest_id'  value='<?php echo $quest_id; ?>'/><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>
<script type="text/javascript" >
    
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="title[]" class="form-control"  autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"> X </button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });


    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });


const checkplan = document.getElementById("check-plan");
const startdate = document.getElementById("start_date");

checkplan.addEventListener("change", (event) => {
  startdate.disabled = !event.target.checked;
}, false);



const checkend = document.getElementById("check-end");
const enddate = document.getElementById("end_date");

checkend.addEventListener("change", (event) => {
  enddate.disabled = !event.target.checked;
}, false);
</script>
</div>
	</div>
</div>
    <script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
