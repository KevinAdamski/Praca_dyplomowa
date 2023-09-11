<?php

require_once("db.php");
$link = connect();
$vkey=$_POST['vkey'];
$user_id=$_POST['user_id'];

        //Pobieranie hasła z pierwszego pola tekstowego
		           $pass1=$_POST['pass1'];

        //Pobieranie hasła z drugiego pola tekstowego
               $pass2=$_POST['pass2'];

        //Sprawdza czy hasło 1 posiada mniej niż 8 znaków
					 if (strlen($pass1) < 8) {

             //Przenosi do formularza zmiany hasła i wyświetla błąd
						 header('Location: editpass.php?link=' . $vkey . "&error=1");

             //Sprawdza czy hasło 1 jest takie samo jak hasło 2
           }else  if($pass1 != $pass2){

             //Przenosi do formularza zmiany hasła i wyświetla błąd
						    header('Location: editpass.php?link=' . $vkey . "&error=2");
              }else{
                         $vkey = md5(time().$user_id);

                         //hashowanie nowego hasła
										     $hash = password_hash($pass1, PASSWORD_DEFAULT);

                         //aktualizacja hasła
												  $result = mysqli_query($link, "UPDATE `users` SET pass = '$hash', vkey = '$vkey' WHERE idu = '$user_id'");
												  header('Location: login.php');
}


?>
