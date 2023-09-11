<?php
session_start();
require_once("../db.php");
  $idu=$_SESSION['idu'];
  $link=connect();
if (!isset($_SESSION['loggedin']))
{     header('Location: ../index.php'); }

if ($_SESSION['canCreateTest'] ==1){
}else{     header('Location: ../index.php'); }

if(isset($_GET['id'])){
  $test_id=$_GET['id'];
  $id_check=mysqli_query($link, "SELECT * FROM test WHERE idu=$idu AND id_test=$test_id");
  if(mysqli_num_rows($id_check)==0){ header('Location: ../index.php'); }

  $test_name_search = mysqli_query($link, "SELECT * FROM test WHERE id_test='$test_id'");
  $test_name_grid = mysqli_fetch_array($test_name_search);
    $test_name=$test_name_grid['name'];

    if(isset($_POST['user_id_add'])){
      $user_id_add=$_POST['user_id_add'];
      $y=0;
      $number2 =  sizeof($user_id_add);
      while($y < $number2){
        $user_to_add=$user_id_add[$y];
        $y++;

        $add_users = mysqli_query($link, "INSERT INTO `test_users` (`id_test`,`idu`) VALUES ('$test_id','$user_to_add')");
    }
    header('Location: testList.php');
}
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Przydzielanie testu</title>



    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>
<br></br>
<div class="container">
  <div class="row">
<div class="col-sm">
  <div class='d-grid gap-2'>
  <div class="list-group">
    <form method="post" action=" " enctype='multipart/form-data'>
      <div class="mb-3">
        <h4><b><?php echo $test_name; ?> </b></h4>
        <div class='list-group'>
        <?php
        $user_add_test = mysqli_query($link, "SELECT * FROM users WHERE canDoTest = 1 AND idu != '$idu'");
        while ($user_add_list = mysqli_fetch_array($user_add_test)) {
          $user_id=$user_add_list[0];
          $name=$user_add_list[1];
        	$surname=$user_add_list[2];
        	$avatar=$user_add_list[9];
        	$NS=$name . " " . $surname;
          if($avatar === NULL){
            $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
            else{
              $avatar_path="https://serwer2241105.home.pl/settings/avatar/" . $user_id . "/" . $avatar;}
        print "<label class='list-group-item' style='font-size: 2em;width:500px;'>
        <input class='form-check-input me-1' type='checkbox' value='$user_id' name='user_id_add[]'>
        $NS
            <img src='$avatar_path' style='width: 60px;height: 60px;float:right'>
        </label>";
        }
        ?>
        <br>
      </div>
<button type="submit" class="btn btn-primary">Przydziel test</button>
</form>
</div>


  </div>
  </div>
  </div>
</div>
<?php include '../footer.php'; ?>
