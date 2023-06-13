<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";
require "./Kodovi/registracijaKod.php";



?>


<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Registracija</title>
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
                <h2>Registracija</h2>
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
    <!--<nav>

        <a href="o_autoru.php">O autoru</a>
        <a href="obrasci/autentikacija.php">Autentikacija</a>
        <a href="obrasci/obrazac.php">Obrazac</a>
        <a href="ostalo/multimedija.php">Multimedija</a>
        <a href="ostalo/popis.php">Popis</a>
        <a href="era.php">ERA</a>
        <a href="navigacijski.php">Navigacijski</a>

    </nav>-->
    
    <section class="pocetna-sekcija print-odabir">
        <div id="naslov-pocetna">
            <h1>Registrirajte se!</h1>
        </div>

        <div class="grid-posebno-2">
            <form id="registracija-forma" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">

                <label for="registracija-ime" id="registracija-ime-labela" <?php if (isset($stilIme)) {
                                                    echo "$stilIme";
                                                }  ?>>Ime</label><br>
                                                <?php if (isset($greskaIme)) {
                echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$greskaIme</p>";
            } ?>
                <div id="registracija-ime-greska" style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); "></div>
                <input type="text" id="registracija-ime" name="registracija_ime" value="<?php echo $_POST['registracija_ime']??''; ?>" autocomplete="off"><br><br>
                <label for="registracija-prezime" id="registracija-prezime-labela" <?php if (isset($stilPrezime)) {
                                                    echo "$stilPrezime";
                                                }  ?>>Prezime</label><br>
                                                <?php if (isset($greskaPrezime)) {
                echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$greskaPrezime</p>";
            } ?>
                <div id="registracija-prezime-greska" style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); "></div>
                <input type="text" id="registracija-prezime" name="registracija_prezime" autocomplete="off" value="<?php echo $_POST['registracija_prezime']??''; ?>"><br><br>
                <label for="registracija-datum" id="registracija-datum-labela" <?php if (isset($stilDatum)) {
                                                    echo "$stilDatum";
                                                }  ?>>Datum rođenja</label><br>
                <input type="date" autocomplete="off" id="registracija-datum" name="registracija_datum" value="<?php echo $_POST['registracija_datum']??''; ?>"><br><br>
                <label for="spol" id="registracija-spol-labela" 
            
                        
                        <?php if (isset($stilSpol)) {
                                                    echo "$stilSpol";
                                                }  ?> >Spol</label>
                <div id="spol">
                    <input type="radio" id="registracija-spol-m" name="spol" value="M" <?php if(isset($_POST['spol']) && $_POST['spol'] =='M' ){echo "checked";}?>>
                    <label for="registracija-spol-m" id="registracija-spol-musko-labela">Muško</label><br>
                    <input type="radio" id="registracija-spol-z" name="spol" value="Z" <?php if(isset($_POST['spol']) && $_POST['spol'] =='Z' ){echo "checked";}?>>
                    <label for="registracija-spol-z" id="registracija-spol-zensko-labela">Žensko</label><br><br>
                </div>
                <label for="registracija-telefon" id="registracija-telefon-labela" <?php if (isset($stilTelefon)) {
                                                    echo "$stilTelefon";
                                                }  ?>>Broj telefona</label><br>
                <div id="registracija-telefon-greska" style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); "></div>
                <input type="text" autocomplete="off" id="registracija-telefon"name="registracija_telefon" value="<?php echo $_POST['registracija_telefon']??''; ?>"><br><br>
                <label for="registracija-adresa" id="registracija-adresa-labela" <?php if (isset($stilAdresa)) {
                                                    echo "$stilAdresa";
                                                }  ?>>Adresa</label><br>
                <input type="text" autocomplete="off" id="registracija-adresa"name="registracija_adresa" value="<?php echo $_POST['registracija_adresa']??''; ?>"><br><br>
                <label for="registracija-email" id="registracija-email-labela" <?php if (isset($stilMail)) {
                                                    echo "$stilMail";
                                                }  ?>>Email</label><br>
                                                <?php if (isset($provjeraMaila)) {
                echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$provjeraMaila</p>";
            } ?>
            <div id="registracija-email-greska" style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); "></div>
                <input type="email" autocomplete="off" id="registracija-email" name="registracija_email" value="<?php echo $_POST['registracija_email']??''; ?>"><br><br>
                <label for="registracija-username" id="registracija-username-labela" <?php if (isset($stilUsername)) {
                                                    echo "$stilUsername";
                                                }  ?>>Username</label><br>
                                                <span id="provjeraKorIme"></span>
                                                <?php if (isset($provjeraUsername)) {
                echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$provjeraUsername</p>";
            } ?>
                <input type="text" autocomplete="off" id="registracija-username" name="registracija_username" oninput="provjeraUsername()" value="<?php echo $_POST['registracija_username']??''; ?>"><br><br>
                <label for="registracija-lozinka" id="registracija-lozinka-labela"<?php if (isset($stilLozinka)) {
                                                    echo "$stilLozinka";
                                                }  ?>>Lozinka</label><br>
                                                <?php if (isset($provjeraLozinke)) {
                echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$provjeraLozinke</p>";
            } ?>
            <div id="registracija-lozinka-greska" style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); "></div>
                <input type="password" autocomplete="off" id="registracija-lozinka" name="registracija_lozinka" value="<?php echo $_POST['registracija_lozinka']??''; ?>"><br><br>
                <label for="registracija-lozinka-potvrda" id="registracija-lozinka-potvrda-labela" <?php if (isset($stilPotvrda)) {
                                                    echo "$stilPotvrda";
                                                }  ?>>Potvrda lozinke</label><br>
                <input type="password" autocomplete="off" id="registracija-lozinka-potvrda" name="registracija_lozinka_potvrda" value="<?php echo $_POST['registracija_lozinka_potvrda']??''; ?>"><br><br>
                <input type="checkbox" name="registracija_uvjeti" id="registracija-uvjeti" <?php if(isset($checkiraniUvjeti)){ if ($checkiraniUvjeti == true) {
                                                                                                                    echo "checked";
                                                                                                                }}
                                                                                                                else{
                                                                                                                    echo "";
                                                                                                                } ?> value="<?php if($checkiraniUvjeti == true){echo 1;}
                                                                                                                else{
                                                                                                                    echo 0;
                                                                                                                } ?>">
                <label for="registracija-uvjeti" id="registracija-uvjeti-labela" <?php if (isset($stilUvjeti)) {
                                                    echo "$stilUvjeti";
                                                }  ?>>Uvjeti korištenja</label><br><br>
                                                <?php if (isset($greskaUvjeti)) {
                    echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                    color: rgb(242, 240, 234); \">$greskaUvjeti</p><br>";
                } ?>
                <button type="submit" id="registracija-gumb" name="registracija_gumb" form="registracija-forma">Registriraj se</button>
            </form>
            
        </div>
        <div class="notReg">
            <p>Imate račun?</p>
            <a href="prijava.php">NATRAG NA PRIJAVU</a>
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
<!-- AJAX Provjera korisničkog imena  -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function provjeraUsername(){
        jQuery.ajax({
            url: "provjeraUsernamea.php",
            data:  {username: $('#registracija-username').val()},
            type: "POST",
            success: function(data){
                console.log("radi");
                $("#provjeraKorIme").html(data);
            },
            error: console.log("Ne radi nekaj")
        })
        console.log($("#registracija-username").val());
    }
</script>
<script src="./javascript/registracija.js"></script>
</html>