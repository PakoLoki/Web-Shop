<?php

require "baza.class.php";
require "sesija.class.php";
//require "meni.php";
date_default_timezone_set("Europe/Zagreb");

Sesija::kreirajSesiju();

$vidljivostGumba="";

if(isset($_SESSION['korisnik'])){
    
    $vidljivostGumba="";

            $veza=new Baza();
            $veza->spojiDB();

            $upit="SELECT * FROM `tip_korisnika` WHERE tip_id='{$_SESSION['uloga']}'";

            $rezultat=$veza->selectDB($upit);

            if(mysqli_num_rows($rezultat)==1){
                while($red=mysqli_fetch_assoc($rezultat)){
                    $nazivUloge=$red['naziv_tipa'];
                }
            }
}
else{
    
    $_SESSION['uloga']=4;

    $vidljivostGumba="style=visibility:hidden";
}
