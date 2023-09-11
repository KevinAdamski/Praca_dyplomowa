<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ustawienia</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery-3.4.1.min.js"></script>
	 <?php include '../navbar.php'; ?>

     <link href="settings.css" rel="stylesheet">
</head>
<body>

	<div class="wrapper bg-white mt-sm-5">
    <h4 class="pb-4 border-bottom">Ustawienia Konta</h4>
    <div class="d-flex align-items-start py-3 border-bottom">
        <img src= " <?php echo $_SESSION['avatar']; ?>"
            class="img" alt="">
        <div class="pl-sm-4 pl-2" id="img-section">
			<div class="mb-3">
				<form method="post" action="update_settings.php" enctype='multipart/form-data'>
  <label for="formFile" class="form-label">Dodaj zdjęcie</label>
  <input class="form-control" type="file" id="avatar" name='avatar'>
</div>

        </div>
    </div>
    <div class="py-2">
        <div class="row py-2">
            <div class="col-md-6">
                <label for="firstname">Imię</label>
                <input type="text" class="bg-light form-control" name="name" value="<?php echo $name;?>">
            </div>
            <div class="col-md-6 pt-md-0 pt-3">
                <label for="lastname">Nazwisko</label>
                <input type="text" class="bg-light form-control" name="surname" value="<?php echo $surname; ?>">
            </div>
        </div>


           <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
</form>

    </div>
</div>


















	</body>

	  <script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
