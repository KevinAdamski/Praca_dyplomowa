<?php
// klucz witryny 6Ld6VBQiAAAAAJRXVZOq3Q161BA-ZcXGKD1z5gYK
//tajny klucz  6Ld6VBQiAAAAAJ6-ia2UbebyWbH06w_vEXd_EpOZ
require_once("db.php");
$link = connect();
$link=connect();
$search = mysqli_query($link, "SELECT * FROM site_config WHERE id_config = 1 ");
$record = mysqli_fetch_array($search);
$regulamin=$record['reg'];
?>
<script src='https://www.google.com/recaptcha/api.js'></script>

<title>Rejestracja</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="../js/jquery-3.4.1.min.js"></script>
<style>
	.rejestracja{
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
	#g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}

</style>
<body>
<br></br>
<div class="rejestracja">
	<br><br>
	<div class="formularz">
		<?php
        if($_GET['error1'] == 1){
			print "<div class='alert alert-warning' role='alert'>
 Użytkownik o podanym adresie e-mail już istnieje
</div>";
    }
if($_GET['error2'] == 1){
			print "<div class='alert alert-warning' role='alert'>
 Hasło musi zawierać conajmniej 8 znaków
</div>";}
	if($_GET['error3'] == 1){
			print "<div class='alert alert-warning' role='alert'>
Hasła muszą być takie same</div>";}

		?>



<form method="post" action="register_verify.php">

	<label>Imię
		<input class="form-control" type="text" name="name" maxlength="40" size="40" required><br></label>
<label>Nazwisko
 <input class="form-control" type="text" name="surname" maxlength="40" size="40" required><br></label>
<label>Adres email
	<input class="form-control" type="text" name="email" maxlength="40" size="40" required><br></label>

<label>Hasło

 <input class="form-control" type="password" name="pass1" maxlength="40" size="40" required><br></label>

	<label>Powtórz hasło

 <input class="form-control" type="password" name="pass2" maxlength="40" size="40" required></label><br><br>


	<label>Płeć
<select class="form-control" name="sex">
  <option value="1">Mężczyzna</option>
  <option value="2">Kobieta</option>
	</select></label>
<br></br>



<label>
	Data urodzin
    <input type="date" name="bday" class="form-control" required>
  </label><br><br>

		<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
  <label class="form-check-label" for="flexCheckDefault">
    Akceptuję  <a href=""  data-bs-toggle="modal" data-bs-target="#exampleModal">regulamin</a>
  </label>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Regulamin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php print $regulamin; ?>
      </div>
    </div>
  </div>
</div>

	<br></br>
	<div class="g-recaptcha" data-sitekey="6Ld6VBQiAAAAAJRXVZOq3Q161BA-ZcXGKD1z5gYK" ></div>
<br></br>
<button class="btn btn-primary" type="submit">Zajerestruj się</button>
<br></br?
</div>
</div>

</form>
<script>
window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
</script>
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
