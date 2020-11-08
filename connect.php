<?php

$user = 'root';
$pass = '';
$db = 'demo';

/*$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");*/

$conn = mysqli_connect('localhost', $user, $pass, $db);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

//echo "Success";



?>
