<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/baza.class.php";


$veza=new Baza();
$veza->spojiDB();

$kolicina = filter_input(INPUT_POST, "kolicina");
$cijenaProizvoda = filter_input(INPUT_POST, "cijenaProizvoda");
$idProizvoda= filter_input(INPUT_POST, "idProizvoda");





$upit="SELECT * FROM `proizvod` WHERE proizvod_id='{$idProizvoda}'";

$rezultat=$veza->selectDB($upit);

if(mysqli_num_rows($rezultat)==1){
    while($red=mysqli_fetch_assoc($rezultat)){
        $preracunataCijena=$kolicina*$red['cijena_u_bodovima'];
        if($preracunataCijena!=0){
            echo $preracunataCijena;
        }
        else{
            echo 0;
        }
        
    }
}





?>