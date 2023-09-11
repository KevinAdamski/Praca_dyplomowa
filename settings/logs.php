<?php
session_start();
require_once("../db.php");

    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin'] ))
{
     header('Location: ../index.php');

}
if (($_SESSION['admin']) ==1){

}else{
     header('Location: ../index.php');

}
$user_id=$_GET['user_id'];
$link=connect();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logi</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>
<br>
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Użytkownicy
  </button>
  <ul class="dropdown-menu">
<li><a class='dropdown-item' href='logs.php'>Wszyscy</a></li>
    <?php
    $users_search = mysqli_query($link, "SELECT * FROM users");
  while ($users_db = mysqli_fetch_array($users_search)) {
  $iduser=$users_db[0];
  $name_user=$users_db[1];
  $surname_user=$users_db[2];
  $NS_user = $name_user . " " . $surname_user;
  $href="?id=" . $iduser;
  print "<li><a class='dropdown-item' href='$href'>$NS_user</a></li>";
}  ?>
  </ul>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Imię i Nazwisko</th>
        <th scope="col">Przeglądarka</th>
        <th scope="col">Adres ip</th>
        <th scope="col">Data</th>
        <th scope="col">Próba zalogowania</th>
      </tr>
    </thead>
    <tbody>
        <?php
$query = "SELECT  logs.idu, logs.browser, logs.ip, logs.date, logs.kk, users.name, users.surname FROM `logs`
INNER JOIN users
ON logs.idu = users.idu ORDER BY DATE DESC";

if(isset($_GET['id'])){
  $id=$_GET['id'];
  $query="SELECT  logs.idu, logs.browser, logs.ip, logs.date, logs.kk, users.name, users.surname FROM `logs`
INNER JOIN users
ON logs.idu = users.idu and users.idu=$id ORDER BY DATE DESC";
}
        $logs_search = mysqli_query($link, $query);
      while ($logs_db = mysqli_fetch_array($logs_search)) {
      $user_id=$logs_db[0];
      $browser=$logs_db[1];
      $ip=$logs_db[2];
      $date=$logs_db[3];
      $ok=$logs_db[4];
      $name=$logs_db[5];
      $surname=$logs_db[6];
      $NS= $name . " " . $surname;

if($ok==1){
  $stan="Zalogowano pomyślnie";
}else{
  $stan="Logowanie niepomyślne";
}
      print "<tr>
        <td>$NS</td>
        <td>$browser</td>
        <td>$ip</td>
        <td>$date</td>
        <td>$stan</td>
      </tr>";
    }

        ?>








          </tbody>
        </table>






	<script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</html>
<?php include '../footer.php'; ?>
