<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}
$link=connect();
if(!empty($_FILES['avatar']['name'])){
$avatar=$_FILES['avatar']['name'];
$filepath = "avatar/" . $idu . "/" . $avatar ;
$insert_file = mysqli_query($link, "UPDATE `users` SET avatar = '$avatar' WHERE idu = '$idu'");
move_uploaded_file($_FILES['avatar']['tmp_name'],$filepath);
$_SESSION['avatar'] = "https://serwer2241105.home.pl/settings/avatar/" . $idu . "/" . $avatar;
}
if(isset($_POST['name'])){
  $name=$_POST['name'];
  $update_name=mysqli_query($link, "UPDATE `users` SET name = '$name' WHERE idu='$idu'");
}
if(isset($_POST['surname'])){
  $surname=$_POST['surname'];
  $update_surname=mysqli_query($link, "UPDATE `users` SET surname = '$surname' WHERE idu='$idu'");
}

header('Location: index.php');
?>
