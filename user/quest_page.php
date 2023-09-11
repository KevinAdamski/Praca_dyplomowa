<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}
$idq=$_GET['menu_quest'];
$link=connect();

//Odrzucenie akceptacji
if(isset($_POST['not_accept'])){
	$sq_cancel=$_POST['not_accept'];
	$update_sq = mysqli_query($link, "UPDATE `subquest` SET notification = '0' WHERE idsq = '$sq_cancel'");
}

//Zaakceptowanie etapu
if(isset($_POST['accept'])){
	$sq_accept=$_POST['accept'];
	$update_sq = mysqli_query($link, "UPDATE `subquest` SET confirmed = '1' WHERE idsq = '$sq_accept'");

  $check_100 = mysqli_query($link, "SELECT COUNT(confirmed) FROM `subquest` WHERE idq ='$idq' AND confirmed=1");
  $record_100 = mysqli_fetch_array($check_100);
  $sq_done=$record_100['COUNT(confirmed)'];

  $check_0 = mysqli_query($link, "SELECT COUNT(confirmed) FROM `subquest` WHERE idq ='$idq'");
  $record_0 = mysqli_fetch_array($check_0);
  $sq_not_done=$record_0['COUNT(confirmed)'];


//Sprawdzanie czy zadanie wykonane w 100%
  $sq_status = $sq_done / $sq_not_done;
  if($sq_status==1){
    	$end_quest = mysqli_query($link, "UPDATE `quest` SET ended = '1' WHERE idq = '$idq'");
      $team_id=$_POST['team_id'];

      //Wprowadzenie danych do tebali ocen
      $s01 = mysqli_query($link, "SELECT * FROM grades WHERE idq IN($idq)");
      if (mysqli_num_rows($s01) < 1) {
      $s1 = mysqli_query($link, "SELECT * FROM teams_users WHERE team_id IN($team_id) AND idu NOT IN($idu)");
      while ($record1 = mysqli_fetch_array($s1)) {
        $user1=$record1['idu'];
      $s2 = mysqli_query($link, "INSERT INTO `grades` (`idq`,`idu`) VALUES ('$idq','$user1')");
  }
}
}
}


//Sprawdzanie czy wciśnięto przycisk usunięcia pliku
if(isset($_POST['delete_file'])){

//Pobieranie id pliku do usunięcia
	$file_to_delete_id=$_POST['delete_file'];

//Zapytanie do bazy danych aby uzyskać nazwę pliku
	$delete_search = mysqli_query($link, "SELECT * FROM files WHERE id_files='$file_to_delete_id'");
	$record_file = mysqli_fetch_array($delete_search);

//Pobieranie z bazy danych nazwy pliku
	$file_to_delete_name=$record_file['file_path'];

//Usuwanie pliku
unlink($_SERVER['DOCUMENT_ROOT'] . "/user/quest_files/" . $idq . "/" . $file_to_delete_name);

//Usuwanie danych dotyczących pliku z bazy danych
$delete_file_db = mysqli_query($link, "DELETE FROM `files` WHERE id_files = '$file_to_delete_id'");
}

//sprawdza czy zostało rozpoczete przesyłanie pliku
if(isset($_FILES['file']) && !empty($_FILES["file"]["name"])){

//Pobieranie nazwy pliku
	 $filename = $_FILES['file']['name'];

//Tworzenie ścieżki do zapiosu pliku
	 $filepath="quest_files/" . $idq . "/";

//Wprowadzanie danych dotyczących pliku do bazy danych
	$insert_file = mysqli_query($link, "INSERT INTO `files` (`file_path`,`idq`,`idu`) VALUES ('$filename','$idq','$idu')");

//Przesyłanie pliku
	 move_uploaded_file($_FILES['file']['tmp_name'],$filepath.$filename);
}

?>
<title>Panel</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
 <?php include '../navbar.php'; ?>
 <div class="container">
  <div class="row">
<div class="col-3">
      <?php include 'sidebar.php';?>
	  </div>

	<div class="col-md-auto">
	  <form id='main' method="post" action="updatequest.php"></form>

<?php


$a1 = mysqli_query($link, "SELECT * FROM quest WHERE idq='$idq'");
$record = mysqli_fetch_array($a1);
  $team_creator_id=$record['idu'];
  $team_id=$record['team_id'];
  $title=$record['title'];
  $main_text=$record['text'];
  $ended=$record['ended'];
print "<h1>$title</h1>";
print "<h5>$main_text</h5><br><br>";

if($team_creator_id == $idu || $_SESSION['Admin'] == 1){
print	"<form method='post' action='quest_edit.php' enctype='multipart/form-data'>
  <input type='hidden' name='quest_id'  value='$idq'/>
	<button type='submit' class='btn btn-primary'>Edytuj</button></form>";
}
if($team_creator_id == $idu && $ended==1){
  print	"<form method='get' action='quest_grade.php' enctype='multipart/form-data'>
    <input type='hidden' name='quest_id'  value='$idq'/>
    <input type='hidden' name='team_creator_id'  value='$team_creator_id'/>
  	<button type='submit' class='btn btn-warning'>Oceń</button></form>";
}

