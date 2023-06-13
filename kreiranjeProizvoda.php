<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";

if($_SESSION['uloga']>1){
    header("Location: profil.php");
}


$gumbPosalji='style="visibility:visible"';
$gumbAzuriraj='style="visibility:hidden"';


if(isset($_POST['gumb_proizvod'])){
    $azuriranjeAktivno=false;

    $greska=0;
    $checkiranStatus=false;

    $stilNaziv = 'style="color:red;"';
    $stilOpis = 'style="color:red;"';
    $stilSlika = 'style="color:red;"';
    $stilKolicina = 'style="color:red;"';
    $stilCijena = 'style="color:red;"';
 

    $nazivProizvod = XSS_SQL_inj($_POST['naziv_proizvod']);
    $opisProizvod = XSS_SQL_inj($_POST['opis_proizvod']);
    $slikaProizvod=XSS_SQL_inj($_POST['slika_proizvod']);
    $kolicinaProizvod=XSS_SQL_inj($_POST['kolicina_proizvod']);
    $cijenaProizvod = XSS_SQL_inj($_POST['cijena_proizvod']);
   


foreach ($_POST as $key => $value) {

    if (empty($value) && $key !== "gumb_proizvod"  ) {

        //echo "Nije uneseno: " . $key . "<br>";
        $greska++;
    } elseif ($key === "naziv_proizvod") {

        if ($value === "") {
            $stilNaziv = 'style="color:red;"';
        } else {
            $stilNaziv = 'style="color:rgb(242, 240, 234);;"';
        }
        
    } 
    
    elseif ($key === "opis_proizvod") {

        if ($value === "") {
            $stilOpis = 'style="color:red;"';
        } else {
            $stilOpis = 'style="color:rgb(242, 240, 234);;"';
        }

        
    }

    elseif ($key === "slika_proizvod") {

        if ($value === "") {
            $stilSlika = 'style="color:red;"';
        } else {
            $stilSlika = 'style="color:rgb(242, 240, 234);;"';
        }
    }

    elseif ($key === "cijena_proizvod") {

        if ($value === "") {
            $stilCijena = 'style="color:red;"';
        } else {
            $stilCijena = 'style="color:rgb(242, 240, 234);;"';
        }
    }
    

}

if(isset($_POST['status_proizvod'])){
    if($kolicinaProizvod<1){
        $statusProizvoda=0;
    }
    else{
        $statusProizvoda=1;
    $checkiranStatus=true;
    }
}
else{
    $statusProizvoda=0;
}

if($greska==0){
                    
    $moderatorProizvod=XSS_SQL_inj($_POST['moderatori']);

    $veza=new Baza();
    $veza->spojiDB();

    $upit="INSERT INTO `proizvod`(`proizvod_id`, `moderator_email`,`naziv_proizvoda`, `opis_proizvoda`, 
    `slika_proizvoda`, `kolicina`, `cijena_proizvoda`, `bodovi_kupac`, `cijena_u_bodovima`,`status_proizvoda`) 
    VALUES ('','{$moderatorProizvod}','{$nazivProizvod}','{$opisProizvod}','{$slikaProizvod}',
    '{$kolicinaProizvod}','{$cijenaProizvod}',0,0,'{$statusProizvoda}')";

    $rezultat= $veza->updateDB($upit);

    $datumUnosauDnevnik = date("Y-m-d h:i:s");

                $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                                        VALUES ('','{$_SESSION['korisnik']}',20,'{$datumUnosauDnevnik}')";

                $rezultat = $veza->updateDB($upit);

    $veza->zatvoriDB();

    header("Location: popisProizvoda.php");
}

}


        

if(isset($_GET['link'])){

    $_SESSION['id_proizvoda'] =XSS_SQL_inj($_GET['link']);


    $gumbPosalji='style="visibility:hidden"';
    $gumbAzuriraj='style="visibility:visible"';

    $veza=new Baza();
    $veza->spojiDB();

    $upit="SELECT * FROM `proizvod` WHERE `proizvod_id`={$_GET['link']};";

    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)>0){
        while($red=mysqli_fetch_assoc($rezultat)){
            $nazivProizvod=$red['naziv_proizvoda'];
            $opisProizvod=$red['opis_proizvoda'];
            $slikaProizvod=$red['slika_proizvoda'];
            $kolicinaProizvod=$red['kolicina'];
            $cijenaProizvod=$red['cijena_proizvoda'];
            $bodoviProizvod=$red['bodovi_kupac'];
            $statusProizvoda=$red['status_proizvoda'];
        }
     
    }

    $veza->zatvoriDB();

}

