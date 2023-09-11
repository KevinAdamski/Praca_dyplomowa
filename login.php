<?php
require_once("db.php");
$link = connect();
$rezultat = mysqli_query($link, "SELECT * FROM users");
while ($wiersz = mysqli_fetch_array ($rezultat)) {
$user = $wiersz[1];
}
?>
<title>Logowanie</title>
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
 Konto nie zostało zweryfikowane
</div>";
    }
		if($_GET['error'] == 2){
			print "<div class='alert alert-warning' role='alert'>
Niepoprawny adres e-mail lub hasło</div>";
    }
		if($_GET['verify'] == 1){
			print "<div class='alert alert-success' role='alert'>
Konto zostało zweryfikowane</div>";
		}
		?>
  <form method="post" action="verify.php">
	  Adres e-mail<br>

      <input class="form-control" type="text" name="email" maxlength="40" size="30">
      <br>
    Hasło<br>

      <input class="form-control" type="password" name="pass" maxlength="30" size="30">
      <br>

    <button class="btn btn-primary" type="submit">Zaloguj się</button>
  </form>
  Nie masz konta? <a href="register.php">Zarejestruj się. </a>
<br>
 <a href="forget.php">Zapomniałeś hasła? </a>

</div><br>
</div>

<br></br>

</BODY>
