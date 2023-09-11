<?php
session_start();
require_once("../db.php");
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
<title>Dodawanie</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery-3.4.1.min.js"></script>
	 <?php include '../navbar.php'; ?>
</head>



<body>
	<div class="container">
  <div class="row">
	 <div class="col-3">
      <?php include 'sidebar.php';?>
    </div>

	<div class="col-md-auto">
<form method="post" action="addingquest.php" enctype='multipart/form-data'>
  <div class="form-group">
<label for="team">Zespół</label>
<select id="team" class="form-control" data-role="select-dropdown" data-profile="minimal" name="team">

	<?php $link=connect();
$select_team = mysqli_query($link, "SELECT * FROM teams WHERE creator_user_id = $idu");
while ($search_team = mysqli_fetch_array($select_team)) {
	$id_team=$search_team[0];
    $name_team = $search_team[2];
    $image_team = $search_team[4];
	print "<option value='$id_team' style='background-image:url($image_team);'>$name_team</option>";
}
	?>
</select>
</div>



    <label for="exampleInputEmail1">Nazwa</label>
    <input type="text" class="form-control" id="name" name="name" required><br>
    <label for="exampleFormControlTextarea1">Treść</label><br>
<textarea class="form-control" id="quest" name="quest" rows="4" cols="50">
</textarea><br>
	   <label for="formFileMultiple" class="form-label">Dodaj załącznik</label>
<input class="form-control" type="file" id="file" name="file[]" multiple />
	<br></br>
	  <div class="field_wrapper">

</div>


            <div id="inputFormRow">

                    <input type="text" name="title[]" class="form-control" placeholder="Wpisz" autocomplete="off" required>
				<div class="input-group-append"><br></br>
						<div>
    </div>
                    </div>

            </div>

            <div id="newRow"></div>
            <button id="addRow" type="button" class="btn btn-primary">Dodaj Etap</button>
	  <br></br>






	<div class="form-check form-switch">
    <input  class="form-check-input" type="checkbox" id="check-end">
	 <label class="form-check-label" for="flexSwitchCheckDefault">Ustaw datę zakończenia</label>
    </div>
	<label for="end_date"></label>
<input type="datetime-local" id="end_date"
       name="end_date" value="2022-06-12T19:30"
       min="2016-01-01T00:00" max="2030-06-14T00:00" disabled><br>
<br>
  <button type="submit" class="btn btn-primary">Potwierdź</button>
</form>

</body>
<br>
<br>
<br>
<br>
</html>
<script type="text/javascript" >

    $("#addRow").click(function () {

     //dodawanie elementów html na stronie
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';

        //dodawanie pola tekstowego
        html += '<input type="text" name="title[]" class="form-control"  autocomplete="off">';
        html += '<div class="input-group-append">';

        //dodanie przycisku służącego do usunięcia pola tekstowego
        html += '<button id="removeRow" type="button" class="btn btn-danger"> X </button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    //kod odpowiedzialny za usuwanie pola tekstowego waraz z przyciskiem
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });




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
