<?php
session_start(); 
require_once("../db.php");
$link =connect();
$message=$_POST['message'];
$quest_id=$_POST['quest_id'];
$user_id=$_POST['user_id'];
$result = mysqli_query($link, "INSERT INTO `chat` (`message`,`idq`,`idu`) VALUES ('$message','$quest_id','$user_id')");	
?>