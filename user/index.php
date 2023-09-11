<?php
session_start();
require_once("../db.php");

    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: ../index.php');

}
if (($_SESSION['canDoTask']) ==1){

}else{
     header('Location: ../index.php');

}
$link=connect();

$check_dates = mysqli_query($link, "UPDATE quest SET ended = 1 WHERE ended = 0 AND end_date < NOW() AND end_date > '2000-01-01 11:11:00'");


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Użytkownika</title>


    <link href="../css/bootstrap.min.css" rel="stylesheet">
	  <?php include '../navbar.php'; ?>
  </head>

<div class="container">

  <div class="row">
<div class="col-3">
      <?php include 'sidebar.php';?>
	  </div>

	<div class="col-md-auto">

<form id="filter">
    <div class="container">
      <div class="row">
        <div class="col-sm" style="width:150px">
          <label for="exampleFormControlSelect1">Zespół</label>
     <select class="form-control" name="team">
       <?php $teams_search = mysqli_query($link, "SELECT * FROM teams WHERE team_id IN (SELECT team_id FROM teams_users WHERE idu = '$idu' )");
       while ($grid = mysqli_fetch_array($teams_search)) {
       	$team_name=$grid[2];
        $team_id=$grid[0];
        if(isset($my_teams)){
          $my_teams = $my_teams . "," . $team_id;
        }else{
        $my_teams=$team_id;}
        echo    "<option value='$team_id'";
         if($_GET['team'] == $team_id){
           echo "selected";
         }
        echo ">$team_name</option>";}
        echo    "<option value='$my_teams'";
        if(!isset($_GET['team'])){ echo "selected";}
        echo ">Wszystkie </option>";
        ?>
     </select>
        </div>
        <div class="col-sm" style="width:150px">
            <label for="exampleFormControlSelect1">Sortuj</label>
          <select class="form-control" name="sort">
            <option value='1' <?php if($_GET['sort']==1){echo "selected";}?> > Najnowsze </option>
            <option value='2' <?php if($_GET['sort']==2){echo "selected";}?>> Najstarsze </option>
            <option value='3' <?php if($_GET['sort']==3){echo "selected";}?>> Czas najkrótszy </option>
            <option value='4' <?php if($_GET['sort']==4){echo "selected";}?>> Czas najdłuższy </option>
            </select>
        </div>
        <div class="col-sm">

          <input type='hidden' name='ended'  form='filter' value='0'/>
            <input class='form-check-input me-1' type='checkbox' form='filter' value='1' name='ended'
            <?php if($_GET['ended']==1){echo "checked";}?> >Wyświetl ukończone
        </div>
        <div class="col-sm">
          <br> <button type="submit" id="filter" class="btn btn-primary">Filtruj</button>
        </div>
      </div>
    </div>
</form>
<br>




<div class='list-group'>

<?php
if(!isset($_GET['page'])){
  $page_number=1;
}else{
  $page_number=$_GET['page'];
}

if(!isset($_GET['sort'])){
  $sort="idq DESC";
}else if($_GET['sort']==1){
  $sort="idq DESC";
}else if($_GET['sort']==2){
  $sort="idq ASC ";
}else if($_GET['sort']==3){
  $sort="CASE WHEN end_date = '0000-00-00 00:00:00' THEN 2 ELSE 1 END,
   end_date ASC";
}else if($_GET['sort']==4){
  $sort="CASE WHEN end_date = '0000-00-00 00:00:00' THEN 2 ELSE 1 END,
   end_date DESC ";
}

if(!isset($_GET['ended'])){
  $ended=0;
}else if($_GET['ended']==0){
  $ended=0;
}
else{
  $ended=1;
}


