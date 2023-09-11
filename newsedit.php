<?php
session_start();
require_once("db.php");
$link=connect();
    $idu=$_SESSION['idu'];
if (!isset($_SESSION['loggedin']))
{
     header('Location: index.php');
}

if (($_SESSION['canNews']) ==1){

}else{
     header('Location: index.php');

}
if(!isset($_GET['news'])){
  header('Location: index.php');
}
$news_id=$_GET['news'];
if(isset($_POST['delete_news'])){
  $delete_news_id=$_POST['delete_news'];
  $delete_news = mysqli_query($link, "DELETE FROM News WHERE news_id=$delete_news_id");
  header('Location: index.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edycja</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-3.4.1.min.js"></script>
	 <?php include 'navbar.php'; ?>
</head>
<body>

<?php if(isset($_POST['title'])){
  $add_title=$_POST['title'];
  $add_description=$_POST['description'];
  $update_news = mysqli_query($link, "UPDATE `News` SET title = '$add_title' , textnews = '$add_description' WHERE news_id = '$news_id'");
    header('Location: index.php');
}
$search_news = mysqli_query($link, "SELECT * FROM News WHERE news_id='$news_id'");
 $news_grid = mysqli_fetch_array($search_news);
  $news_title=$news_grid['title'];
  $news_text=$news_grid['textnews'];
?>

  <form method="post" action='' enctype='multipart/form-data'>
    <div style="max-width:400px;">
    <div class="form-group">
      <label for="exampleFormControlInput1">Tytuł</label>
      <input type="text" class="form-control" value= "<?php echo $news_title; ?>" name="title" required ><br>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Treść</label>
      <textarea class="form-control" name="description"  rows="15" required> <?php echo $news_text; ?></textarea>
    </div>
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Aktualizuj</button>
  </form>
<br>

  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Usuń
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        Napenwo chcesz usunąć wiadomość?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
        <form method="post" action='' enctype='multipart/form-data'>
          <input type='hidden' name='delete_news' value='<?php echo $news_id; ?>'/>
          <button type="submit" class="btn btn-danger">Usuń</button>

        </form>
      </div>
    </div>
  </div>
</div>


</body>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php'; ?>
