<?php
header("refresh: 122");
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";


if($_SESSION['uloga']>3){
    header("Location: prijava.php");
}

if(isset($_SESSION['korisnik'])){
    $korisnikAktivacija=XSS_SQL_inj($_SESSION['korisnik']);
}


if(isset($_GET['gumb_aktivacija'])){

    $uneseniKod=XSS_SQL_inj($_GET['aktivacijski_kod_key']);
    $greskaKod="";

    $veza=new Baza();
    $veza->spojiDB();
    
   $upit="SELECT * FROM `korisnik` WHERE email='{$korisnikAktivacija}'";

   $rezultat=$veza->selectDB($upit);

   if(mysqli_num_rows($rezultat)==1){
   while($red=mysqli_fetch_assoc($rezultat)){
    $kod = $red['aktivacijski_kod'];
        }
        if($kod===$uneseniKod){

            $datumUnosauDnevnik=date("Y-m-d h:i:s");

            $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`,`datum_vrijeme_zapisa`) 
            VALUES ('','{$_SESSION['korisnik']}',4,'{$datumUnosauDnevnik}')";

            $rezultat= $veza->updateDB($upit);

            header("Location: profil.php");
        }
        else{

            $datumUnosauDnevnik=date("Y-m-d h:i:s");
            $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`,`datum_vrijeme_zapisa`) 
            VALUES ('','{$_SESSION['korisnik']}',5,'{$datumUnosauDnevnik}')";

            $rezultat= $veza->updateDB($upit);

            $greskaKod="Kod je nevaljan";
        }
   }
   else{

    header("Location: registracija.php");
   }


$veza->zatvoriDB();

}

if ($_SESSION['trajanjeKoda'] + 2* 60 < time()) {


    $veza=new Baza();
    $veza->spojiDB();

    $upit="DELETE FROM `registar_bodova` WHERE korisnik_email='{$_SESSION['korisnik']}'";
    $rezultat=$veza->updateDB($upit);

    $upit="DELETE FROM `dnevnik_rada` WHERE email='{$_SESSION['korisnik']}'";
    $rezultat=$veza->updateDB($upit);

    $upit="DELETE FROM `korisnik` WHERE email='{$_SESSION['korisnik']}'";
    $rezultat=$veza->updateDB($upit);

    $veza->zatvoriDB();

    if(isset($_SESSION)){
        Sesija::obrisiSesiju();
    }

    header("Location: registracija.php");

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
    <title>Početna stranica</title>
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
                <h2>Aktivacija</h2>
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
                    <button>Odjava</button>
                </div>
            </div>
        </div>
    </header>

    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1 style="font-size: 200%;">Aktiviraj pomoću koda koji smo ti poslali na mail.</h1>
        </div>

        <?php if(isset($greskaKod)){echo "<div style='text-align:center;'><p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: #e4e40c \">$greskaKod</p></div>";}  ?>

        <div class="grid-posebno-2">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="GET">
                    <label for="aktivacijski-kod" id="aktivacijski-kod-labela">Aktivacijski kod</label><br><br>
                    <input type="text" id="aktivacijski-kod" name="aktivacijski_kod_key" autocomplete="off"><br><br>
                    <input type="submit" id="gumb-aktivacija" name="gumb_aktivacija" value="Aktiviraj">
            </form>
            <p style="font-family:Georgia, 'Times New Roman', Times, serif;
                    color: rgb(242, 240, 234);
                    padding-bottom: 3%;">Aktivacijski kod traje 2 minute.</p>
            <p style="font-family:Georgia, 'Times New Roman', Times, serif;
                    color: rgb(242, 240, 234);
                    padding-bottom: 3%;">Nakon 2 minute vraća vas na obrazac za registraciju te ga morate ponovno ispuniti.</p>
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

</html>