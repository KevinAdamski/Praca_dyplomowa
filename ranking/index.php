<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ranking</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<script src="../js/jquery-3.4.1.min.js"></script>
	 <?php include '../navbar.php'; ?>

     <link href="../settings/settings.css" rel="stylesheet">
</head>
<body>

	<div class="wrapper bg-white mt-sm-5">
    <div class="container">
      <div class="row">
        <div class="col-sm">

  <h4>Ranking</h4>

        </div>
        <div class="col-sm">

          <div class="btn-group" style="float:right;">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?php if(isset($_GET['sort'])){
                $sort=$_GET['sort'];
                if($sort==1){
                  $sort_q= "AND DATE >=DATE(NOW() - INTERVAL 7 DAY)";
                  echo "7 Dni";
                }else if($sort==2){
                  $sort_q= "AND DATE >=DATE(NOW() - INTERVAL 30 DAY)";
                  echo "Miesiąc";
                }else if($sort==3){
                  $sort_q= "AND DATE >=DATE(NOW() - INTERVAL 365 DAY)";
                  echo "Rok";
                }else if($sort==4){
                  $sort_q= "";
                  echo "Od początku";
                }
              }
                else{
                  $sort_q= "AND DATE >=DATE(NOW() - INTERVAL 7 DAY)";
                  echo "7 Dni";
                }
               ?>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?sort=1">7 Dni</a></li>
              <li><a class="dropdown-item" href="?sort=2">Miesiąc</a></li>
              <li><a class="dropdown-item" href="?sort=3">Rok</a></li>
              <li><a class="dropdown-item" href="?sort=4">Od początku</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>


    <div class="d-flex align-items-start py-3 border-bottom">
      </div>
      <?php
          $link=connect();
          $grade_search = mysqli_query($link, "SELECT idu, AVG(grade) AS agrade FROM grades WHERE grade IN(1,2,3,4,5)
          $sort_q
          GROUP BY idu
          ORDER BY agrade DESC ");
      while ($grade_db = mysqli_fetch_array($grade_search)) {
      $user_id=$grade_db[0];
      $grade=$grade_db[1];
      $grade2=round($grade, 2);
      $user_search = mysqli_query($link, "SELECT * FROM users WHERE idu='$user_id'");
      $record = mysqli_fetch_array($user_search);
      $name=$record['name'];
      $surname=$record['surname'];
      $avatar=$record['avatar'];
      $NS=$name . " " . $surname . "(" . $grade2 . ")";
      if($avatar === NULL){
      $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
      else{
      $avatar_path="../settings/avatar/" . $user_id . "/" . $avatar;}

      print	"		<img src='$avatar_path' style='width: 60px;height: 60px;float:left'>
      <h3> &nbsp $NS</h3>

      </label><br>";
    }

        ?>

    </div>
</div>


















	</body>

	  <script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
