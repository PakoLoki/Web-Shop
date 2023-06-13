<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";
require "./Kodovi/prijavaKod.php";

$veza=new Baza();
$veza->spojiDB();

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Prijava</title>
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
                <a href="logout.php" <?php if(isset($vidljivostGumba)){echo "$vidljivostGumba";} ?>><button name="odjava">Odjava</button></a>
                </div>
            </div>
        </div>
    </header>

    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1>Prijavite se!</h1>
        </div>
        <div class="grid-posebno-2">
        <?php
        if (isset($provjeraLogina)) {
                echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$provjeraLogina</p>";
            }
            
            ?>
            <form id="prijava-forma" action="<?php echo $_SERVER["PHP_SELF"]; ?>"
                method="GET">
                <label for="prijava-username" id="prijava-username-labela" <?php if(isset($stilUsernamePrijava)){echo $stilUsernamePrijava;} ?>>Username</label><br>
                <span id="provjeraKorIme"></span>
                <input name="prijava_username" autocomplete="off" type="text" id="prijava-username" oninput="provjeraUsername()" value="<?php echo @htmlspecialchars($korisnickoIme); ?>"><br><br>
                <label for="prijava-lozinka" id="prijava-lozinka-labela" <?php if(isset($stilLozinkaPrijava)){echo $stilLozinkaPrijava;} ?>>Lozinka</label><br>
                <input name="prijava_lozinka" autocomplete="off" type="password" id="prijava-lozinka"><br><br>
                <input name="prijava_zapamti" type="checkbox" id="prijava-zapamti">
                <label for="prijava-zapamti" id="prijava-zapamti-labela">Zapamti me</label><br><br>
                <input type="submit" form="prijava-forma" name="prijava_gumb" id="prijava-gumb" value="Prijavi se" <?php if(isset($brojNeuspjesnihPrijava) && $brojNeuspjesnihPrijava==5){echo "disabled";} ?>>
            </form>
        </div>
        
        <div class="notReg">
        <a href="zaboravljenaLozinka.php">Zaboravili ste lozinku?</a><br><br>
            <p>Nemate račun?</p>
            <a href="registracija.php">REGISTRIRAJ SE!</a><br><br><br>
            <a href="dokumentacija.html"><button name="dokumentacija" id="dokumentacija-gumbic">Dokumentacija</button></a><br><br>
            <a href="o_autoru.html"><button name="o_autoru" id="o-autoru-gumbic">O autoru</button></a>
        </div>
                <?php
                if(isset($greska)){echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                    color: rgb(242, 240, 234); \">$greska</p>";}
                
                ?>
       
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function provjeraUsername(){
        jQuery.ajax({
            url: "provjeraUsernameaPrijava.php",
            data:  {username: $('#prijava-username').val()},
            type: "POST",
            success: function(data){
                console.log("radi");
                $("#provjeraKorIme").html(data);
            },
            error: console.log("Ne radi nekaj")
        })
        console.log($("#prijava-username").val());
    }
</script>
</html>