<?php
require_once("db.php");
$link = connect();
$vkey=$_GET['link'];
$rezultat = mysqli_query($link, "SELECT * FROM users WHERE vkey='$vkey'");
while ($wiersz = mysqli_fetch_array ($rezultat)) {
$user_id = $wiersz[0];

}
?>
<title>Zmiana hasła</title>
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
		<?php
		if($_GET['error'] == 1){
			print "<div class='alert alert-warning' role='alert'>
		Hasło musi zawierać co najmniej 8 znaków
		</div>";
		}
		if($_GET['error'] == 2){
			print "<div class='alert alert-warning' role='alert'>
		Hasła muszą być takie same</div>";
		}

		?>
  <form method="post" action="changepass.php">
		Hasło<br>

			<input class="form-control" type="password" name="pass1" maxlength="30" size="30" required>
			<br>

    Ponownie wpisz hasło<br>

      <input class="form-control" type="password" name="pass2" maxlength="30" size="30" required>
      <br>
 <input type="hidden"  name="user_id" value="<?php echo $user_id; ?>">
  <input type="hidden"  name="vkey" value="<?php echo $vkey; ?>">
    <button class="btn btn-primary" type="submit">Zmień hasło</button>
  </form>
</div>

<br></br>

</BODY>
