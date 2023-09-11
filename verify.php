<?php
ob_start();
session_start();
require_once("db.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
function get_browser_name($user_agent){
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';}
         
$ipaddress = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
$details = json_decode ($json);
return $details;}
$details = ip_details($ipaddress);
$ip1 = $details -> ip;
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
$os = getOS();
$email = htmlentities ($_POST['email'], ENT_QUOTES, "UTF-8");
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");
 $link = connect();



$result = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
 $record = mysqli_fetch_array($result);
  $idu=$record['idu'];
  $pass2=$record['pass'];
  $verify=$record['verify'];
	$canDoTask=$record['canDoTask'];
	$canTeam=$record['canTeam'];
	$canCreateTask=$record['canCreateTask'];
  $canNews=$record['canNews'];
  $canDoTest=$record['canDoTest'];
  $canCreateTest=$record['canCreateTest'];
	$image = $record['avatar'];
    if($image === NULL){
        $avatar = "https://serwer2241105.home.pl/settings/avatar/default.png";
    }else{
	$avatar = "https://serwer2241105.home.pl/settings/avatar/" . $idu . "/" . $image; }

	$admin= $record['Admin'];
	if($verify == 1){
		 header('Location: https://serwer2241105.home.pl/login.php?error=1');
	}else{
	if (password_verify($pass, $pass2)) {
    $result_positive = mysqli_query($link, "INSERT INTO `logs` (`idu`,`browser`,`ip`,`kk`) VALUES ('$idu','$browser','$ip1','1')");
	 $_SESSION['loggedin'] = true;
     $_SESSION['idu']=$idu;
	 $_SESSION['canDoTask']= $canDoTask;
		$_SESSION['canTeam']= $canTeam;
		$_SESSION['canCreateTask']=$canCreateTask;
		$_SESSION['avatar']=$avatar;
		$_SESSION['admin'] = $admin;
    $_SESSION['canNews']=$canNews;
    $_SESSION['canDoTest']=$canDoTest;
    $_SESSION['canCreateTest']=$canCreateTest;
     header('Location: /user/index.php');

	}
		else {
     $result_negative = mysqli_query($link, "INSERT INTO `logs` (`idu`,`browser`,`ip`,`kk`) VALUES ('$idu','$browser','$ip1','0')");
			 header('Location: https://serwer2241105.home.pl/login.php?error=2');
}
	}
	$error = "Nie ma takiego użytkownika";

	 ob_end_flush();
	?>
