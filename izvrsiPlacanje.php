<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";

if($_SESSION['uloga']>3){
    header("Location: prijava.php");
}

$veza = new Baza();
$veza->spojiDB();

$datumUnosauDnevnik = date("Y-m-d h:i:s");

$upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                        VALUES ('','{$_SESSION['korisnik']}',13,'{$datumUnosauDnevnik}')";

$rezultat = $veza->updateDB($upit);

$idProizvoda=XSS_SQL_inj($_GET['link']);


if (isset($_POST['plati_eurima'])) {

    $greskaEuri="";

    $cijenaProizvodaEuri=XSS_SQL_inj($_POST['cijena_proizvoda_euri']);
    $kolicina=XSS_SQL_inj($_POST['skriveno_polje_euri']);
    $konacnaCijenaEuri=XSS_SQL_inj($_POST['konacna_cijena_euri']);

    $upit="SELECT * FROM `proizvod` WHERE proizvod_id='{$idProizvoda}'";

    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)==1){
        while($red=mysqli_fetch_assoc($rezultat)){
            $kolicinaProizvoda=$red['kolicina'];
            $bodoviKojeKupacDobiva=$red['bodovi_kupac'];
        }
    }
 
    

    $preracunataKolicina=$kolicinaProizvoda-$kolicina;
    
  

    $preracunatiBodovi=$kolicina*$bodoviKojeKupacDobiva;
 

   

    $upit="SELECT * FROM `registar_bodova` WHERE korisnik_email='{$_SESSION['korisnik']}'";
    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)==1){
        while($red=mysqli_fetch_assoc($rezultat)){
            $brojTrenutnihBodova=$red['broj_trenutnih_bodova'];
            
        }
    }
    $brojTrenutnihBodova+=$preracunatiBodovi;
    if($konacnaCijenaEuri!=$cijenaProizvodaEuri){
        $greskaEuri="<div id='greska-euri'>Molimo unesite točnu cijenu</div>";
        
    }
    else{
        if($preracunataKolicina==0){
            $upit="UPDATE `proizvod` SET `kolicina`=0 WHERE proizvod_id='{$idProizvoda}'";
            $rezultat=$veza->updateDB($upit);
        }
        else{
            $upit="UPDATE `proizvod` SET `kolicina`='{$preracunataKolicina}' WHERE proizvod_id='{$idProizvoda}'";
            $rezultat=$veza->updateDB($upit);
        }

        $upit="UPDATE `registar_bodova` SET `broj_trenutnih_bodova`='{$brojTrenutnihBodova}' WHERE korisnik_email='{$_SESSION['korisnik']}'";
    $rezultat=$veza->updateDB($upit);

    $upit="INSERT INTO `kupnja`(`proizvod_id`, `korisnik_email`, `bodovi_iskoristeni_u_kupnji`, `euri_iskoristeni_u_kupnji`) 
    VALUES ('{$idProizvoda}','{$_SESSION['korisnik']}',0,'{$cijenaProizvodaEuri}')";
    $rezultat=$veza->updateDB($upit);

    $datumUnosauDnevnik = date("Y-m-d h:i:s");

    $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                            VALUES ('','{$_SESSION['korisnik']}',15,'{$datumUnosauDnevnik}')";

    $rezultat = $veza->updateDB($upit);
    header("Location: profil.php");

    
    }
    
}