print "<div class='list-group'>";
$a2 = mysqli_query($link, "SELECT * FROM subquest WHERE idq='$idq'");
while ($wood = mysqli_fetch_array($a2)) {
	$idsq=$wood[0];
	$text=$wood[2];
	$confirmed=$wood[4];
	$notification=$wood[3];
	if($confirmed==1){
		print "<label class='list-group-item list-group-item-primary'>

		  <input class='form-check-input me-1' type='checkbox' form='main' value='' checked disabled>
		$text</label>";

	}else if($notification==1 || $ended==1){
	print "<label class='list-group-item list-group-item-dark'>
    <input class='form-check-input me-1' type='checkbox'  form='main' value='' disabled>
    $text";
	if($idu==$team_creator_id){
    print   "<form id='accept' method='post' style='float:right' >
    <input type='hidden'  name='team_id'  id='accept' value='$team_id'>
	<input type='hidden'  name='accept'  id='accept' value='$idsq'>
	<button class='btn btn-success' id='accept' type='submit'><i class='fa fa-check'></i></button></form>

    <div style='float:right;width:8px;'> &nbsp </div>

	<form id='cancel' method='post' style='float:right' >
	<input type='hidden'  name='not_accept'  id='cancel' value='$idsq'>
	<button class='btn btn-danger' id='cancel' type='submit'><i class='fa fa-close'></i></button></form>";
	}
  print "</label>";
	}else{
	print "<label class='list-group-item'>
	<input type='hidden' name='$idsq'  form='main' value='0'/>
    <input class='form-check-input me-1' type='checkbox' form='main' value='1' name='$idsq' >
    $text
  </label>";
}
}
?>

<input type='hidden' name='quest_id' form='main' value='<?php echo $idq; ?>'/><br>
<button type='submit' class='btn btn-primary' form='main'style='width:100px;' >Potwierdź</button>

<br><br>

<?php

		  //sprawdzenie czy zadanie ma przypisane pliki
	$files_search = mysqli_query($link, "SELECT * FROM files WHERE idq = '$idq'");
 if(mysqli_num_rows($files_search)) {
	 $file_link="https://serwer2241105.home.pl/user/quest_files/" . $idq . "/";
	 print "<div class='list-group'>";

	 //wyświetlanie listy plików
		  while ($files_list = mysqli_fetch_array($files_search)) {
			  $file_id=$files_list[0];
			  $file_path=$files_list[1];
			  $file_user=$files_list[3];
			  $file2= $file_link . $file_path;
			  $delete_files_1= "/user/quest_files" . "/" .  $idq . "/" . $file_path;
              print "<label class='list-group-item' style='width:400px;'> $file_path ";


              if($idu==$file_user ||  $team_creator_id==$idu || $_SESSION['admin']==1){


			   print "
			   <form method='post' style='float:right' >
	           <input type='hidden'  name='delete_file' value='$file_id'>
			   <button class='btn btn-outline-danger' type='submit'><i class='fa fa-close'></i></button></form>

			  <div style='float:right;width:8px;'> &nbsp </div>";

			  }

			  print "<a href='$file2' class='btn btn-outline-primary' target='_blank' style='float:right'><i class='fa fa-arrow-down'></i></a>




			  </label>";

		  }

 }

		 print  "</div>";






?>
<br>
 <form method='post' enctype="multipart/form-data" style='width:370px; display: flex;'>

 <label for="formFileMultiple" class="form-label" ></label>
<input class="form-control" type="file" id="file" name="file" />

<button class='btn btn-outline-primary' type='submit' style='display: flex;'><i class='fa fa-arrow-up'></i></button></form>






<script type="text/javascript">
      function table(){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
          document.getElementById("table").innerHTML = this.responseText;
        }
        xhttp.open("GET", "chat.php?idq=<?php echo $idq; ?>");
        xhttp.send();
      }

      setInterval(function(){
        table();
      }, 1000);
    </script>
    <div id="table" style="width:600; height:600;overflow-y: scroll;">

    </div>
		<div class="messaging center-block">
    <div class="row">
      <div class="col-md-12">
        <div class="input-group">

          <input type="text" id="message" class="form-control">
          <span class="input-group-btn">
			   <input type="hidden" id="user_id" name="user_id" value="<?php echo $idu; ?>">
			   <input type="hidden" id="quest_id" name="quest_id" value="<?php echo $idq; ?>">
            <button class="send btn btn-outline-primary" type="submit" id="send" type="button">Wyślij</button>

          </span>
        </div>
      </div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
    $('.send').click(function (e) {
      e.preventDefault();
      var message = $('#message').val();
	  var quest_id = $('#quest_id').val();
	  var user_id = $('#user_id').val();
      $.ajax
        ({
          type: "POST",
          url: "send_chat.php",
          data: { "message": message, "quest_id": quest_id, "user_id": user_id },
          success: function (data) {
            $('.result').html(data);

			  //czyszczenie pola message po wysłaniu wiadomości
			$("#message").val("");
          }
        });
    });
  });


</script>



</div>
</div>
</div>
</div>
<script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
