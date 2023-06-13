<?php
header("refresh: 122");
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";


if (isset($_GET['gumb_aktivacija'])) {
    $mail = XSS_SQL_inj($_GET['zaboravljena_lozinka']);

    $velikaSlova = range('A', 'Z');
    $malaSlova = range('a', 'z');
    $brojevi = range(0, 9);

    $spoji = array_merge($velikaSlova, $malaSlova, $brojevi);
    $duljinaLozinke = count($spoji);

    $novaLozinka = "";

    $novaLozinka .= $velikaSlova[array_rand($velikaSlova)];
    $novaLozinka .= $malaSlova[array_rand($malaSlova)];
    $novaLozinka .= $brojevi[array_rand($brojevi)];

    for ($i = strlen($novaLozinka); $i < 18; $i++) {
        $novaLozinka .= $spoji[rand(0, $duljinaLozinke - 1)];
    }

    $novaLozinka = str_shuffle($novaLozinka);

    $salt = "asdjdndsaj45jndfs#12";
    $kriptiranaSifra = $novaLozinka;
    $sifraSHA = sha1($kriptiranaSifra . $salt);

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT `email` FROM `korisnik` WHERE email='{$mail}'";

    $rezultat = $veza->selectDB($upit);
    $datumUnosauDnevnik = date("Y-m-d h:i:s");

    if (mysqli_num_rows($rezultat) == 0) {
        echo "Email ne postoji u bazi";

        $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                VALUES ('','{$mail}',9,'{$datumUnosauDnevnik}')";

        $rezultat = $veza->updateDB($upit);
    } else {
        $upit = "UPDATE `korisnik` SET `lozinka`='{$novaLozinka}',`lozinka_sha256`='{$sifraSHA}' WHERE email='{$mail}'";
        $rezultat = $veza->updateDB($upit);
        mail($mail, "Vaša nova lozinka", "Vaša nova lozinka za aplikaciju je: {$novaLozinka}");

        $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                VALUES ('','{$mail}',10,'{$datumUnosauDnevnik}')";

        $rezultat = $veza->updateDB($upit);
    }

    $veza->zatvoriDB();
    header("Location: prijava.php");
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
                    <!--<button>Odjava</button>-->
                </div>
            </div>
        </div>
    </header>

    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1 style="font-size: 200%;">Resetiraj lozinku</h1>
        </div>

        <?php if (isset($greskaKod)) {
            echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$greskaKod</p>";
        }  ?>

        <div class="grid-posebno-2">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="GET" style="padding-bottom:5%">
                <label for="zaboravljena-lozinka" id="aktivacijski-kod-labela">Upišite mail na koji će vam se poslati nova lozinka</label><br><br>
                <input type="text" id="zaboravljena-lozinka" name="zaboravljena_lozinka"><br><br>
                <input type="submit" id="gumb-aktivacija" name="gumb_aktivacija" value="Pošalji">
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

</html>