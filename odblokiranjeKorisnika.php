<?php

require "./skripte/zaglavlje.php";

echo "yo";

$veza=new Baza();
$veza->spojiDB();

$upit="UPDATE `korisnik` SET `broj_unosa`= 0, `status_racuna`= 1  WHERE `email`='{$_GET['link']}'";

$rezultat = $veza->updateDB($upit);

$datumUnosauDnevnik = date("Y-m-d h:i:s");

    $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                            VALUES ('','{$_SESSION['korisnik']}',23,'{$datumUnosauDnevnik}')";

    $rezultat = $veza->updateDB($upit);

$veza->zatvoriDB();

header("Location: blokiraniKorisnici.php")
?>