if(isset($_POST['gumb_azuriraj_proizvod'])){
    $azuriranjeAktivno=true;

    $greska=0;
    $checkiranStatus=false;

    $stilNaziv = 'style="color:red;"';
    $stilOpis = 'style="color:red;"';
    $stilSlika = 'style="color:red;"';
    $stilKolicina = 'style="color:red;"';
    $stilCijena = 'style="color:red;"';


    $nazivProizvod = XSS_SQL_inj($_POST['naziv_proizvod']);
    $opisProizvod =XSS_SQL_inj($_POST['opis_proizvod']);
    $slikaProizvod=XSS_SQL_inj($_POST['slika_proizvod']);
    $kolicinaProizvod=XSS_SQL_inj($_POST['kolicina_proizvod']);
    $cijenaProizvod = XSS_SQL_inj($_POST['cijena_proizvod']);
    $moderatorProizvod=XSS_SQL_inj($_POST['moderatori']);

    foreach ($_POST as $key => $value) {

        if (empty($value) && $key !== "gumb_proizvod" && $key !== "kolicina_proizvod") {
    
            //echo "Nije uneseno: " . $key . "<br>";
            $greska++;
        } elseif ($key === "naziv_proizvod") {
    
            if ($value === "") {
                $stilNaziv = 'style="color:red;"';
                echo "test";
            } else {
                $stilNaziv = 'style="color:rgb(242, 240, 234);;"';
            }
            
        } 
        
        elseif ($key === "opis_proizvod") {
    
            if ($value === "") {
                $stilOpis = 'style="color:red;"';
            } else {
                $stilOpis = 'style="color:rgb(242, 240, 234);;"';
            }
    
            
        }
    
        elseif ($key === "slika_proizvod") {
    
            if ($value === "") {
                $stilSlika = 'style="color:red;"';
            } else {
                $stilSlika = 'style="color:rgb(242, 240, 234);;"';
            }
        }
        elseif ($key === "cijena_proizvod") {
    
            if ($value === "") {
                $stilCijena = 'style="color:red;"';
            } else {
                $stilCijena = 'style="color:rgb(242, 240, 234);;"';
            }
        }
        
    
    }
    
    if(isset($_POST['status_proizvod'])){
        if($kolicinaProizvod<1){
            $statusProizvoda=0;
        }
        else{
            $statusProizvoda=1;
        $checkiranStatus=true;
        }
        
    }
    else{
        $statusProizvoda=0;
    }

    if ($greska === 0) {



        $veza = new Baza();
        $veza->spojiDB();

        if($kolicinaProizvod!=0){
            $upit = "UPDATE `proizvod` SET `moderator_email`='{$moderatorProizvod}',`naziv_proizvoda`='{$nazivProizvod}',
        `opis_proizvoda`='{$opisProizvod}',`slika_proizvoda`='{$slikaProizvod}',`kolicina`='{$kolicinaProizvod}',`cijena_proizvoda`='{$cijenaProizvod}',
        `status_proizvoda`='{$statusProizvoda}' WHERE `proizvod`.proizvod_id='{$_SESSION['id_proizvoda']}'";

        $rezultat = $veza->updateDB($upit,$skripta="./popisProizvoda.php");
        $veza->zatvoriDB();
        }

        else{
            $upit = "UPDATE `proizvod` SET `status_proizvoda`=0, `kolicina`=0 WHERE `proizvod`.proizvod_id='{$_SESSION['id_proizvoda']}'";
            $rezultat = $veza->updateDB($upit);

            $datumUnosauDnevnik = date("Y-m-d h:i:s");

                $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                                        VALUES ('','{$_SESSION['korisnik']}',21,'{$datumUnosauDnevnik}')";

                $rezultat = $veza->updateDB($upit);


            $veza->zatvoriDB();

            header("Location: popisProizvoda.php");
        }

    }

}

function XSS_SQL_inj($inputi) {
    $inputi = trim($inputi);
    $inputi = stripslashes($inputi);
    $inputi = htmlspecialchars($inputi);
    return $inputi;
}

?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Kreiranje proizvoda</title>
    <meta charset="utf-8">
    <meta name="author" content="plovrek">
    <meta name="keywords" content="promocija, proizvod">
    <meta name="description" content="7.3.2023.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/plovrek.css" type="text/css">
    <link rel="stylesheet" href="Css/plovrek_prilagodbe.css" type="text/css">
    
</head>