if (isset($_POST['plati_bodovima'])){

    $greska=0;
    $greskaBodovi="";
    $nedovoljnoBodova="";

    $cijenaProizvodaBodovi=XSS_SQL_inj($_POST['cijena_proizvoda_bodovi']);
    $kolicina=XSS_SQL_inj($_POST['skriveno_polje_bodovi']);
    $konacnaCijenaBodovi=XSS_SQL_inj($_POST['konacna_cijena_bodovi']);

    $upit="SELECT * FROM `registar_bodova` WHERE korisnik_email='{$_SESSION['korisnik']}'";

    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)==1){
        while($red=mysqli_fetch_assoc($rezultat)){
            $brojTrenutnihBodova=$red['broj_trenutnih_bodova'];
        }
    }
    if($brojTrenutnihBodova<$cijenaProizvodaBodovi){
        $nedovoljnoBodova="<div id='nedovoljno-bodovi'>Nemate dovoljno bodova</div>";
        $greska++;
    }

    $upit="SELECT * FROM `proizvod` WHERE proizvod_id='{$idProizvoda}'";

    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)==1){
        while($red=mysqli_fetch_assoc($rezultat)){
            $kolicinaProizvoda=$red['kolicina'];
        }
    }

    $preracunataKolicina=$kolicinaProizvoda-$kolicina;

    

    if($konacnaCijenaBodovi!=$cijenaProizvodaBodovi){
        $greskaBodovi="<div id='greska-bodovi'>Molimo unesite točnu cijenu</div>";
        $greska++;
    }

    
    if($greska==0){
        $noviBodovi=$brojTrenutnihBodova-$cijenaProizvodaBodovi;
        echo "Bodovi koje bude kupac nanovo ima u registru: ".$noviBodovi."<br>";
        $upit="UPDATE `registar_bodova` SET `broj_trenutnih_bodova`='{$noviBodovi}' WHERE korisnik_email='{$_SESSION['korisnik']}'";
        $rezultat=$veza->selectDB($upit);

        $upit="UPDATE `proizvod` SET `kolicina`='{$preracunataKolicina}' WHERE proizvod_id='{$idProizvoda}'";
        $rezultat=$veza->updateDB($upit);

        $upit="INSERT INTO `kupnja`(`proizvod_id`, `korisnik_email`, `bodovi_iskoristeni_u_kupnji`, `euri_iskoristeni_u_kupnji`) 
        VALUES ('{$idProizvoda}','{$_SESSION['korisnik']}','{$cijenaProizvodaBodovi}',0)";
        $rezultat=$veza->updateDB($upit);

        $veza->zatvoriDB();
        echo "<script>alert('Vaša kupnja je uspješno obavljena! Preusmjeravanje na vaš profil gdje možete pregledati vaše kupljene proizvode')</script>";
        header("Location: profil.php");
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
            <h2 id="pocetak" style="padding-left: 0%; padding-right:10%; ">Popis kampanja</h2>
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


    <div class="print-odabir" id="profil-proba">
    
                <div style="text-align: center;">
                    <h2 style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); ">Kupite proizvod</h2>
                </div>
            <div id="opis-cijena">
                    <div id="slika-tablica">
                    <?php
                    $upit="SELECT * FROM `proizvod` WHERE proizvod_id='{$idProizvoda}'";
                    $rezultat=$veza->selectDB($upit);

                    if(mysqli_num_rows($rezultat)==1){
                        while($red=mysqli_fetch_assoc($rezultat)){
                            
                            echo "<div><img src='./Multimedija/{$red['slika_proizvoda']}' width = 400 height=400></div>";
                            echo "<div style='padding-bottom: 5%;' class='print-odabir'>
                            <table class='tablica'>
                                    <thead>
                                        <tr>
                                            <th colspan='4'>
                                                Opis proizvoda
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Naziv</th>
                                            <th>Trenutno <br> dostupno</th>
                                            <th>€/komad</th>
                                            <th>Bodovi/komad</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>";
                            echo "<div id='tekst'>";
                            echo "<tr><td><div class='naziv-kupnja'>{$red['naziv_proizvoda']}</div></td> ";
                            echo "<td><div class='naziv-kupnja'>{$red['kolicina']}</div></td>";
                            echo "<td><div class='naziv-kupnja'>{$red['cijena_proizvoda']}€</div></td>";
                            echo "<td><div class='naziv-kupnja'>{$red['cijena_u_bodovima']}</div></tr></td>";
                            echo "</div>";
                            echo "</tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>
                        </div>";
                            
                        }
                    }

                    ?>
                     </div>
                    <div>
                    <div id="kolicina">
                    <form method='post'>
                    <label for='id-proizvoda' class="placanje-naslovi">ID proizvoda</label><br>
                    <div class="kolicina-input">
                    <input type='text' disabled id='id-proizvoda' value='<?php echo $idProizvoda ?>' style="font-size: 20pt;"><br>
                    </div>
                    <label for='placanje-kolicina' class="placanje-naslovi">Odaberite količinu koju želite kupiti</label><br>
                    <span id='provjeraKolicine'></span>
                    <div class="kolicina-input">
                    <input type='number' name='placanje_kolicina' id='placanje-kolicina' oninput='funkcije()' style="font-size: 20pt;">
                    </div>
                    </form>
                    
                    </div>
                    <div id="forme-placanje">
                    <form method='post' id="forma-euri">
                    <label for='cijena-proizvoda-euri' class="placanje-naslovi">Cijena u eurima 💶</label><br>
                    <input type='number' name="cijena_proizvoda_euri" id='cijena-proizvoda-euri' style="font-size: 20pt;"><br>
                    <input type="number" hidden name="skriveno_polje_euri" id="skriveno-polje-euri">
                    <label for="konacna-cijena-euri" class="placanje-naslovi">Unesite traženu cijenu</label><br>
                    <?php if(isset($greskaEuri)){echo $greskaEuri;} ?>
                    <input type="number" name="konacna_cijena_euri" id="konacna-cijena-euri" style="font-size: 20pt;"><br>
                    <input type="submit" name="plati_eurima" id="plati-eurima" value="Plati">
                    </form>
                    
                    <form method='post' id="forma-bodovi">
                    <label for='cijena-proizvoda-bodovi' class="placanje-naslovi">Cijena u bodovima 💯</label><br>
                    <input type='number' name="cijena_proizvoda_bodovi" id='cijena-proizvoda-bodovi'style="font-size: 20pt;"><br>
                    <input type="number" hidden name="skriveno_polje_bodovi" id="skriveno-polje-bodovi">
                    <label for="konacna-cijena-bodovi" class="placanje-naslovi">Unesite traženu cijenu</label><br>
                    <?php if(isset($greskaBodovi)){echo $greskaBodovi;} ?>
                    <?php if(isset($nedovoljnoBodova)){echo $nedovoljnoBodova;} ?>
                    <input type="number" name="konacna_cijena_bodovi" id="konacna-cijena-bodovi" style="font-size: 20pt;"><br>
                    <input type="submit" name="plati_bodovima" id="plati-bodovima"value="Plati">
                    </form>
                    </div>
                    <div id="gumbi">
                    <button id="gumb-placanje-euri">Plati eurima</button>
                    <button id="gumb-placanje-bodovi">Plati bodovima</button>
                    </div>
                    </div>
                    
            </div>
