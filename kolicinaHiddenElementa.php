<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/baza.class.php";


$veza=new Baza();
$veza->spojiDB();

$kolicina = filter_input(INPUT_POST, "kolicina");

echo $kolicina;

?>