<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";


$veza = new Baza();
$veza->spojiDB();


if (isset($_GET['link'])) {

    $datumUnosauDnevnik = date("Y-m-d h:i:s");

    $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                        VALUES ('','{$_SESSION['korisnik']}',14,'{$datumUnosauDnevnik}')";

    $rezultat = $veza->updateDB($upit);
}


if (isset($_GET['gumb_datumi'])) {

    $upit = "";

    $greska = 0;

    $datumPocetakFilter = XSS_SQL_inj($_GET['datum_pocetak_filter']);
    $datumZavrsetakFilter = XSS_SQL_inj($_GET['datum_zavrsetak_filter']);

    $stilDatumPocetakFilter = 'style="color:red; font-family:Georgia, \'Times New Roman\', Times, serif;"';
    $stilDatumZavrsetakFilter = 'style="color:red; font-family:Georgia, \'Times New Roman\', Times, serif;"';

    foreach ($_GET as $key => $value) {
        if (empty($value) && $key != "gumb_datumi") {
            $greska++;
        } elseif ($key == "datum_pocetak_filter") {
            if ($value == "") {
                $stilDatumPocetakFilter = 'style="color:red;"';
                $greska++;
            } else {
                $stilDatumPocetakFilter = 'style="color:black;"';
            }
        } elseif ($key == "datum_zavrsetak_filter") {
            if ($value == "") {
                $stilDatumZavrsetakFilter = 'style="color:red;"';
                $greska++;
            } else {
                $stilDatumZavrsetakFilter = 'style="color:black;"';
            }
        }
    }

    $upit = "SELECT * FROM `kampanja` 
        WHERE `datum_vrijeme_pocetka` <= '{$datumZavrsetakFilter}' 
        AND `datum_vrijeme_zavrsetka` >='{$datumPocetakFilter}' 
        AND `datum_vrijeme_zavrsetka`<= '{$datumZavrsetakFilter}'
        AND  `datum_vrijeme_pocetka` >= '{$datumPocetakFilter}' 
        ORDER BY zbroj_kolicine_proizvoda DESC";
} else {
    $upit = "SELECT * FROM `kampanja` ORDER BY zbroj_kolicine_proizvoda DESC";
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
    <title>Popis Kampanja</title>

    <meta charset="utf-8">
    <meta name="author" content="plovrek">
    <meta name="keywords" content="Glazba, Bend">
    <meta name="description" content="7.3.2023.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/plovrek.css" type="text/css">
    <link rel="stylesheet" href="./Css/plovrek_prilagodbe.css" type="text/css">

</head>

<body>
    <header>
        <div class="traka-izbornika">
            <div class="logo-jezik">
                <div class="logo">
                    <a href="./prijava.php"><img src="./Multimedija/logo.png" alt="logo"></a>
                </div>
                <div class="sadrzaj_padajuci">
                    <select name="jezici" id="jezici">
                        <option value="Hrvatski">Hrvatski</option>
                        <option value="Engleski">Engleski</option>
                        <option value="Njemački">Njemački</option>
                    </select>

                </div>
            </div>
            <h2 id="pocetak" style="padding-left: 0%; padding-right:10%; ">Popis aktivnih kampanja</h2>
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
            <div>
                <div>
                    <a class="search-slika" href="#prozor">
                        <img src="./Multimedija/search.png" alt="trazi" width="25">
                    </a>
                </div>
                <div>
                    <a href="./logout.php" <?php if (isset($vidljivostGumba)) {
                                                echo "$vidljivostGumba";
                                            } ?>><button name="odjava">Odjava</button></a>
                </div>
            </div>
        </div>
    </header>
    <div id="popUp">
        <a href="#">
            <img src="./Multimedija/cancel.png" alt="zatvori" width="25">
        </a>
        <?php



        ?>
    </div>
    <div style="display: flex; align-items: center; flex-direction: column; justify-content:center; background-color: rgb(212, 167, 101);">

        <div style="padding-bottom: 5%;" class="popis-tablica print-odabir">

            <?php
            //ULOGA ADMINA I MODERATORA//
            if ($_SESSION['uloga'] < 3) {
                echo "
                <table class=\"tablica\"><thead>
                <tr>
                <th colspan=\"7\">
                    Kampanje
                </th>
            </tr>
            <tr>
                <th>Kampanja ID</th>
                <th>Korisnik zadužen za kampanju</th>
                <th>Naziv</th>
                <th>Opis</th>
                <th>Datum početka</th>
                <th>Datum završetka</th>
                <th>Pregled proizvoda u kampanji</th>
            </tr>
        </thead>


                <tbody>";


                $rezultat = $veza->selectDB($upit);

                if (mysqli_num_rows($rezultat) > 0) {
                    while ($red = mysqli_fetch_assoc($rezultat)) {
                        echo
                        "<tr><td><a href=\"kreiranjeKampanje.php?link={$red['kampanja_id']}\">" . $red['kampanja_id'] . "</a></td>
                        <td>" . $red['korisnik_email'] . "</td>
                        <td>" . $red['naziv_kampanje'] . "</td>
                        <td>" . $red['opis_kampanje'] . "</td>
                        <td>" . $red['datum_vrijeme_pocetka'] . "</td>
                        <td>" . $red['datum_vrijeme_zavrsetka'] . "</td>
                        <td><a href=\"popisKampanja.php?link={$red['kampanja_id']}\"><button>Pregledaj proizvode</button></a></tr></td>";
                    }
                } else {
                    echo "<tr><td colspan=7>Trenutno nema dostupnih kampanja</tr></td>";
                }


                echo "</tbody>
                <tfoot>
                </tfoot>
                </table>";

                echo "</tbody>
                    <tfoot>
                    </tfoot>
                    </table>";

                echo "
                    <table class=\"tablica\"><thead>
                    <tr>
                    <th colspan=\"6\">
                        Proizvodi u kampanji
                    </th>
                </tr>
                <tr>
                    <th>Opis proizvoda</th>
                    <th>Cijena po komadu (€)</th>
                    <th>Cijena po komadu (Bodovi)</th>
                    <th>Trenutno na zalihi</th>
                    <th>Slika</th>
                    <th>Kupovina</th>
                </tr>
            </thead>
    
    
                    <tbody>";

                @$upit = "SELECT proizvod.*, kampanja_proizvod.kampanja_id
                    FROM proizvod
                    INNER JOIN kampanja_proizvod ON proizvod.proizvod_id = kampanja_proizvod.proizvod_id
                    WHERE kampanja_proizvod.kampanja_id = '{$_GET['link']}'";

                $rezultat = $veza->selectDB($upit);

                if (mysqli_num_rows($rezultat) > 0) {
                    while ($red = mysqli_fetch_assoc($rezultat)) {
                        echo
                        "<tr><td>" . $red['opis_proizvoda'] . "</td>
                            <td>" . $red['cijena_proizvoda'] . "€</td>
                            <td>" . $red['cijena_u_bodovima'] . "</td>
                            <td>" . $red['kolicina'] . "</td>
                            <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                            <td>";
                        if ($red['kolicina'] != 0) {
                            echo "<a href=\"izvrsiPlacanje.php?link={$red['proizvod_id']}\"><button>Kupi</button></a></tr></td>";
                        } else {
                            echo "Proizvoda trenutno nema na zalihi</tr></td>";
                        }
                    }
                } else {
                    echo "<tr><td colspan=6>Pritisnite ID kampanje koju želite proučiti ili na gumb <i>Pregledaj proizvode</i> za kupnju</tr></td>";
                }

                $veza->zatvoriDB();
                echo "</tbody>
                    <tfoot>
                    </tfoot>
                    </table>";
            }

            //ULOGA REGISTRIRANOGA KORISNIKA//

            if ($_SESSION['uloga'] == 3) {
                echo "
                    <table class=\"tablica\"><thead>
                    <tr>
                    <th colspan=\"5\">
                        Kampanje
                    </th>
                </tr>
                <tr>
                    <th>Kampanja ID</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Datum početka</th>
                    <th>Datum završetka</th>
                </tr>
            </thead>
    
    
                    <tbody>";


                $rezultat = $veza->selectDB($upit);

                if (mysqli_num_rows($rezultat) > 0) {
                    while ($red = mysqli_fetch_assoc($rezultat)) {
                        echo
                        "<tr><td><a href=\"popisKampanja.php?link={$red['kampanja_id']}\">" . $red['kampanja_id'] . "</a></td>
                            <td>" . $red['naziv_kampanje'] . "</td>
                            <td>" . $red['opis_kampanje'] . "</td>
                            <td>" . $red['datum_vrijeme_pocetka'] . "</td>
                            <td>" . $red['datum_vrijeme_zavrsetka'] . "</td>";
                    }
                } else {
                    echo "<tr><td colspan=5>Trenutno nema dostupnih kampanja</tr></td>";
                }


                echo "</tbody>
                    <tfoot>
                    </tfoot>
                    </table>";

                echo "
                    <table class=\"tablica\"><thead>
                    <tr>
                    <th colspan=\"6\">
                        Proizvodi u kampanji
                    </th>
                </tr>
                <tr>
                    <th>Opis proizvoda</th>
                    <th>Cijena po komadu (€)</th>
                    <th>Cijena po komadu (Bodovi)</th>
                    <th>Trenutno na zalihi</th>
                    <th>Slika</th>
                    <th>Kupovina</th>
                </tr>
            </thead>
    
    
                    <tbody>";

                @$upit = "SELECT proizvod.*, kampanja_proizvod.kampanja_id
                    FROM proizvod
                    INNER JOIN kampanja_proizvod ON proizvod.proizvod_id = kampanja_proizvod.proizvod_id
                    WHERE kampanja_proizvod.kampanja_id = '{$_GET['link']}'";

                $rezultat = $veza->selectDB($upit);

                if (mysqli_num_rows($rezultat) > 0) {
                    while ($red = mysqli_fetch_assoc($rezultat)) {
                        echo
                        "<tr><td>" . $red['opis_proizvoda'] . "</td>
                            <td>" . $red['cijena_proizvoda'] . "€</td>
                            <td>" . $red['cijena_u_bodovima'] . "</td>
                            <td>" . $red['kolicina'] . "</td>
                            <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                            <td>";
                        if ($red['kolicina'] != 0) {
                            echo "<a href=\"izvrsiPlacanje.php?link={$red['proizvod_id']}\"><button>Kupi</button></a></tr></td>";
                        } else {
                            echo "Proizvoda trenutno nema na zalihi</tr></td>";
                        }
                    }
                } else {
                    echo "<tr><td colspan=6>Pritisnite ID kampanje koju želite proučiti</tr></td>";
                }

                $veza->zatvoriDB();
                echo "</tbody>
                    <tfoot>
                    </tfoot>
                    </table>";
            }

            //ULOGA NEREGISTRIRANOGA KORISNIKA//

            if ($_SESSION['uloga'] == 4) {
                echo "
                    <form method=\"get\">
                    <label for=\"datum-pocetak-filter\"";
                if (isset($stilDatumPocetakFilter)) {
                    echo "$stilDatumPocetakFilter";
                }
                echo ">Od</label>
                    <input type=\"datetime-local\" name=\"datum_pocetak_filter\" id=\"datum-pocetak-filter\" value=\"";
                if (isset($datumPocetakFilter)) {
                    echo "$datumPocetakFilter";
                }
                echo "\">
                    <label for=\"datum-zavrsetak-filter\"";
                if (isset($stilDatumZavrsetakFilter)) {
                    echo "$stilDatumZavrsetakFilter";
                }
                echo ">Do</label>
                    <input type=\"datetime-local\" name=\"datum_zavrsetak_filter\" id=\"datum-zavrsetak-filter\" value=\"";
                if (isset($datumZavrsetakFilter)) {
                    echo "$datumZavrsetakFilter";
                }
                echo "\">
                    <input type=\"submit\" name=\"gumb_datumi\" id=\"gumb-datumi\" value=\"Filtriraj\">
                </form>

                <table class=\"tablica\"><thead>
                <tr>
                <th colspan=\"5\">
                    Kampanje
                </th>
            </tr>
            <tr>
                <th>Kampanja ID</th>
                <th>Naziv</th>
                <th>Opis</th>
                <th>Datum početka</th>
                <th>Datum završetka</th>
            </tr>
        </thead>


                <tbody>";

                $rezultat = $veza->selectDB($upit);

                if (mysqli_num_rows($rezultat) > 0) {
                    while ($red = mysqli_fetch_assoc($rezultat)) {
                        echo
                        "<tr><td>" . $red['kampanja_id'] . "</td>
                        <td>" . $red['naziv_kampanje'] . "</td>
                        <td>" . $red['opis_kampanje'] . "</td>
                        <td>" . $red['datum_vrijeme_pocetka'] . "</td>
                        <td>" . $red['datum_vrijeme_zavrsetka'] . "</td>";
                    }
                } else {
                    echo "<tr><td colspan=5>Trenutno nema dostupnih kampanja u ovom vreenskom periodu</tr></td>";
                }

                $veza->zatvoriDB();
                echo "</tbody>
                <tfoot>
                </tfoot>
                </table>";
            }
            ?>
        </div>
    </div>

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