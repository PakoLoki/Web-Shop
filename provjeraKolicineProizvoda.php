<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/baza.class.php";


$veza=new Baza();
$veza->spojiDB();

$kolicina = filter_input(INPUT_POST, "kolicina");
$idProizvoda = filter_input(INPUT_POST, "idProizvoda");


@$preracunataCijena=$kolicina*$cijenaProizvodaEuri;


$upit="SELECT * FROM `proizvod` WHERE proizvod_id='{$idProizvoda}'";

$rezultat=$veza->selectDB($upit);

if(mysqli_num_rows($rezultat)==1){
    while($red=mysqli_fetch_assoc($rezultat)){
        if($kolicina>$red['kolicina']){
            echo "<span style='color:red'>Prekoračili ste dostupnu količinu</span><br>";
            echo "<script>$('#plati-eurima').prop('disabled',true);</script>";
            echo "<script>$('#plati-bodovima').prop('disabled',true);</script>";
        }
        else{
            echo "<script>$('#plati-eurima').prop('disabled',false);</script>";
            echo "<script>$('#plati-bodovima').prop('disabled',false);</script>";
        }
    }
}





?>