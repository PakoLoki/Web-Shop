<?php

require "./skripte/zaglavlje.php";

$veza=new Baza();
$veza->spojiDB();

if(isset($_SESSION)){
    $datumUnosauDnevnik = date("Y-m-d h:i:s");

    $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                            VALUES ('','{$_SESSION['korisnik']}',26,'{$datumUnosauDnevnik}')";

    $rezultat = $veza->updateDB($upit);

    $veza->zatvoriDB();

Sesija::obrisiSesiju();
session_write_close();

header("Location: prijava.php");
}

?>