</body>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function funkcije(){
        provjeraKolicineProizvoda();
        provjeraEura();
        provjeraBodova();
        kolicinaHiddenElementa();
    }

    function provjeraKolicineProizvoda(){
        jQuery.ajax({
            url: "provjeraKolicineProizvoda.php",
            data:  {kolicina: $('#placanje-kolicina').val(), idProizvoda: $('#id-proizvoda').val()},
            type: "POST",
            success: function(data){
                $("#provjeraKolicine").html(data);
            },
            error: console.log("Ne radi nekaj")
        })
    }

    function provjeraEura(){
        jQuery.ajax({
            url: "provjeraEura.php",
            data:  {kolicina: $('#placanje-kolicina').val(),
                 cijenaProizvoda: $('#cijena-proizvoda-euri').val(),idProizvoda: $('#id-proizvoda').val()},
            type: "POST",
            success: function(data){
                $("#cijena-proizvoda-euri").attr('value',data);
            },
            error: console.log("Ne radi nekaj")
        })
    }
    function provjeraBodova(){
        jQuery.ajax({
            url: "provjeraBodova.php",
            data:  {kolicina: $('#placanje-kolicina').val(),
                 cijenaProizvoda: $('#cijena-proizvoda-bodovi').val(),idProizvoda: $('#id-proizvoda').val()},
            type: "POST",
            success: function(data){
                $("#cijena-proizvoda-bodovi").attr('value',data);
            },
            error: console.log("Ne radi nekaj")
        })
    }
    function kolicinaHiddenElementa(){
        jQuery.ajax({
            url: "kolicinaHiddenElementa.php",
            data:  {kolicina: $('#placanje-kolicina').val()},
            type: "POST",
            success: function(data){
                $("#skriveno-polje-euri").attr('value',data);
                $("#skriveno-polje-bodovi").attr('value',data);
            },
            error: console.log("Ne radi nekaj")
        })
    }
</script>
<script src="./javascript/placanje.js"></script>
</html>