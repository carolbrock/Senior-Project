<?php

$servername;
$serverUsername;
$serverPassword;

$conn = newsqli($servername, $serverUsername, $serverPassword);

if ($conn -> connect_error)
{
  die ("Connection failed: " . $conn -> connect_error);
}

?>
