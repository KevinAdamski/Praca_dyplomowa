<?php
// klucz witryny 6Ld6VBQiAAAAAJRXVZOq3Q161BA-ZcXGKD1z5gYK
//tajny klucz  6Ld6VBQiAAAAAJ6-ia2UbebyWbH06w_vEXd_EpOZ
require_once("db.php");
$link = connect();
$error=array();
	if (isset($_POST['name'])) {
		$name=$_POST['name'];

		  if (isset($_POST['surname'])) {
		  $surname=$_POST['surname'];

			 if (isset($_POST['email'])) {
		     $email=$_POST['email'];
			  $searchemail = mysqli_query($link, "SELECT * from users WHERE email = '$email'");
             if(mysqli_num_rows($searchemail)) {
				 array_push($error, "1");
				 $error_email=1;
			  }
			 }

                 if (isset($_POST['bday'])) {
		             $bday=$_POST['bday'];

				   if (isset($_POST['pass1'])) {
		           $pass1=$_POST['pass1'];}
					 if (strlen($pass1) < 8) {
						 array_push($error, "2");
						 $error_pass1=1;
						  }
					 if (isset($_POST['pass2'])) {
		             $pass2=$_POST['pass2'];}
					   if($pass1 != $pass2){
						   array_push($error, "3");
						   $error_pass2=1;
						   }
						 if (isset($_POST['sex'])) {
		                 $sex=$_POST['sex'];}

							 if(count($error) == 0){

										  $secret = '6Ld6VBQiAAAAAJ6-ia2UbebyWbH06w_vEXd_EpOZ';
										  $response = $_POST['g-recaptcha-response'];
                                          $remoteip = $_SERVER['REMOTE_ADDR'];
										     $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
                                             $result = json_decode($url, TRUE);
                                             if ($result['success'] == 1) {

										  $hash = password_hash($pass1, PASSWORD_DEFAULT);
												 $subject = "Weryfikacja";
												 $header = "Zwertfikuj swoje konto";
												 $vkey = md5(time().$email);
												 $text = "Zweryfikuj swoje konto klikając w poniższy link
												 https://serwer2241105.home.pl/email_verify.php?link=$vkey";
												 mail($email, $subject, $text, $header);
												  $result = mysqli_query($link, "INSERT INTO `users` (`name`,`surname`,`pass`,`email`,`sex`,`bday`,`verify`,`vkey`) VALUES ('$name','$surname','$hash','$email','$sex','$bday','1','$vkey')");
												  header('Location: https://serwer2241105.home.pl');
											 }
							 }else{

												 header('Location: https://serwer2241105.home.pl/register.php?error1=' . $error_email . '&error2=' . $error_pass1 . '&error3=' . $error_pass2);
											 }
									  }
									 }

				 }





?>
