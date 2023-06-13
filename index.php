<?php

var_dump($_GET);

require "./skripte/baza.class.php";

if(isset($_GET['submit'])){
    $greska="";
    $poruka="";
    foreach($_GET as $k => $v){
        if(empty($v)){
            $greska.="Nije popunjeno<br>";
        }
    }
    if(empty($greska)){
        $veza= new Baza();
        $veza->spojiDB();

        $upit = "SELECT *FROM korisnik";
        $rezultat = $veza->selectDB($upit);
        var_dump($rezultat);
    }
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
                    <a href="index.php"><img src="./Multimedija/logo.png" alt="logo"></a>
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
                <h2>Dobro došli na Web Shop</h2>
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

    <nav>

        <a href="o_autoru.php">O autoru</a>
        <a href="obrasci/autentikacija.php">Autentikacija</a>
        <a href="obrasci/obrazac.php">Obrazac</a>
        <a href="ostalo/multimedija.php">Multimedija</a>
        <a href="ostalo/popis.php">Popis</a>
        <a href="era.php">ERA</a>
        <a href="navigacijski.php">Navigacijski</a>

    </nav>

    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1>Prijavite se!</h1>
        </div>

        <div class="grid-posebno-2">
            <form id="prijava-forma"
                method="GET">
                <label for="prijava-username" id="prijava-username-labela">Username</label><br>
                <input name="prvi" type="text" id="prijava-username"><br><br>
                <label for="prijava-lozinka" id="prijava-lozinka-labela">Lozinka</label><br>
                <input name="drugi" type="password" id="prijava-lozinka"><br><br>
                <input name="treci" type="checkbox" id="prijava-zapamti">
                <label for="prijava-zapamti" id="prijava-zapamti-labela">Zapamti me</label><br><br>
                <button type="submit" form="prijava-forma">Prijavi se</button>
            </form>
        </div>
        <div class="notReg">
            <p>Nemate račun?</p>
            <a href="registracija.php">REGISTRIRAJ SE!</a>
        </div>

    </section>
    <div class="povijest">
        <h2>Povijest pregledavanja</h2>
        <div class="sekcije">
            <aside title="Početna stranica"><img src="./Multimedija/rock1940.jpg" alt="rock1960" width="100"
                    height="100"></aside>
            <aside title="O autoru"><img src="./Multimedija/Patrik_Lovrek_slika-min.jpg" alt="plovrek" width="100"
                    height="100"></aside>
            <aside title="Autentikacija"><img src="./Multimedija/login.jpg" alt="login" width="100" height="100">
            </aside>
            <aside title="Obrazac"><img src="./Multimedija/Mail-closed.svg.png" alt="pismo" width="100" height="100">
            </aside>
            <aside title="Multimedija"><img src="./Multimedija/logo.png" alt="music" width="100" height="100"></aside>
            <aside title="Popis"><img src="./Multimedija/search.png" alt="povecalo" width="100" height="100"></aside>
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