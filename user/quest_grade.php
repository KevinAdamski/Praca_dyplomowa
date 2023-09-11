<?php
session_start();
require_once("../db.php");
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']) || $_GET['team_creator_id'] != $idu)
{
     header('Location: index.php');
}
$link=connect();
?>
<title>Oceny</title>
<link href="../css/bootstrap.min.css" rel="stylesheet">
<style>
.rating {
   float:left;
   border:none;
}
.rating:not(:checked) > input {
   position:absolute;
   top:-9999px;
   clip:rect(0, 0, 0, 0);
}
.rating:not(:checked) > label {
   float:right;
   width:1em;
   padding:0 .1em;
   overflow:hidden;
   white-space:nowrap;
   cursor:pointer;
   font-size:200%;
   line-height:1.2;
   color:#ddd;
}
.rating:not(:checked) > label:before {
   content:'★ ';
}
.rating > input:checked ~ label {
   color: #f70;
}
.rating:not(:checked) > label:hover, .rating:not(:checked) > label:hover ~ label {
   color: gold;
}
.rating > input:checked + label:hover, .rating > input:checked + label:hover ~ label, .rating > input:checked ~ label:hover, .rating > input:checked ~ label:hover ~ label, .rating > label:hover ~ input:checked ~ label {
   color: #ea0;
}
.rating > label:active {
   position:relative;
}
  </style>
 <?php include '../navbar.php'; ?>
 <div class="container">
  <div class="row">
<div class="col-3">
      <?php include 'sidebar.php';?>
	  </div>

	<div class="col-md-auto">
	  <form method="post" action="">
	<div class='list-group'>


<?php
$quest_id=$_GET['quest_id'];




$star=0;
$s1 = mysqli_query($link, "SELECT * FROM grades WHERE idq IN($quest_id)");
if (mysqli_num_rows($s1) < 1) {
  $s01 = mysqli_query($link, "SELECT * FROM quest WHERE idq='$quest_id'");
  $record01 = mysqli_fetch_array($s01);

    $creator_id=$record01['idu'];
    $team_id=$record01['team_id'];

    $end_date=$record01['end_date'];


    $s02 = mysqli_query($link, "SELECT * FROM teams_users WHERE team_id='$team_id' AND idu != '$creator_id'");
    while ($record02 = mysqli_fetch_array($s02)) {
      $new_grade_idu=$record02[2];

$insert_grade=mysqli_query($link, "INSERT INTO `grades` (`idq`,`idu`,`date`) VALUES ('$quest_id','$new_grade_idu','$end_date')");
$s1 = mysqli_query($link, "SELECT * FROM grades WHERE idq IN($quest_id)");
}
}

while ($record1 = mysqli_fetch_array($s1)) {
  $user1=$record1[2];
  $grade1=$record1[3];

if(isset($_POST[$user1])){
  $grade1=$_POST[$user1];
  $update_grade = mysqli_query($link, "UPDATE grades SET grade = $grade1  WHERE idu=$user1 AND idq=$quest_id");
}

  $s2 = mysqli_query($link, "SELECT * FROM users WHERE idu='$user1'");
  $record2 = mysqli_fetch_array($s2);

    $name=$record2['name'];
    $surname=$record2['surname'];
    $avatar=$record2['avatar'];
    $NS=$name . " " . $surname;
    $star1=$star+1;
    $star2=$star1+1;
    $star3=$star2+1;
    $star4=$star3+1;
    $star5=$star4+1;
    $star=$star5;
    if($avatar === NULL){
      $avatar_path = "https://serwer2241105.home.pl/settings/avatar/default.png";}
      else{
      $avatar_path="../settings/avatar/" . $user1 . "/" . $avatar;}
      print	"<label class='list-group-item' style='font-size: 2em'>
      $NS
  				<img src='$avatar_path' style='width: 60px;height: 60px;float:right'>
          <fieldset class='rating'>
    <input type='radio' id='$star1' name='$user1' value='5'";
        if($grade1==5){print "checked";}
    print "/><label for='$star1'>5 stars</label>
    <input type='radio' id='$star2' name='$user1' value='4' ";
          if($grade1==4){print "checked";}
    print "/><label for='$star2'>4 stars</label>
    <input type='radio' id='$star3' name='$user1' value='3'";
           if($grade1==3){print "checked";}
    print "/><label for='$star3'>3 stars</label>
    <input type='radio' id='$star4' name='$user1' value='2'";
           if($grade1==2){print "checked";}
    print "/><label for='$star4'>2 stars</label>
    <input type='radio' id='$star5' name='$user1' value='1'";
             if($grade1==1){print "checked";}
     print "/><label for='$star5'>1 star</label>
</fieldset>


    </label>";
}

  			?>
      </div>
      <button type='submit' class='btn btn-primary'>Potwierdź</button></form>
  				</div>



</div>
</div>
</div>
<script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
<?php include '../footer.php'; ?>
