<?php
require_once("db.php");
$link = connect();

$vkey = $_GET['link'];
$result = mysqli_query($link, "SELECT * FROM users WHERE vkey = '$vkey'");
$record = mysqli_fetch_array($result); 
$user_id=$record['idu'];
 if(mysqli_num_rows($result)) {
	 $update = mysqli_query($link, "UPDATE users SET verify = 2 WHERE vkey = '$vkey' ");
	 $filepath= "settings/avatar/" . $user_id;
	 mkdir($filepath,0777);
	 header('Location: https://serwer2241105.home.pl/login.php?verify=1');
 }else{
	 header('Location: https://serwer2241105.home.pl/');
 }

?>