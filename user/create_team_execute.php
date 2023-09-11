<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}
if (($_SESSION['canTeam']) ==1){

}else{
     header('Location: ../index.php');

}


$user_id=$_POST['user_id'];
$x=0;
$number =  sizeof($user_id);
if (isset($_POST['name'])) {
		$name=$_POST['name'];
		$image=$_POST['image'];
		$description=$_POST['opis'];
		$link=connect();
		$create_team = mysqli_query($link, "INSERT INTO `teams` (`creator_user_id`,`name`,`description`,`image`) VALUES ('$idu','$name','$description','$image')");
        $last_id = mysqli_insert_id($link);

		while($x < $number){
					$user=$user_id[$x];
					$x++;

					$add_users = mysqli_query($link, "INSERT INTO `teams_users` (`team_id`,`idu`) VALUES ('$last_id','$user')");

		}
	$add_my_id = mysqli_query($link, "INSERT INTO `teams_users` (`team_id`,`idu`) VALUES ('$last_id','$idu')");
    header('Location: https://serwer2241105.home.pl/user/team.php?team_added=true');
}

	?>
