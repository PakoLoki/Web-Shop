<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";


if($_SESSION['uloga']>2){
    header("Location: profil.php");
}

if (isset($_GET['link'])) {

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT * FROM proizvod WHERE proizvod_id='{$_GET['link']}'";

    $rezultat = $veza->selectDB($upit);

    if (mysqli_num_rows($rezultat) > 0) {
        while ($red = mysqli_fetch_assoc($rezultat)) {
            $cijenaPolje = $red['cijena_proizvoda'];
        }
    }

    $datumUnosauDnevnik = date("Y-m-d h:i:s");

    $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                                        VALUES ('','{$_SESSION['korisnik']}',18,'{$datumUnosauDnevnik}')";

    $rezultat = $veza->updateDB($upit);
    $veza->zatvoriDB();
}

//Postava bodova koje korisnik može dobiti dok kupi proizvod te bodova proizvoda
if (isset($_POST['gumbAžurirajBodove'])) {

    $greska = 0;

    $stilEuri = "";
    $stilIndes = "";
    $stilBodoviKupac = "";
    $stilBodoviProizvod = "";

    $bodoviPolje = XSS_SQL_inj($_POST['kalkulator_bodovi']);
    $bodoviProizvoda = XSS_SQL_inj($_POST['bodovi_proizvoda']);

    foreach ($_POST as $key => $value) {
        if (empty($value) && $key !== "gumbAžurirajBodove") {
            $greska++;
        } elseif ($key === "kalkulator_euri") {
            if ($value == "") {
            }
        }
    }

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "UPDATE `proizvod` SET `bodovi_kupac`='{$bodoviPolje}',`cijena_u_bodovima`='{$bodoviProizvoda}' WHERE proizvod_id='{$_GET['link']}'";

    $rezultat = $veza->updateDB($upit);

    $datumUnosauDnevnik = date("Y-m-d h:i:s");

    $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                                        VALUES ('','{$_SESSION['korisnik']}',19,'{$datumUnosauDnevnik}')";

    $rezultat = $veza->updateDB($upit);

    $veza->zatvoriDB();
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
            <h2 id="pocetak" style="padding-left: 0%; padding-right:10%; ">Popis proizvoda</h2>
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


        <?php
        if ($_SESSION['uloga'] == 1) {
            echo "<div style=\"padding-bottom: 5%;\" class=\"popis-tablica print-odabir\">
           <table class=\"tablica\">
           <thead>
                <tr>
                    <th colspan=\"11\">
                        Popis proizvoda
                    </th>
                </tr>
                <tr>
                    <th>Proizvod ID</th>
                    <th>Moderator</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Slika</th>
                    <th>Količina</th>
                    <th>Cijena</th>
                    <th>Bodovi koje<br>ostvaruje kupac</th>
                    <th>Bodovi proizvoda</th>
                    <th>Status</th>
                    <th>Pregled proizvoda</th>
                </tr>
            </thead>
            <tbody>";

            $veza = new Baza();
            $veza->spojiDB();

            $upit = "SELECT * FROM `proizvod` ";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) > 0) {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    echo
                    "<tr><td><a href=\"kreiranjeProizvoda.php?link={$red['proizvod_id']}\">" . $red['proizvod_id'] . "</a></td>
                        <td>" . $red['moderator_email'] . "</td>
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
                    echo "<td><a href=\"popisProizvoda.php?link={$red['proizvod_id']}\"><button>Dodijeli bodove proizvodima</button></a></tr></td>";
                }
            } else {
                echo "<tr><td colspan=11>Trenutno nema dostupnih proizvoda</tr></td>";
            }

            $veza->zatvoriDB();


            echo "</tbody>
            <tfoot>    
            </tfoot>
            </table>
    </div>";
    echo " <div style=\"padding-bottom: 5%;\" class=\"popis-tablica print-odabir\">
    <table class=\"tablica\">
    <thead>
        <tr>
            <th colspan=\"10\">
                Odabrani proizvod
            </th>
        </tr>
        <tr>
            <th>Proizvod ID</th>
            <th>Moderator</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Slika</th>
            <th>Količina</th>
            <th>Cijena</th>
            <th>Bodovi koje<br>ostvaruje kupac</th>
            <th>Bodovi proizvoda</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>";

            $veza = new Baza();
            $veza->spojiDB();



            @$upit = "SELECT * FROM proizvod WHERE proizvod_id = '{$_GET['link']}'";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) > 0) {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    echo
                    "<tr><td><a href=\"popisProizvoda.php?link={$red['proizvod_id']}\">" . $red['proizvod_id'] . "</a></td>
                <td>" . $red['moderator_email'] . "</td>
                <td>" . $red['naziv_proizvoda'] . "</td>
                <td>" . $red['opis_proizvoda'] . "</td>
                <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                <td>" . $red['kolicina'] . "</td>
                <td>" . $red['cijena_proizvoda'] . "€</td>
                <td>" . $red['bodovi_kupac'] . "</td>
                <td>" . $red['cijena_u_bodovima'] . "</td>";
                    if ($red['status_proizvoda'] == 1) {
                        echo "<td>Raspoloživo</tr></td>";
                    } else {
                        echo "<td>Nije raspoloživo</tr></td>";
                    }
                }
            } else {
                echo "<tr><td colspan=10>Pritisnite na ID željenog proizvoda kako biste mu dodjelili bodove</tr></td>";
            }

            $veza->zatvoriDB();


            echo "</tbody>
    <tfoot>    
    </tfoot>
    </table>
