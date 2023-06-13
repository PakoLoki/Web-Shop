<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";

if($_SESSION['uloga']>3){
    header("Location: prijava.php");
}

$veza=new Baza();
$veza->spojiDB();




$upit="SELECT * FROM `korisnik` WHERE email = '{$_SESSION['korisnik']}'";

$rezultat=$veza->selectDB($upit);

if(mysqli_num_rows($rezultat)==1){
    while($red=mysqli_fetch_assoc($rezultat)){
        $emailProfil=$red['email'];
        $slikaProfil=$red['slika_profila'];
        $nadimakProfil=$red['nadimak'];
    }
}


if(isset($_POST['nadimak_gumb'])){

    $greska=0;
    $greskaNadimak="";
    $nadimakSetan=false;

    $nadimakVrijednost=XSS_SQL_inj($_POST['nadimak_profilna']);

    if(empty($nadimakVrijednost)){
        $greskaNadimak.="Nadimak ne može biti prazan";
        $greska++;
        
    }

    if($greska==0){

        $upit="UPDATE `korisnik` SET `nadimak`='{$nadimakVrijednost}' WHERE email='{$_SESSION['korisnik']}'";
        $rezultat=$veza->updateDB($upit);

        $datumUnosauDnevnik=date("Y-m-d h:i:s");
        $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
        VALUES ('','{$_SESSION['korisnik']}',12,'{$datumUnosauDnevnik}')";

        $rezultat = $veza->updateDB($upit);

        $nadimakSetan=true;
    }
    

}

function XSS_SQL_inj($inputi) {
    $inputi = trim($inputi);
    $inputi = stripslashes($inputi);
    $inputi = htmlspecialchars($inputi);
    return $inputi;
}

$veza->zatvoriDB();

?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <title>Profil</title>
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
                <h2>Dobro došli na Vaš profil</h2>
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


    <div class="o_autoru-sekcije print-odabir">
        <div >
        <section >
            <div class="o_autoru-podsekcija-1">


     <!-- Forma za profilnu sliku -->       
<form class="form" id = "forma-profilna" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <img src="./Multimedija/<?php echo $slikaProfil; ?>" width = 125 height = 125 title="<?php if(isset($slikaProfil)){echo $slikaProfil;}
                                                                                                    else{echo"Nema slike";}  ?>">
        <div class="round">
          <input type="hidden" name="email_profilna" value="<?php echo $emailProfil; ?>">
          <input type="file" name="slika_profilna" id = "slika-profilna" accept=".jpg, .jpeg, .png">
          <i class = "fa fa-camera" style = "color: #fff;"></i>
        </div>
      </div>
    </form>

    <!-- Forma za nadimak -->
    <form id="forma-nadimak" method="post">
        <label for="nadimak-profilna" id="nadimak-profilna-labela">Odaberite nadimak</label><br>
        <?php if(isset($greskaNadimak)){echo "<p style=\"font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); \">$greskaNadimak</p><br>";}
             ?>
        <input type="text" name="nadimak_profilna" id="nadimak-profilna"><br>
        <button type="submit" id="nadimak-gumb" name="nadimak_gumb" form="forma-nadimak">Promjeni</button>
    </form>
    <script type="text/javascript">
      document.getElementById("slika-profilna").onchange = function(){
          document.getElementById("forma-profilna").submit();
      };
    </script>
    <?php

    if(isset($_FILES["slika_profilna"]["name"])){

      $slikaProfil=$_FILES["slika_profilna"]["name"];
      $emailProfil = $_POST["email_profilna"];

        $veza=new Baza();
        $veza->spojiDB();

        $upit = "UPDATE `korisnik` SET slika_profila = '{$slikaProfil}' WHERE email = '{$emailProfil}' " ;

        $rezultat=$veza->updateDB($upit);

        $datumUnosauDnevnik=date("Y-m-d h:i:s");
        $upit = "INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
        VALUES ('','{$_SESSION['korisnik']}',11,'{$datumUnosauDnevnik}')";

        $rezultat = $veza->updateDB($upit);

        $veza->zatvoriDB();
        
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=profil.php\">";
        
    }

    $veza=New Baza();
    $veza->spojiDB();

    $upit="SELECT * FROM `korisnik` WHERE email='{$_SESSION['korisnik']}'";

    $rezultat=$veza->selectDB($upit);

    if(mysqli_num_rows($rezultat)==1){
        while($red=mysqli_fetch_assoc($rezultat)){
            $nadimakProfil=$red['nadimak'];
        }
    }

