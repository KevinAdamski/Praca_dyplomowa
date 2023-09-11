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
$name=$_POST['name'];
$description=$_POST['description'];
$update_quest_values = mysqli_query($link, "UPDATE `quest` SET title = '$name' , text = '$description' WHERE idq = '$quest_id'");
$sq_search = mysqli_query($link, "SELECT * FROM subquest WHERE idq='$quest_id'");
while ($grid = mysqli_fetch_array($sq_search)) {
	$idsq=$grid[0];
	$text=$grid[2];
    if(isset($_POST[$idsq])){
        if($_POST[$idsq] != $text){
             $updated_text = $_POST[$idsq];
            $update_sq_values = mysqli_query($link, "UPDATE `subquest` SET text = '$updated_text' WHERE idsq = '$idsq'");
        }

    }else{
        $delete_sq_values = mysqli_query($link, "DELETE FROM `subquest` WHERE idsq = '$idsq'");
    }

}
if(isset($_POST['title'])){
    $subquest=$_POST['title'];
    $number =  sizeof($subquest);
    $x1=0;
    while($x1 < $number){
        $sq=$subquest[$x1];
        $x1++;
        $adding_sq = mysqli_query($link, "INSERT INTO `subquest` (`idq`,`text`) VALUES ('$quest_id','$sq')");
}
}

$check_100 = mysqli_query($link, "SELECT COUNT(confirmed) FROM `subquest` WHERE idq ='$quest_id' AND confirmed=1");
$record_100 = mysqli_fetch_array($check_100);
$sq_done=$record_100['COUNT(confirmed)'];

$check_0 = mysqli_query($link, "SELECT COUNT(confirmed) FROM `subquest` WHERE idq ='$quest_id'");
$record_0 = mysqli_fetch_array($check_0);
$sq_not_done=$record_0['COUNT(confirmed)'];

$sq_status = $sq_done / $sq_not_done;
if($sq_status==1){
    $end_quest = mysqli_query($link, "UPDATE `quest` SET ended = '1' WHERE idq = '$quest_id'");
}

header("Location: https://serwer2241105.home.pl/user/quest_page.php?menu_quest=$quest_id");

}


?>
