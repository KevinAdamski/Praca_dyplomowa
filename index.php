<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Strona główna</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">


	  <?php include 'navbar.php'; ?>
  </head>
<body>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  <body>
	  <style>
		  .karuzela{
			  width: auto;
			  height: auto;
			  margin: auto;
			  max-height: 720px;
		  }
		  .carousel-item{
			  width: auto;
			  height: auto;
			  max-height: 720px;
		  }

	  </style>
	  <?php
	  $search_images = mysqli_query($link, "SELECT * FROM site_config WHERE id_config = 1 ");
$record_images = mysqli_fetch_array($search_images);
$image1= "img/carousel/" . $record_images['carousel_1'];
$image2= "img/carousel/" . $record_images['carousel_2'];
$image3= "img/carousel/" . $record_images['carousel_3'];
	  ?>



<div class="karuzela">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src=<?php echo $image1;  ?> class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src=<?php echo $image2;  ?> class="d-block w-100" alt="..." />
        </div>
        <div class="carousel-item">
          <img src=<?php echo $image3;  ?> class="d-block w-100" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</div>
<br><div style='text-align: center;'>
	  <?php if($_SESSION['canNews']==1){
      print "<h3><a href='https://serwer2241105.home.pl/news.php' class='btn btn-primary'  role='button' >Nowa Wiadomość</a></h3>";
    }
    $news_search = mysqli_query($link, "SELECT * FROM News ORDER BY datatime DESC");
    while ($news_grid = mysqli_fetch_array($news_search)) {
     $news_id=$news_grid[0];
     $title=$news_grid[1];
     $textnews=$news_grid[2];
     $user_id=$news_grid[3];
     $news_data=$news_grid[4];
     $news_link="https://serwer2241105.home.pl/newsedit.php?news=" . $news_id;
     $search_user = mysqli_query($link, "SELECT * FROM users WHERE idu='$user_id'");
      $user_grid = mysqli_fetch_array($search_user);
       $name=$user_grid['name'];
       $surname=$user_grid['surname'];
       $user_date="autor:&nbsp" . $name . "&nbsp" . $surname . "&nbsp&nbsp&nbsp dodano: &nbsp" . $news_data;

     print "<div class='col d-flex justify-content-center'>
     <div class='card' style='width:700px'>
  <div class='card-header'>
    $title
  </div>
  <div class='card-body'>
    <i> $user_date</i>
    <p class='card-text'>$textnews</p>";
    if($_SESSION['canNews']==1){
  print   "<a href='$news_link' class='btn btn-primary'>Edytuj</a>"; }
  print "</div>
</div>
</div><br>";
}  ?>
</div>










  <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
  <!--<script src="script.js"></script>-->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"
  ></script>



 <script src="js/jquery-3.4.1.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php include 'footer.php'; ?>
