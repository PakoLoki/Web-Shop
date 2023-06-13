<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";

if($_SESSION['uloga']>2){
    header("Location: profil.php");
}


$gumbPosalji = 'style="visibility:visible"';
$gumbAzuriraj = 'style="visibility:hidden"';


if (isset($_POST['gumb_kampanja'])) {


    $greska = 0;

    $proizvodPostavljen = false;

    $stilNaziv = 'style="color:red;"';
    $stilOpis = 'style="color:red;"';
    $stilDatumPocetak = 'style="color:red;"';
    $stilDatumZavrsetak = 'style="color:red;"';

    $nazivKampanja = XSS_SQL_inj($_POST['naziv_kampanja']);
    $opisKampanja = XSS_SQL_inj($_POST['opis_kampanja']);
    $datumPocetakKampanja = XSS_SQL_inj($_POST['datum_vrijeme_pocetka_kampanje']);
    $datumZavrsetakKampanja = XSS_SQL_inj($_POST['datum_vrijeme_zavrsetka_kampanje']);

    foreach ($_POST as $key => $value) {

        if (empty($value) && $key !== "gumb_kampanja") {

            //echo "Nije uneseno: " . $key . "<br>";
            $greska++;
        } elseif ($key === "naziv_kampanja") {

            if ($value === "") {
                $stilNaziv = 'style="color:red;"';
            } else {
                $stilNaziv = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "opis_kampanja") {

            if ($value === "") {
                $stilOpis = 'style="color:red;"';
            } else {
                $stilOpis = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "datum_vrijeme_pocetka_kampanje") {

            if ($value === "") {
                $stilDatumPocetak = 'style="color:red;"';
            } else {
                $stilDatumPocetak = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "datum_vrijeme_zavrsetka_kampanje") {

            if ($value === "") {
                $stilDatumZavrsetak = 'style="color:red;"';
            } else {
                $stilDatumZavrsetak = 'style="color:rgb(242, 240, 234);;"';
            }
        }
    }



    if (isset($_POST['proizvod'])) {
        $proizvodPostavljen = true;
    } else {
        $proizvodGreska="<div style='color:red;'>Barem jedan proizvod mora biti odabran kako bi se kampanja kreirala!</div>";
        $proizvodPostavljen = false;
        $greska++;
    }

    if ($greska == 0 && $proizvodPostavljen == true) {

        $suma = 0;

        $veza = new Baza();
        $veza->spojiDB();


        $upit = "INSERT INTO `kampanja`(`kampanja_id`, `korisnik_email`, `naziv_kampanje`, 
    `opis_kampanje`, `zbroj_kolicine_proizvoda`, `datum_vrijeme_pocetka`, `datum_vrijeme_zavrsetka`) VALUES 
    ('','{$_SESSION['korisnik']}','{$nazivKampanja}','{$opisKampanja}',0 ,'{$datumPocetakKampanja}','{$datumZavrsetakKampanja}')";

        $rezultat = $veza->updateDB($upit);

        $upit = "SELECT * FROM `kampanja` WHERE korisnik_email='{$_SESSION['korisnik']}'";

        $rezultat = $veza->selectDB($upit);

        if (mysqli_num_rows($rezultat) > 0) {
            while ($red = mysqli_fetch_assoc($rezultat)) {
                $zadnjeUneseniID = $red['kampanja_id'];
            }
        }

        if (isset($_POST['proizvod'])) {
            $proizvodKampanja = $_POST['proizvod'];
            foreach ($proizvodKampanja as $proizvod) {

                $upit = "INSERT INTO `kampanja_proizvod`(`kampanja_id`, `proizvod_id`) VALUES ('{$zadnjeUneseniID}','{$proizvod}')";

                $rezultat = $veza->updateDB($upit);
            }
        }

        $upit = "SELECT * FROM `proizvod`
    WHERE `proizvod_id` IN (SELECT `proizvod_id` FROM `kampanja_proizvod` WHERE kampanja_id = '{$zadnjeUneseniID}')";
        $rezultat = $veza->selectDB($upit);

        if (mysqli_num_rows($rezultat) > 0) {
            while ($red = mysqli_fetch_assoc($rezultat)) {
                $sumaKolicineProizvoda[] = $red['kolicina'];
            }
        }
        foreach ($sumaKolicineProizvoda as $kolicina) {
            $suma += $kolicina;
        }

        $upit = "UPDATE `kampanja` SET `zbroj_kolicine_proizvoda`='{$suma}' WHERE kampanja_id='{$zadnjeUneseniID}'";
        $rezultat = $veza->updateDB($upit);

        $datumUnosauDnevnik = date("Y-m-d h:i:s");

        $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                                        VALUES ('','{$_SESSION['korisnik']}',16,'{$datumUnosauDnevnik}')";

        $rezultat = $veza->updateDB($upit);

        $veza->zatvoriDB();
        header("Location: popisKampanja.php");
    }
}




if (isset($_GET['link'])) {



    $_SESSION['kampanja_id'] = XSS_SQL_inj($_GET['link']);

    $proizvodeki = "";
    $pomocna = "";

    $gumbPosalji = 'style="visibility:hidden"';
    $gumbAzuriraj = 'style="visibility:visible"';

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT * FROM `kampanja` WHERE `kampanja_id`={$_GET['link']};";

    $rezultat = $veza->selectDB($upit);

    if (mysqli_num_rows($rezultat) > 0) {
        while ($red = mysqli_fetch_assoc($rezultat)) {
            $nazivKampanja = $red['naziv_kampanje'];
            $opisKampanja = $red['opis_kampanje'];
            $datumPocetakKampanja = $red['datum_vrijeme_pocetka'];
            $datumZavrsetakKampanja = $red['datum_vrijeme_zavrsetka'];
        }
    } else {
        echo "Nije još unesena kampanja";
    }



    $upit = "SELECT proizvod.*, kampanja_proizvod.kampanja_id
    FROM proizvod
    INNER JOIN kampanja_proizvod ON proizvod.proizvod_id = kampanja_proizvod.proizvod_id
    WHERE kampanja_proizvod.kampanja_id = '{$_GET['link']}'";

    $rezultat = $veza->selectDB($upit);

    if (mysqli_num_rows($rezultat) > 0) {
        while ($red = mysqli_fetch_assoc($rezultat)) {
            $emailVlasnikaKampanje = $red['moderator_email'];
        }
    }
    $_SESSION['emailVlasnikaKampanje']  = $emailVlasnikaKampanje;


    $veza->zatvoriDB();
}


if (isset($_POST['gumb_azuriraj_kampanju'])) {


    $brojac = 0;



    $greska = 0;
    $proizvodPostavljen = false;

    $stilNaziv = 'style="color:red;"';
    $stilOpis = 'style="color:red;"';
    $stilDatumPocetak = 'style="color:red;"';
    $stilDatumZavrsetak = 'style="color:red;"';

    $nazivKampanja = XSS_SQL_inj($_POST['naziv_kampanja']);
    $opisKampanja = XSS_SQL_inj($_POST['opis_kampanja']);
    $datumPocetakKampanja =XSS_SQL_inj( $_POST['datum_vrijeme_pocetka_kampanje']);
    $datumZavrsetakKampanja = XSS_SQL_inj($_POST['datum_vrijeme_zavrsetka_kampanje']);

    foreach ($_POST as $key => $value) {

        if (empty($value) && $key !== "gumb_kampanja") {

            //echo "Nije uneseno: " . $key . "<br>";
            $greska++;
        } elseif ($key === "naziv_kampanja") {

            if ($value === "") {
                $stilNaziv = 'style="color:red;"';
            } else {
                $stilNaziv = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "opis_kampanja") {

            if ($value === "") {
                $stilOpis = 'style="color:red;"';
            } else {
                $stilOpis = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "datum_vrijeme_pocetka_kampanje") {

            if ($value === "") {
                $stilDatumPocetak = 'style="color:red;"';
            } else {
                $stilDatumPocetak = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "datum_vrijeme_zavrsetka_kampanje") {

            if ($value === "") {
                $stilDatumZavrsetak = 'style="color:red;"';
            } else {
                $stilDatumZavrsetak = 'style="color:rgb(242, 240, 234);;"';
            }
        }
    }

    if (isset($_POST['proizvod'])) {
        $proizvodPostavljen = true;
    } else {

        $proizvodPostavljen = false;
        $greska++;
    }

    if ($greska == 0 && $proizvodPostavljen == true) {

        $suma = 0;

        $veza = new Baza();
        $veza->spojiDB();

        $upit = "UPDATE `kampanja` SET `korisnik_email`='{$_SESSION['emailVlasnikaKampanje']}',`naziv_kampanje`='{$nazivKampanja}',
            `opis_kampanje`='{$opisKampanja}',`datum_vrijeme_pocetka`='{$datumPocetakKampanja}',
            `datum_vrijeme_zavrsetka`='{$datumZavrsetakKampanja}' WHERE kampanja_id='{$_SESSION['kampanja_id']}'";

        $rezultat = $veza->updateDB($upit);

        $upit = "SELECT * FROM `kampanja_proizvod` WHERE kampanja_id='{$_SESSION['kampanja_id']}'";
        $rezultat = $veza->selectDB($upit);

        $proizvodi = array();

        if (mysqli_num_rows($rezultat) > 0) {
            while ($red = mysqli_fetch_assoc($rezultat)) {

                $proizvodi[] = $red['proizvod_id'];
                $brojac++;
            }
        }
        //$brojac=0;

        if (isset($_POST['proizvod'])) {

            $checkboxes = $_POST['proizvod'];




            for ($i = 0; $i < $brojac; $i++) {
                if (in_array($proizvodi[$i], $checkboxes)) {
                    echo "Proizvod s ID-em " . $proizvodi[$i] . " je checkiran<br>";
                } else {
  
                    $upit = "DELETE FROM `kampanja_proizvod` WHERE kampanja_id='{$_SESSION['kampanja_id']}' AND proizvod_id='{$proizvodi[$i]}'";
                    $veza->updateDB($upit);
                }
            }
        }


        $upit = "SELECT * FROM `proizvod`
                WHERE `proizvod_id` IN (SELECT `proizvod_id` FROM `kampanja_proizvod` WHERE kampanja_id = '{$_SESSION['kampanja_id']}')";
        $rezultat = $veza->selectDB($upit);

   
        if (mysqli_num_rows($rezultat) > 0) {
            while ($red = mysqli_fetch_assoc($rezultat)) {
               
                $sumaKolicineProizvoda[] = $red['kolicina'];
            }
        }
        foreach ($sumaKolicineProizvoda as $kolicina) {
            $suma += $kolicina;
        }
  
        $upit = "UPDATE `kampanja` SET `zbroj_kolicine_proizvoda`='{$suma}' WHERE kampanja_id='{$_SESSION['kampanja_id']}'";
        $rezultat = $veza->updateDB($upit);

        $datumUnosauDnevnik = date("Y-m-d h:i:s");

        $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                                        VALUES ('','{$_SESSION['korisnik']}',17,'{$datumUnosauDnevnik}')";

        $rezultat = $veza->updateDB($upit);

        $veza->zatvoriDB();
        header("Location: popisKampanja.php");
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
    <title>Kreiranje kampanje</title>
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
                <h2>Kreiranje kampanje</h2>
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
                    <a href="logout.php" <?php if (isset($vidljivostGumba)) {
                                                echo "$vidljivostGumba";
                                            } ?>><button name="odjava">Odjava</button></a>
                </div>
            </div>
        </div>
    </header>

    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1>Unos kampanje!</h1>
        </div>

        <div class="grid-posebno-2">



            <form id="proizvod-forma" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">


                <label for="naziv-kampanja" id="naziv-kampanja-labela" <?php if (isset($stilNaziv)) {
                                                                            echo "$stilNaziv";
                                                                        }  ?>>Naziv kampanje</label><br>
                <input type="text" id="naziv-kampanja" name="naziv_kampanja" value="<?php if (isset($nazivKampanja)) {
                                                                                        echo "$nazivKampanja";
                                                                                    } ?>"><br><br>
                <label for="opis-kampanja" id="opis-kampanja-labela" <?php if (isset($stilOpis)) {
                                                                            echo "$stilOpis";
                                                                        }  ?>>Opis kampanje</label><br>
                <textarea name="opis_kampanja" id="opis-kampanja" cols="30" rows="10" placeholder="Unesite opis..."><?php if (isset($opisKampanja)) {
                                                                                                                        echo "$opisKampanja";
                                                                                                                    } ?></textarea><br><br>
                <div style="padding-bottom: 5%;" class="popis-tablica print-odabir">

                    <?php
                    if (isset($_GET['link'])) {
                        echo "
                <table class=\"tablica\">
                <thead>
                <tr>
                    <th colspan=\"10\">
                        Proizvodi u ovoj kampanji
                    </th>
                </tr>
                <tr>
                    <th>Proizvod ID</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Slika</th>
                    <th>Količina</th>
                    <th>Cijena</th>
                    <th>Bodovi koje<br>ostvaruje kupac</th>
                    <th>Bodovi proizvoda</th>
                    <th>Status</th>
                    <th>Dodano</th>
                </tr>
            </thead>
            <tbody>";

                        $veza = new Baza();
                        $veza->spojiDB();

                        $upit = "SELECT proizvod.*, kampanja_proizvod.kampanja_id
                        FROM proizvod
                        INNER JOIN kampanja_proizvod ON proizvod.proizvod_id = kampanja_proizvod.proizvod_id
                        WHERE kampanja_proizvod.kampanja_id = {$_GET['link']};";

                        $rezultat = $veza->selectDB($upit);

                        if (mysqli_num_rows($rezultat) > 0) {
                            while ($red = mysqli_fetch_assoc($rezultat)) {
                                echo "<tr><td>" . $red['proizvod_id'] . "</a></td>
                       <td>" . $red['naziv_proizvoda'] . "</td>
                        <td>" . $red['opis_proizvoda'] . "</td>
                        <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                        <td>" . $red['kolicina'] . "</td>
                        <td>" . $red['cijena_proizvoda'] . "€</td>
                        <td>" . $red['bodovi_kupac'] . "</td>
                        <td>" . $red['cijena_u_bodovima'] . "</td>";
                                if ($red['status_proizvoda'] == 1) {
                                    echo "<td>Raspoloživo</td>";
                                } else {
                                    echo "<td>Nije raspoloživo</td>";
                                }
                                if (($red['status_proizvoda'] == 1)) {
                                    echo "<td><input type=\"checkbox\" name=\"proizvod[]\" value=\"{$red['proizvod_id']}\" checked></tr></td>";
                                } else {
                                    echo "<td><input type=\"checkbox\" name=\"proizvod[]\" value=\"{$red['proizvod_id']}\" disabled></tr></td>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan=10>Trenutno nema dostupnih proizvoda kojima ste moderator</tr></td>";
                        }

                        $veza->zatvoriDB();


                        echo "</tbody>
            <tfoot>
            </tfoot>
            </table>";
                    } else {
                        if(isset($proizvodGreska)){echo $proizvodGreska;}
                        echo "
                <table class=\"tablica\">
                <thead>
                <tr>
                    <th colspan=\"10\">
                        Popis proizvoda za koje ste zaduženi
                    </th>
                </tr>
                <tr>
                    <th>Proizvod ID</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Slika</th>
                    <th>Količina</th>
                    <th>Cijena</th>
                    <th>Bodovi koje<br>ostvaruje kupac</th>
                    <th>Bodovi proizvoda</th>
                    <th>Status</th>
                    <th>Dodaj</th>
                </tr>
            </thead>
            <tbody>";

                        $veza = new Baza();
                        $veza->spojiDB();

                        $upit = "SELECT * FROM `proizvod` WHERE moderator_email='{$_SESSION['korisnik']}'";

                        $rezultat = $veza->selectDB($upit);

                        if (mysqli_num_rows($rezultat) > 0) {
                            while ($red = mysqli_fetch_assoc($rezultat)) {

                                echo
                                "<tr><td>" . $red['proizvod_id'] . "</a></td>
                        <td>" . $red['naziv_proizvoda'] . "</td>
                        <td>" . $red['opis_proizvoda'] . "</td>
                        <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                        <td>" . $red['kolicina'] . "</td>
                        <td>" . $red['cijena_proizvoda'] . "€</td>
                        <td>" . $red['bodovi_kupac'] . "</td>
                        <td>" . $red['cijena_u_bodovima'] . "</td>";
                                if ($red['status_proizvoda'] == 1) {
                                    echo "<td>Raspoloživo</td>";
                                } else {
                                    echo "<td>Nije raspoloživo</td>";
                                }
                                if (($red['status_proizvoda'] == 1)) {
                                    echo "<td><input type=\"checkbox\" name=\"proizvod[]\" value=\"{$red['proizvod_id']}\"></tr></td>";
                                } else {
                                    echo "<td><input type=\"checkbox\" name=\"proizvod[]\" value=\"{$red['proizvod_id']}\" disabled></tr></td>";
                                }
                            }
                        } else {
                            echo "<tr><td colspan=10>Trenutno nema dostupnih proizvoda kojima ste moderator</tr></td>";
                        }

                        $veza->zatvoriDB();


                        echo "</tbody>
            <tfoot>
            </tfoot>
            </table>";
                    }
                    ?>

                </div>
                <label for="datum-vrijeme-pocetka-kampanje" id="datum-vrijeme-pocetka-kampanje-labela" <?php if (isset($stilDatumPocetak)) {
                                                                                                            echo "$stilDatumPocetak";
                                                                                                        }  ?>>Datum i vrijeme početka</label><br>
                <input type="datetime-local" name="datum_vrijeme_pocetka_kampanje" id="datum-vrijeme-pocetka-kampanje" value="<?php if (isset($datumPocetakKampanja)) {
                                                                                                                                    echo "$datumPocetakKampanja";
                                                                                                                                } ?>"><br><br>
                <label for="datum-vrijeme-zavrsetka-kampanje" id="datum-vrijeme-zavrsetka-kampanje-labela" <?php if (isset($stilDatumZavrsetak)) {
                                                                                                                echo "$stilDatumZavrsetak";
                                                                                                            }  ?>>Datum i vrijeme završetka</label><br>
                <input type="datetime-local" name="datum_vrijeme_zavrsetka_kampanje" id="datum-vrijeme-zavrsetka-kampanje" value="<?php if (isset($datumZavrsetakKampanja)) {
                                                                                                                                        echo "$datumZavrsetakKampanja";
                                                                                                                                    } ?>"><br><br>
                <input type="submit" name="gumb_kampanja" id="gumb-kampanja" value="Unesi" <?php if (isset($gumbPosalji)) {
                                                                                                echo "$gumbPosalji";
                                                                                            } ?>><br>
                <input type="submit" name="gumb_azuriraj_kampanju" id="gumb-azuriraj-kampanju" value="Ažuriraj" <?php if (isset($gumbAzuriraj)) {
                                                                                                                    echo "$gumbAzuriraj";
                                                                                                                } ?>>
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