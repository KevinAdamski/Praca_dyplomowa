<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}
if($_SESSION['admin'] == 1){

}else{
	 header('Location: ../index.php');
}
$link=connect();

//Aktualizacja ikony portalu jeśli zaimportowano grafikę
if(!empty($_FILES['site_icon']['name'])){

$icon=$_FILES['site_icon']['name'];
$filepath = "../img/site_icon/" . $icon ;
$insert_file = mysqli_query($link, "UPDATE `site_config` SET site_icon = '$icon' WHERE id_config = 1");
move_uploaded_file($_FILES['site_icon']['tmp_name'],$filepath);
}


//Aktualizacja nazwy portalu jeśli pole zostało wypełnione
if(!empty($_POST['site_title'])){
	$site_title=$_POST['site_title'];
	$update_title = mysqli_query($link, "UPDATE `site_config` SET site_name = '$site_title' WHERE id_config = 1");
}


if(!empty($_FILES['image_1']['name'])){

$image_1=$_FILES['image_1']['name'];
$filepath_1 = "../img/carousel/" . $image_1 ;
$insert_file_1 = mysqli_query($link, "UPDATE `site_config` SET carousel_1 = '$image_1' WHERE id_config = 1");
move_uploaded_file($_FILES['image_1']['tmp_name'],$filepath_1);
}


if(!empty($_FILES['image_2']['name'])){

$image_2=$_FILES['image_2']['name'];
$filepath_2 = "../img/carousel/" . $image_2 ;
$insert_file_2 = mysqli_query($link, "UPDATE `site_config` SET carousel_2 = '$image_2' WHERE id_config = 1");
move_uploaded_file($_FILES['image_2']['tmp_name'],$filepath_2);
}


if(!empty($_FILES['image_3']['name'])){

$image_3=$_FILES['image_3']['name'];
$filepath_3 = "../img/carousel/" . $image_3 ;
$insert_file_3 = mysqli_query($link, "UPDATE `site_config` SET carousel_3 = '$image_3' WHERE id_config = 1");
move_uploaded_file($_FILES['image_3']['tmp_name'],$filepath_3);
}

if(!empty($_POST['reg'])){
  $reg=$_POST['reg'];
  $update_reg=mysqli_query($link, "UPDATE `site_config` SET reg = '$reg' WHERE id_config = 1");
}
header('Location: site_title.php')
?>
