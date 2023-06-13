<?php

$user="root";
$pass="";
$baza="WebDiP2022x026";


$baza= new mysqli("localhost",$user, $pass, $baza) or die("Nije se izvršilo");

echo "Spojilo se na bazu";

?>