$limit_end=$page_number * 10;
$limit_start=$limit_end - 10;
if(!isset($_GET['team'])){
  $team_sql=$my_teams;
}else{
$team_sql=$_GET['team'];}
$current_date=date("Y-m-d H:i:s");
$w1 = mysqli_query($link, "SELECT * FROM quest WHERE team_id IN($team_sql) AND ended=$ended ORDER BY $sort LIMIT $limit_start,$limit_end");
while ($wood = mysqli_fetch_array($w1)) {
	$idq=$wood[0];
  $team_id=$wood[2];
  $title = $wood[3];
	$text = $wood[4];
	$end_date=$wood[5];
  $ended=$wood[6];
  $link2= "http://serwer2241105.home.pl/user/quest_page.php?menu_quest=" . $idq;

	$w2 = mysqli_query($link, "SELECT COUNT(confirmed) FROM subquest WHERE confirmed=1 AND idq='$idq'");
	$record2 = mysqli_fetch_array($w2);
  $done=$record2['COUNT(confirmed)'];

	$w3 = mysqli_query($link, "SELECT COUNT(confirmed) FROM subquest WHERE idq='$idq'");
	$record3 = mysqli_fetch_array($w3);
	$undone=$record3['COUNT(confirmed)'];
	$quest_status=($done / $undone)*100 . "%";

  $w4 = mysqli_query($link, "SELECT * FROM teams WHERE team_id='$team_id'");
  $record4 = mysqli_fetch_array($w4);
  $team_name = $record4['name'];
  $team_image=$record4['image'];


	print " <a href='$link2' class='list-group-item list-group-item-action flex-column align-items-start'>
         <div class='d-flex w-100 justify-content-between'>
          <h5 class='mb-1'>$title";

          print "</h5>";
          if($end_date== '0000-00-00 00:00:00' || $ended==1){
            print "<small class='text-muted'></small>";
        }else{
          $hours = abs(strtotime($end_date) - time()) / 3600;
          $hours2 = intval($hours);
          if($hours2 <= 24){
            $time_message = "Pozostało " . $hours2 . " godz";
          }else{
            $days = intval($hours2 / 24);

            $time_message = "Pozostało " . $days . " dni";
          }
            print "<small class='text-muted'>$time_message</small>";
         }

         print "</div>
         <p class='mb-1'>$text</p>
         <div class='progress' style='max-width:200px'>
       <div class='progress-bar' role='progressbar' style='width: $quest_status;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$quest_status</div>
     </div>
     <br>
     <div style='text-align: left'><img src='$team_image' width='40' /> &nbsp $team_name</div>
       </a>";



}

$w5 = mysqli_query($link, "SELECT COUNT(*) AS page_list FROM quest WHERE team_id IN($team_sql) AND ended IN($ended)");
$record5 = mysqli_fetch_array($w5);
$rows_list = $record5['page_list'];

?>
</div>
<form id='pages' method='get' >
  <?php
  if(isset($_GET['team'])){
    print "<input type='hidden'  name='team'   value='$team_sql'>";
  }
  if(isset($_GET['sort'])){
    $sort_number=$_GET['sort'];
    print "<input type='hidden'  name='sort'   value='$sort_number'>";
  }

    print "<input type='hidden'  name='ended'   value='$ended'>";
  ?>
  <br>
  <div class="btn-group btn-group-toggle" data-toggle="buttons">

    <?php if( !isset($_GET['page']) || $_GET['page'] == 1){ $previous_disabled=1;}

//sprawdzanie czy w linku nie znajduje się numer strony
     if(!isset($_GET['page'])){

//jeżeli w linku nie numeru strony, wartość aktualnej strony ma wartość 1
      $current_page=1;}

//jeżeli numer strony znajduje się w linku, wartość aktualnej strony przybiera wartość metodą GET
      else{
        $current_page = $_GET['page'];
      }
      $current_rows= $current_page * 10;

//sprawdzanie czy istnieje potrzeba kolejnej strony do wyświetlenia pozostałych zadań
      if($rows_list <= $current_rows ){
         $next_disabled=1;
       }

      $previous_value= $current_page -1;
      $next_value=$current_page +1;

//przyciski służące do zmiany stron, przypisywanie im odpowidnich wartości
     ?>
<button class='btn btn-primary btn-lg' id='pages' name="page" type='submit'
 value="<?php echo $previous_value; ?> "
 <?php if($previous_disabled==1){echo "disabled";} ?> > << </i></button></form>

<a class="btn btn-primary btn-lg active" role="button"
aria-pressed="true"> <?php echo $current_page; ?> </a>

<button class='btn btn-primary btn-lg' id='pages' name="page" type='submit'
value="<?php echo $next_value; ?>" <?php if($next_disabled==1)
{echo "disabled";} ?> > >> </i></button></form>
</div>

		   </div>
  </div>
</div>

<body>

	<script src="../../js/jquery-3.4.1.min.js"></script>

    <script src="../../js/popper.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
</html>
