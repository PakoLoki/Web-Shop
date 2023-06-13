<?php

/*
  + Neregistrirani korisnik može pristupiti stranicama: prijava.php, registracija.php, index.php
  + Registrirani korisnik može pristupiti svemu kao i neregistrirani korisnik plus: popis.php
  + Voditelj može pristupiti svemu kao i registrirani korisnik plus:multimedija.php
  + Administrator može pristupiti svim stranicama.
 */

echo "<nav style=\"padding: 1%\" class=\"stupac_1\">";
        if($_SESSION['uloga']==4){
            echo "<a href=\"$putanja/prijava.php\">Prijava</a>  
            <a href=\"$putanja/registracija.php\">Registracija</a>";
        }
        
       echo "<a href=\"$putanja/popisIzradenihProfila.php\">Popis kreiranih profila</a>
        <a href=\"$putanja/popisKampanja.php\">Popis kampanja</a>
    ";
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 4) {
    echo "<a href=\"$putanja/profil.php\">Moj Profil</a>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 3) {
    echo "<a href=\"$putanja/kreiranjeKampanje.php\">Kreiranje kampanje</a>";
    echo "<a href=\"$putanja/popisProizvoda.php\">Popis Proizvoda</a>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "1") {
    echo "<a href=\"$putanja/kreiranjeProizvoda.php\">Kreiranje Proizvoda</a>";
    echo "<a href=\"$putanja/blokiraniKorisnici.php\">Blokirani korisnici</a>";
    echo "<a href=\"$putanja/pregledDnevnika.php\">Dnevnik rada</a>";
}
echo "</nav>";
