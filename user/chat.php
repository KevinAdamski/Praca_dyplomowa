<?php
session_start();
require_once("../db.php");
$link =connect();
$current_user=$_SESSION['idu'];
?>
<style>
.message-candidate {
  background-color: #9ed3ff;
  padding: 40px;
  max-width: 600px;
  margin-bottom: 3px;
}

.message-hiring-manager {
  background-color: #0f8afc;
  padding: 40px;
  max-width: 600px;
  margin-bottom: 3px;
}

.messaging {
  max-width: 600px;
  margin-top: 20px;
}

.message-text {
  margin-top: 3px;
}

.message-photo {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  object-position: center center;
  display: inline-block;
}

.message-name {
  margin-left: 10px;
  display: inline-block;
}
</style>
<?php
$idq=$_GET['idq'];


$a1 = mysqli_query($link, "SELECT * FROM chat WHERE idq='$idq'");
while ($grid= mysqli_fetch_array($a1)) {
	$message=$grid[3];
	$user_id=$grid[2];
	$datatime=$grid[4];
	$a2 = mysqli_query($link, "SELECT * FROM users WHERE idu='$user_id'");
	while ($grid2= mysqli_fetch_array($a2)) {
		$name=$grid2[1];
		$surname=$grid2[2];
		$NS= $name . " " . $surname;
		$avatar=$grid2[9];
    if($avatar === NULL){
      $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
      else{
		$avatar_path=$avatar_path="../settings/avatar/" . $user_id . "/" . $avatar;
  }
		$czas=time_elapsed_string($datatime);
		if($user_id==$current_user){
			print "<div class='message-hiring-manager center-block'>";
		}else{
	print "<div class='message-candidate center-block'>";}

		print "<div class='row'>
      <div class='col-xs-8 col-md-6'>
        <img src='$avatar_path' class='message-photo'>
        <h4 class='message-name'>$NS</h4>
      </div>
      <div class='col-xs-4 col-md-6 text-right message-date'>$czas</div>
    </div>
    <div class='row message-text'>
        $message
    </div>
  </div>";
	}
}


function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
//Obliczanie rożnicy czasu

    $string = array(
        'y' => 'lat',
        'm' => 'miesięcy',
        'w' => 'tygodni',
        'd' => 'dni',
        'h' => 'godzin',
        'i' => 'minut',
        's' => 'sekund',
//Przypisane jednostek czasu

    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' temu' : 'przed chwilą';
//Zwracanie zmienionej wartości
}

?>
