<?php
session_start(); 
require_once("db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}else if($_SESSION['rank']!=2){
	header('Location: index.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dokument bez tytułu</title>
</head>
Kurwyyy jebane
	<?php
$link=connect();
$w1 = mysqli_query($link, "SELECT * FROM quest");
while ($wood = mysqli_fetch_array($w1)) {
$title = $wood[3];
	echo $title;}
?>
<body>
</body>
</html>