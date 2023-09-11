<?php
session_start();
require_once("db.php");
$link=connect();
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}

if (($_SESSION['canNews']) ==1){

}else{
     header('Location: index.php');

}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edycja</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-3.4.1.min.js"></script>
	 <?php include 'navbar.php'; ?>
</head>
<body>

<?php if(isset($_POST['title'])){
  $add_title=$_POST['title'];
  $add_description=$_POST['description'];
  $new_news = mysqli_query($link, "INSERT INTO `News` (`title`,`textnews`,`user`) VALUES ('$add_title','$add_description','$idu')");
  header('Location: index.php');
}
?>

  <form method="post" action='' enctype='multipart/form-data'>
    <div style="max-width:400px;">
    <div class="form-group">
      <label for="exampleFormControlInput1">Tytuł</label>
      <input type="text" class="form-control"  name="title" required><br>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Treść</label>
      <textarea class="form-control" name="description"  rows="15" required></textarea>
    </div>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Potwierdź</button>
  </form>



</body>
    <script src="../js/bootstrap.bundle.min.js"></script>
