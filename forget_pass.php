<?php

require_once("db.php");
$link = connect();

			 if (isset($_POST['email'])) {
		     $email=$_POST['email'];
			  $searchemail = mysqli_query($link, "SELECT * from users WHERE email = '$email'");
             if(mysqli_num_rows($searchemail)) {

                 $subject = "Reset hasła";
                 $header = "Reset hasła";
                 $vkey = md5(time().$email);
                 $text = "Aby ustawić nowe hasło kliknij w poniższy link
                 https://serwer2241105.home.pl/editpass.php?link=$vkey";
                 mail($email, $subject, $text, $header);
                  $result = mysqli_query($link, "UPDATE `users` SET vkey = '$vkey' WHERE email = '$email'");

			  }
				 }
header('Location: login.php');
?>
