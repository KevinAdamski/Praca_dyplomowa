<?php
function connect()
{
	$site_link="https://serwer2241105.home.pl/";
    $dbhost = "serwer2241105.home.pl";
    $dbuser = "36456610_kevinadamski";
    $dbpassword = "qwerty123!@#UIOP";
    $dbname = "36456610_kevinadamski";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if (!$polaczenie) {
        return "Błąd połączenia z MySQL." . PHP_EOL;
    } else {
        return $polaczenie;
    }
}