</div>";
        }
        if ($_SESSION['uloga'] == 2) {
            echo "
            <div>
            
        </div>
            <div style=\"padding-bottom: 5%;\" class=\"popis-tablica print-odabir\">
            <table class=\"tablica\">
            <thead>
                <tr>
                    <th colspan=\"10\">
                        Aktivne kampanje s vašim proizvodima
                    </th>
                </tr>
                <tr>
                    <th>Proizvod ID</th>
                    <th>Moderator</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Slika</th>
                    <th>Količina</th>
                    <th>Cijena</th>
                    <th>Bodovi koje<br>ostvaruje kupac</th>
                    <th>Bodovi proizvoda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>";

            $veza = new Baza();
            $veza->spojiDB();

            $upit = "SELECT p.*
                FROM proizvod p
                JOIN kampanja_proizvod ip ON p.proizvod_id = ip.proizvod_id 
                WHERE moderator_email='{$_SESSION['korisnik']}'
                GROUP BY p.proizvod_id;";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) > 0) {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    echo
                    "<tr><td><a href=\"popisProizvoda.php?link={$red['proizvod_id']}\">" . $red['proizvod_id'] . "</a></td>
                        <td>" . $red['moderator_email'] . "</td>
                        <td>" . $red['naziv_proizvoda'] . "</td>
                        <td>" . $red['opis_proizvoda'] . "</td>
                        <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                        <td>" . $red['kolicina'] . "</td>
                        <td>" . $red['cijena_proizvoda'] . "€</td>
                        <td>" . $red['bodovi_kupac'] . "</td>
                        <td>" . $red['cijena_u_bodovima'] . "</td>";
                    if ($red['status_proizvoda'] == 1) {
                        echo "<td>Raspoloživo</tr></td>";
                    } else {
                        echo "<td>Nije raspoloživo</tr></td>";
                    }
                }
            } else {
                echo "<tr><td colspan=10>Trenutno nema dostupnih proizvoda</tr></td>";
            }

            $veza->zatvoriDB();


            echo "</tbody>
            <tfoot>    
            </tfoot>
            </table>
    </div>";
            echo " <div style=\"padding-bottom: 5%;\" class=\"popis-tablica print-odabir\">
    <table class=\"tablica\">
    <thead>
        <tr>
            <th colspan=\"10\">
                Odabrani proizvod
            </th>
        </tr>
        <tr>
            <th>Proizvod ID</th>
            <th>Moderator</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Slika</th>
            <th>Količina</th>
            <th>Cijena</th>
            <th>Bodovi koje<br>ostvaruje kupac</th>
            <th>Bodovi proizvoda</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>";

            $veza = new Baza();
            $veza->spojiDB();



            @$upit = "SELECT * FROM proizvod WHERE proizvod_id = '{$_GET['link']}'";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) > 0) {
                while ($red = mysqli_fetch_assoc($rezultat)) {
                    echo
                    "<tr><td><a href=\"popisProizvoda.php?link={$red['proizvod_id']}\">" . $red['proizvod_id'] . "</a></td>
                <td>" . $red['moderator_email'] . "</td>
                <td>" . $red['naziv_proizvoda'] . "</td>
                <td>" . $red['opis_proizvoda'] . "</td>
                <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</td>
                <td>" . $red['kolicina'] . "</td>
                <td>" . $red['cijena_proizvoda'] . "€</td>
                <td>" . $red['bodovi_kupac'] . "</td>
                <td>" . $red['cijena_u_bodovima'] . "</td>";
                    if ($red['status_proizvoda'] == 1) {
                        echo "<td>Raspoloživo</tr></td>";
                    } else {
                        echo "<td>Nije raspoloživo</tr></td>";
                    }
                }
            } else {
                echo "<tr><td colspan=10>Pritisnite na ID željenog proizvoda kako biste mu dodjelili bodove</tr></td>";
            }

            $veza->zatvoriDB();


            echo "</tbody>
    <tfoot>    
    </tfoot>
    </table>
</div>";
        }
        ?>

        <p>Postavljanje bodova</p>
        <div style="display:flex">
            <form method="post">
                <label for="kalkulator-euri">Cijena proizvoda <br> u eurima(€)</label><br>
                <input type="text" name="kalkulator_euri" id="kalkulator-euri" onload="odredivanjeBodova()" value="<?php if (isset($cijenaPolje)) {
                                                                                                                        echo $cijenaPolje;
                                                                                                                    } ?>"><br>
                <label for="kalkulator-index">Koeficijent bodova</label><br>
                <input type="text" name="kalkulator_index" id="kalkulator-index" onInput="odredivanjeBodova()"><br>
                <label for="kalkulator-bodovi">Bodovi koje <br> ostvaruje kupac</label><br>
                <input type="text" name="kalkulator_bodovi" id="kalkulator-bodovi"><br>
                <label for="bodovi-proizvoda">Bodovi proizvoda</label><br>
                <input type="text" name="bodovi_proizvoda" id="bodovi-proizvoda"><br>
                <input type="submit" name="gumbAžurirajBodove" value="Ažuriraj bodove">
            </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function odredivanjeBodova() {
        jQuery.ajax({
            url: "odredivanjeBodova.php",
            data: {
                cijena: $('#kalkulator-euri').val(),
                index: $('#kalkulator-index').val()
            },
            type: "POST",
            success: function(data) {
                console.log("radi");
                $("#kalkulator-bodovi").attr('value', data);
            },
            error: console.log("Ne radi nekaj")
        })
        console.log($("#kalkulator-euri").val());
    }
</script>

</html>