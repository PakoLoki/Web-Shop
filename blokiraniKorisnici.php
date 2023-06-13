<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";




?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Popis proizvoda</title>

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
            <h2 id="pocetak" style="padding-left: 0%; padding-right:10%; ">Odblokiranje/Blokiranje korisničkih računa</h2>
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
    <div style="display: flex; align-items: center; flex-direction: column; justify-content:center; background-color: rgb(212, 167, 101);">

        <div style="padding-bottom: 5%;" class="popis-tablica print-odabir">
            <?php
            echo "<table class=\"tablica\">
            <thead>
                <tr>
                    <th colspan=\"7\">
                        Blokirani korisnici
                    </th>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>Uloga</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Korisničko ime</th>
                    <th>Datum i vrijeme registracije</th>
                    <th>Odblokiraj račun</th>
                </tr>
            </thead>
            <tbody>";

            $veza = new Baza();
            $veza->spojiDB();

            $upit = "SELECT * FROM `korisnik` WHERE status_racuna=0 ";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) > 0) {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    echo
                    "<tr><td>" . $red['email'] . "</td>";
                    if ($red['tip_id'] == 1) {
                        echo "<td>Administrator</td>";
                    } elseif ($red['tip_id'] == 2) {
                        echo "<td>Moderator</td>";
                    } elseif ($red['tip_id'] == 3) {
                        echo "<td>Registrirani korisnik</td>";
                    }
                    echo "<td>" . $red['ime'] . "</td>
                        <td>" . $red['prezime'] . "</td>
                        <td>" . $red['korisnicko_ime'] . "</td>
                        <td>" . $red['datum_vrijeme_registracije'] . "</td>
                        <td><a href=\"./odblokiranjeKorisnika.php?link={$red['email']}\"><button>Odblokiraj</button></a></tr></td>";
                }
            } else {
                echo "<tr><td colspan=7>Nema blokiranih korisnika</tr></td>";
            }

            $veza->zatvoriDB();


            echo  "</tbody>
            <tfoot>
                
            </tfoot>
        </table><br><br>";


            echo "<table class=\"tablica\">
            <thead>
                <tr>
                    <th colspan=\"7\">
                        Popis korisnika
                    </th>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>Uloga</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Korisničko ime</th>
                    <th>Datum i vrijeme registracije</th>
                    <th>Blokiraj račun</th>
                </tr>
            </thead>
            <tbody>";
            $limitStranica = 11;
            if (isset($_GET['vrijednosti'])) {
                $donjiLimit = $_GET['vrijednosti'];
                $upit = "SELECT * FROM `korisnik` WHERE status_racuna=1 AND email!='{$_SESSION['korisnik']}'LIMIT $donjiLimit,$limitStranica ";
            } else {
                $donjiLimit = 11;
                $upit = "SELECT * FROM `korisnik` WHERE status_racuna=1 AND email!='{$_SESSION['korisnik']}'";
            }
            
            $veza = new Baza();
            $veza->spojiDB();

            

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) > 0) {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    echo
                    "<tr><td>" . $red['email'] . "</td>";
                    if ($red['tip_id'] == 1) {
                        echo "<td>Administrator</td>";
                    } elseif ($red['tip_id'] == 2) {
                        echo "<td>Moderator</td>";
                    } elseif ($red['tip_id'] == 3) {
                        echo "<td>Registrirani korisnik</td>";
                    }
                    echo "<td>" . $red['ime'] . "</td>
                        <td>" . $red['prezime'] . "</td>
                        <td>" . $red['korisnicko_ime'] . "</td>
                        <td>" . $red['datum_vrijeme_registracije'] . "</td>
                        <td><a href=\"./blokiranjeKorisnika.php?link={$red['email']}\"><button>Blokiraj</button></a></tr></td>";
                }
            } else {
                echo "<tr><td colspan=7>Nema blokiranih korisnka</tr></td>";
            }

            $veza->zatvoriDB();


            echo  "</tbody>
            <tfoot>
                
            </tfoot>
        </table>";

            $limitStranica = 11;

            $veza = new Baza();
            $veza->spojiDB();
            $upit = "SELECT * FROM `korisnik` ";
            $rezultat = $veza->selectDB($upit);
            $veza->zatvoriDB();

            $red = mysqli_num_rows($rezultat);
            $stranice = ceil($red / $limitStranica);

            for ($i = 0; $i < $stranice; $i++) {
                $vrijednosti = $i * $limitStranica;
                if ($i == 0) {
                    echo "<a class='stranice' href='blokiranikorisnici.php?vrijednosti=" . $vrijednosti . "'>Početna</a>";
                } else {
                    echo "<a class='stranice' href='blokiranikorisnici.php?vrijednosti=" . $vrijednosti . "'>" . $i . "</a>";
                }
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