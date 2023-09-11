<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');
}
if($_SESSION['admin'] == 1){

}else{
	 header('Location: ../index.php');
}
$link=connect();
$search_images = mysqli_query($link, "SELECT * FROM site_config WHERE id_config = 1 ");
$record_images = mysqli_fetch_array($search_images);
$image1= "../img/carousel/" . $record_images['carousel_1'];
$image2= "../img/carousel/" . $record_images['carousel_2'];
$image3= "../img/carousel/" . $record_images['carousel_3'];
$reg=$record_images['reg'];


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ustawienia Portalu</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">

	<script src="../js/jquery-3.4.1.min.js"></script>
	 <?php include '../navbar.php'; ?>
<link href="settings.css" rel="stylesheet">

</head>
<body>

	<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">Ustawienia Portalu</h4>
    <div class="d-flex align-items-start py-3 border-bottom">
        <img src= " <?php echo $site_icon_path; ?>"
            class="img" alt="">
        <div class="pl-sm-4 pl-2" id="img-section">
			<div class="mb-3">
				<form method="post" action="update_site_title.php" enctype='multipart/form-data'>
  <label for="formFile" class="form-label">Dodaj zdjęcie</label>
  <input class="form-control" type="file" id="site_icon" name='site_icon'>
</div>

        </div>
    </div>

        <div class="row py-2">
            <div class="col-md-6">
                <label for="firstname">Nazwa Portalu</label>
                <input type="text" class="bg-light form-control" id="site_title"  name="site_title" placeholder=<?php echo $title;  ?>>
            </div>

        </div>
		<br></br>




		<h3>Grafiki strony głównej</h3>
		Zalecana rozdzielczość 1920x350
		<div class="d-flex align-items-start py-3 border-bottom"></div>
        <img src= <?php echo $image1; ?>   width="500" height="60" alt="">
  <label for="formFile" class="form-label">Grafika 1</label>
  <input class="form-control" type="file" id="image_1" name='image_1'>


		<div class="d-flex align-items-start py-3 border-bottom"></div>
        <img src= <?php echo $image2; ?>   width="500" height="60" alt="">
  <label for="formFile" class="form-label">Grafika 2</label>
  <input class="form-control" type="file" id="image_2" name='image_2'>



		<div class="d-flex align-items-start py-3 border-bottom"></div>
        <img src= <?php echo $image3; ?>   width="500" height="60" alt="">
  <label for="formFile" class="form-label">Grafika 3</label>
  <input class="form-control" type="file" id="image_3" name='image_3'>


  <div class="form-group">
    <label for="exampleFormControlTextarea1">Regulamin</label>
    <textarea class="form-control" name="reg"  rows="15" required> <?php echo $reg; ?></textarea>
  </div>







		<br>

           <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
</form>


    </div>
</div>


















	</body>

	  <script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
