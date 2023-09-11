<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}
$link=connect();

if(isset($_POST['quest_id'])){
$quest_id = $_POST['quest_id'];
$search = mysqli_query($link, "SELECT * FROM subquest WHERE idq='$quest_id'");
while ($grid = mysqli_fetch_array($search)) {
	$idsq=$grid[0];
    if($_POST[$idsq] == 1){
        $update_sq = mysqli_query($link, "UPDATE `subquest` SET notification = '1' WHERE idsq = '$idsq'");
    }
}
}
header('Location: http://serwer2241105.home.pl/user/quest_page.php?menu_quest=' . $quest_id);
?>