<body>
    <header>
        <div class="traka-izbornika">
            <div class="logo-jezik">
                <div class="logo">
                    <a href="prijava.php"><img src="./Multimedija/logo.png" alt="logo"></a>
                </div>
                <div class="sadrzaj_padajuci">
                    <select name="jezici" id="jezici">
                        <option value="Hrvatski">Hrvatski</option>
                        <option value="Engleski">Engleski</option>
                        <option value="Njemački">Njemački</option>
                    </select>

                </div>
            </div>
            <div id="pocetak">
                <h2>Kreiranje proizvoda</h2>
            </div>

            <div id="prozor">
                <a href="#">
                    <img src="./Multimedija/cancel.png" alt="zatvori" width="25">
                </a>
                <form action="http://barka.foi.hr/WebDiP/2022/materijali/zadace/ispis_forme.php">
                    <label for="trazi">Pojam</label>
                    <input type="search" id="trazi" name="trazi">
                    <input type="submit" name="trazi" value="Pretrazi">
                </form>
            </div>
            <div class="ikona-odjava">
                <div>
                    <a class="search-slika" href="#prozor">
                        <img src="./Multimedija/search.png" alt="trazi" width="25">
                    </a>
                </div>
                <div>
                <a href="logout.php" <?php if(isset($vidljivostGumba)){echo "$vidljivostGumba";} ?>><button name="odjava">Odjava</button></a>
                </div>
            </div>
        </div>
    </header>
    
    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1>Unos proizvoda!</h1>
        </div>

        <div class="grid-posebno-2">

        
                    
            <form id="proizvod-forma" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

            <label for="moderatori" id="moderatori-proizvod-labela">Odaberite moderatora za proizvod</label><br>
                <select id="moderatori" name="moderatori" form="proizvod-forma">
                <?php 

                $veza=new Baza();
                $veza->spojiDB();

                $upit="SELECT * FROM `korisnik` WHERE tip_id BETWEEN 1 AND 2";

                $rezultat=$veza->selectDB($upit);

                if(mysqli_num_rows($rezultat)>0){
                    while($red=mysqli_fetch_assoc($rezultat)){
                        echo "<option value=\"{$red['email']}\">{$red['ime']} {$red['prezime']}</option>";
                        
                    }
                }             
                ?>
            </select><br><br>
            
            <label for="naziv-proizvod" id="naziv-proizvod-labela" <?php if (isset($stilNaziv)) {
                                                    echo "$stilNaziv";
                                                }  ?>>Naziv proizvoda</label><br>
            <input type="text" id="naziv-proizvod" name="naziv_proizvod" value="<?php if(isset($nazivProizvod)){echo "$nazivProizvod";} ?>"><br><br>
            <label for="opis-proizvod" id="opis-proizvod-labela" <?php if (isset($stilOpis)) {
                                                    echo "$stilOpis";
                                                }  ?>>Opis proizvoda</label><br>
            <input type="text" name="opis_proizvod" id="opis-proizvod" value="<?php if(isset($opisProizvod)){echo "$opisProizvod";} ?>"><br><br>
            <label for="slika-proizvod" id="slika-proizvod-labela" <?php if (isset($stilSlika)) {
                                                    echo "$stilSlika";
                                                }  ?>>Slika</label><br>
            <input type="file" name="slika_proizvod" id="slika-proizvod" accept=".jpg, .jpeg, .png" value="<?php if(isset($slikaProizvod)){echo "$slikaProizvod";} ?>"><br><br>
            <label for="kolicina-proizvod" id="kolicina-proizvod-labela" <?php if (isset($stilKolicina)) {
                                                    echo "$stilKolicina";
                                                }  ?>>Količina</label><br>
            <input type="number" name="kolicina_proizvod" id="kolicina_proizvod" value="<?php if(isset($kolicinaProizvod)){echo "$kolicinaProizvod";} ?>"><br><br>
            <label for="cijena-proizvod" id="cijena-proizvod-labela" <?php if (isset($stilCijena)) {
                                                    echo "$stilCijena";
                                                }  ?>>Iznos proizvoda u cijeni</label><br>
            <input type="number" name="cijena_proizvod" id="cijena_proizvod" value="<?php if(isset($cijenaProizvod)){echo "$cijenaProizvod";} ?>"><br><br>
            <input type="checkbox" name="status_proizvod" id="bodovi-proizvod" value="1" <?php if(isset($statusProizvoda)){ if ($statusProizvoda == 1) {
                                                                                                                    echo "checked";
                                                                                                                }} ?>>
            <label for="status-proizvod" id="status-proizvod-labela">Dostupno</label><br><br>
            <input type="submit" name="gumb_proizvod" id="gumb-proizvod" value="Unesi" <?php if(isset($gumbPosalji)){echo "$gumbPosalji";} ?>><br>
            <input type="submit" name="gumb_azuriraj_proizvod" id="gumb-azuriraj-proizvod" value="Ažuriraj" <?php if(isset($gumbAzuriraj)){echo "$gumbAzuriraj";} ?>>
            </form>
            
        </div>  
    </section>

    <footer>

        <address>Kontakt: <a href="mailto:plovrek@foi.hr">Patrik Lovrek</a></address>
        <a href="https://validator.w3.org/check?uri=https://barka.foi.hr/WebDiP/2022/zadaca_01/plovrek/">
            <img src="./Multimedija/HTML5.png" alt="HTML" width="50">
        </a>
        <a href="https://validator.w3.org/check?uri=https://barka.foi.hr/WebDiP/2022/zadaca_01/plovrek/">
            <img src="./Multimedija/CSS3.png" alt="CSS" width="50">
        </a>
        <div>
            <p>Privola za prikupljanje podataka</p>
            <select name="prikupljanje-podataka" id="prikupljanje-podataka">
                <option value="osnovno">Osnovno</option>
                <option value="bez-prikupljanja">Bez prikupljanja</option>
                <option value="sve">Sve</option>
            </select>
        </div>
        <p>&copy; 2023 P.Lovrek</p>
    </footer>
    
</body>
<script src="./javascript/registracija.js"></script>
</html>