$veza->zatvoriDB();
    ?>
                <div style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: rgb(242, 240, 234); ">
                    <div class="naslovi">Nadimak: <?php if(isset($nadimakProfil)){echo $nadimakProfil;}
                    else{echo "Unesite nadimak kako biste kreirali profil i započeli kupnju";} ?> </div>
                </div>
                <?php
            
                $veza=new Baza();
                $veza->spojiDB();

                $upit="SELECT * FROM `registar_bodova` WHERE korisnik_email='{$_SESSION['korisnik']}'";

                $rezultat=$veza->selectDB($upit);

                if(mysqli_num_rows($rezultat)==1){
                    while($red=mysqli_fetch_assoc($rezultat)){
                        $brojBodova=$red['broj_trenutnih_bodova'];
                    }
                }
            ?>
            </div>
            <div>
            <p>Vaš trenutni broj bodova: "<?php echo $brojBodova ?>"<br><br>
            Bodove možete ostvariti kupnjom proizvoda.</p>
            <a href="popisKampanja.php"><button name="kupnja" id="gumb-shopping">Idi u shopping</button></a>
            </div>
    <div style="padding-bottom: 5%;" class="popis-tablica print-odabir">
    <table class="tablica" style="margin-left: 13%;">
    <thead>
        <tr>
            <th colspan="5">
                Vaši kupljeni proizvodi
            </th>
        </tr>
        <tr>
            <th>Kupnja ID</th>
            <th>Naziv proizvoda</th>
            <th>Euri iskorišteni u kupnji</th>
            <th>Bodovi iskorišteni u kupnji</th>
            <th>Slika</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $veza=new Baza();
        $veza->spojiDB();

        $limitStranica=11;

        if(isset($_GET['vrijednosti'])){
            $donjiLimit=$_GET['vrijednosti'];
            $upit="SELECT kupnja.kupnja_id, proizvod.naziv_proizvoda, kupnja.euri_iskoristeni_u_kupnji, 
        kupnja.bodovi_iskoristeni_u_kupnji,proizvod.slika_proizvoda
        FROM kupnja JOIN korisnik ON kupnja.korisnik_email = korisnik.email 
        JOIN proizvod ON kupnja.proizvod_id = proizvod.proizvod_id 
        WHERE korisnik.email = '{$_SESSION['korisnik']}'
        LIMIT $donjiLimit,$limitStranica";
        }
        else{
            $donjiLimit=11;
            $upit="SELECT kupnja.kupnja_id, proizvod.naziv_proizvoda, kupnja.euri_iskoristeni_u_kupnji, 
        kupnja.bodovi_iskoristeni_u_kupnji,proizvod.slika_proizvoda
        FROM kupnja JOIN korisnik ON kupnja.korisnik_email = korisnik.email 
        JOIN proizvod ON kupnja.proizvod_id = proizvod.proizvod_id 
        WHERE korisnik.email = '{$_SESSION['korisnik']}'
        LIMIT $limitStranica";
        }

        

        

        $rezultat=$veza->selectDB($upit);

        if(mysqli_num_rows($rezultat)>0){
            while($red=mysqli_fetch_assoc($rezultat)){
                echo 
                "<tr><td>".$red['kupnja_id']."</a></td>
                <td>".$red['naziv_proizvoda']."</td>
                <td>".$red['euri_iskoristeni_u_kupnji']."</td>
                <td>".$red['bodovi_iskoristeni_u_kupnji']."</td>
                <td><img src=\"./Multimedija/{$red['slika_proizvoda']}\" width = 125 height = 125</tr></td>";
                              
            }
        }
        else{
            echo "<tr><td colspan=5>Niste još kupili ništa</tr></td>";
        }

        $veza->zatvoriDB();
        ?>
        
   </tbody>
    <tfoot>    
    </tfoot>
    </table>
    <?php 
    
    $veza=new Baza();
    $veza->spojiDB();

    $limitStranica=11;
        $upit="SELECT * FROM `kupnja`";
                $rezultat=$veza->selectDB($upit);
                $veza->zatvoriDB();

                $red=mysqli_num_rows($rezultat);
                $stranice=ceil($red/$limitStranica);

                for ($i=0; $i < $stranice; $i++) { 
                    $vrijednosti=$i*$limitStranica;
                    if($i==0){
                        echo "<a class='stranice' href='profil.php?vrijednosti=".$vrijednosti."'>Početna</a>";
                    }
                    else{
                        echo "<a class='stranice' href='profil.php?vrijednosti=".$vrijednosti."'>".$i."</a>";
                    }
                    
                }
    
    ?>
</div>
        </section>
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