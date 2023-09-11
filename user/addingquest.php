<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}
$name=$_POST['name'];
$quest=$_POST['quest'];
$subquest=$_POST['title'];
$team=$_POST['team'];
$people=$_POST['people'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
$number =  sizeof($subquest);
$x1=0;
if (isset($_POST['name'])) {
		$name=$_POST['name'];
	if (isset($_POST['quest'])) {
		$quest=$_POST['quest'];
		if (isset($_POST['title'])) {
		$subquest=$_POST['title'];
			$link=connect();
			$result = mysqli_query($link, "INSERT INTO `quest` (`idu`,`team_id`,`title`,`text`,`end_date`) VALUES ('$idu','$team','$name','$quest','$end_date')");
            $last_id = mysqli_insert_id($link);

				while($x1 < $number){
					$sq=$subquest[$x1];
					$x1++;

					$result2 = mysqli_query($link, "INSERT INTO `subquest` (`idq`,`text`) VALUES ('$last_id','$sq')");

					$filepath="quest_files/" . $last_id . "/";
					mkdir($filepath,0777); //Tworzenie folderu dla plików nazwanego id zadania

    }
if(file_exists($_FILES['file']['name'])){
	$countfiles = count($_FILES['file']['name']);
                     for($i=0;$i<$countfiles;$i++){
						 $filename = $_FILES['file']['name'][$i];

						$insert_file = mysqli_query($link, "INSERT INTO `files` (`file_path`,`idq`,`idu`) VALUES ('$filename','$last_id','$idu')");
						 move_uploaded_file($_FILES['file']['tmp_name'][$i],$filepath.$filename);

}
}
header('Location: https://serwer2241105.home.pl/user');
		}else{
				echo "error";
			}
		}

	}


?>
