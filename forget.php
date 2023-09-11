<?php
require_once("db.php");
$link = connect();
$rezultat = mysqli_query($link, "SELECT * FROM users");
while ($wiersz = mysqli_fetch_array ($rezultat)) {
$user = $wiersz[1];
}
?>
<title>Reset hasła</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
	.logowanie{
    width: 550px;
    margin: auto;
    border: 3px groove #0b5ed7;
 	border-radius: 40px;
		background-color: white;
	}
	.formularz{
		width: 400px;
		margin: auto;
		background-color: white;
	}
	body{
		background-color: #0b5ed7;
	}
}

</style>
<BODY>
<br></br>
<div class="logowanie">
	<br><br>
	<div class="formularz">

  <form method="post" action="forget_pass.php">
	  W celu zmiany hasła podaj adres e-mail<br>

      <input class="form-control" type="text" name="email" maxlength="40" size="30" required>
      <br>


    <button class="btn btn-primary" type="submit">Wyślij</button>
  </form>
</div>

<br></br>

</BODY>
