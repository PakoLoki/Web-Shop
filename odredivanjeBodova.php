<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/baza.class.php";


$cijena = filter_input(INPUT_POST, "cijena");
$index=filter_input(INPUT_POST, "index");

@$bodovi=$cijena*$index;

if(!ctype_digit($cijena) || empty($cijena)){
    echo "Nije ispravan format cijene";
}
else{
  
        echo $bodovi;

    
}

    




?>