<!DOCTYPE html>
<html lang="hr">

<head>
    <title>O autoru</title>

    <meta charset="utf-8">
    <meta name="author" content="plovrek">
    <meta name="keywords" content="Glazba, Bend">
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
                    <a href="index.html"><img src="./Multimedija/logo.png" alt="logo"></a>
                </div>
                <div class="sadrzaj_padajuci">
                    <select name="jezici" id="jezici">
                        <option value="Hrvatski">Hrvatski</option>
                        <option value="Engleski">Engleski</option>
                        <option value="Njemački">Njemački</option>
                    </select>

                </div>
            </div>
            <h2 id="pocetak">Podaci o autoru</h2>
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
                    <button>Odjava</button>
                </div>
            </div>
        </div>
    </header>
    <nav>
        <a href="index.html">Početna</a>
        <a href="obrasci/autentikacija.html">Autentikacija</a>
        <a href="obrasci/obrazac.html">Obrazac</a>
        <a href="ostalo/multimedija.html">Multimedija</a>
        <a href="ostalo/popis.html">Popis</a>
        <a href="era.html">ERA</a>
        <a href="navigacijski.html">Navigacijski</a>
    </nav>
    <h1 id="o_autoru-naslov">Informacije o autoru</h1>
    <div class="o_autoru-sekcije print-odabir">
        <section>
            <div>
                <h2>Motivacija</h2>
                <p>Smatram da je učenje Web tehnologija zanimljivo <br> 
                    jer mogu vidjeti kako sve različite stvari
                    funkcioniraju <br> što se tiče spajanja na server, vizualni izgled web stranice <br> te ostalih
                    specifikacija kao što su određeni programski jezici <br> (JavaScript, PhP).
                </p>
            </div>
            <div class="o_autoru-podsekcija-1">
                <img id="autor-slika" src="./Multimedija/Patrik_Lovrek_slika-min.jpg" alt="autor-slika">
                <ul>
                    <li><div class="naslovi">Ime: </div>Patrik</li>
                    <li><div class="naslovi">Prezime: </div>Lovrek</li>
                    <li><a href="mailto: plovrek@student.foi.hr"><div class="naslovi">Email: </div>plovrek@student.foi.hr</a> </li>
                    <li><div class="naslovi">Broj iksice: </div>0016142513</li>
                </ul>
            </div>
        </section>
        <section class="o_autoru-podsekcija-2">
            <div >
                <h2>Računalne vještine</h2>
                <ul>
                    <li><div class="naslovi">Jezici: </div>Python, C++, HTML, CSS, JS, PHP, C#</li>
                    <li><div class="naslovi">Tehnologije: </div>Word, Visual Studio</li>
                    <li><div class="naslovi">Alati: </div>Paint</li>
                </ul>
            </div>
            <div>
                <h2>Područja interesa</h2>
                <ul>
                    <li>Glazba</li>
                    <li>Gluma</li>
                    <li>Marketing</li>
                </ul>
            </div>
        </section>
    </div>
    <div class="povijest">
        <h2>Povijest pregledavanja</h2>
        <div class="sekcije">
            <aside title="Početna stranica"><img src="./Multimedija/rock1940.jpg" alt="rock1960" width="100" height="100"></aside>
            <aside title="O autoru"><img src="./Multimedija/Patrik_Lovrek_slika-min.jpg" alt="plovrek" width="100" height="100"></aside>
            <aside title="Autentikacija"><img src="./Multimedija/login.jpg" alt="login" width="100" height="100"></aside>
            <aside title="Obrazac"><img src="./Multimedija/Mail-closed.svg.png" alt="pismo" width="100" height="100"></aside>
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