<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/baza.class.php";


$veza=new Baza();
$veza->spojiDB();

$username = filter_input(INPUT_POST, "username");


if(!empty($username)){

    $upit="SELECT * FROM `korisnik` WHERE korisnicko_ime='{$username}'";

    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)>0){
        echo "<span style='color:red'>Username već postoji</span><br>";
        echo "<script>$('#registracija-gumb').prop('disabled',true);</script>";
    }
    else{
        echo "<span style='color:rgb(44, 235, 23);'>Username je ok</span><br>";
        echo "<script>$('#registracija-gumb').prop('disabled',false);</script>";
    }
}



?>