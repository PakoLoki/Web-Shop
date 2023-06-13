<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";

if(isset($_GET['vrijednosti'])){
    $donjiLimit=XSS_SQL_inj($_GET['vrijednosti']);
}
else{
    $donjiLimit=11;
}


if(isset($_POST['gumb_popis'])){

    $limitStranica=11;

    $naslov="";
    $veza=new Baza();
    $veza->spojiDB();

    if(isset($_POST['popis'])){
        $upit="SELECT * FROM `korisnik`";
        $rezultat=$veza->selectDB($upit);
        while($red=mysqli_fetch_array($rezultat)){
            if($_POST['popis']==$red['email']){
                $upit="SELECT * FROM `korisnik` WHERE nadimak='{$red['nadimak']}'";

            }
            if($_POST['popis']=="svi"){
                $upit="SELECT * FROM `korisnik`";
    
            }
        }
    }       
}
else{
    $limitStranica=11;
    $upit="SELECT * FROM `korisnik`
    LIMIT $donjiLimit,$limitStranica";
    $naslov="Popis korisnika koji imaju profil";
}

//$veza->zatvoriDB();

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
    <title>Popis kreiranih profila</title>
    
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
        <h2 id="pocetak" style="padding-left: 0%; padding-right:10%; ">Popis kreiranih profila</h2>
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
        <a href="./logout.php" <?php if(isset($vidljivostGumba)){echo "$vidljivostGumba";} ?>><button name="odjava">Odjava</button></a>
        </div>
    </div>
</div>
    </header>
    <div style="display: flex; align-items: center; flex-direction: column; justify-content:center; background-color: rgb(212, 167, 101);">
    <div>
    <form method="POST" style="padding-top: 5%;">
        <label for="popis" style="font-family:Georgia, 'Times New Roman', Times, serif;
                color: black;">Pretražite korisnika</label><br>
        <select name="popis" id="popis">
            <option value="svi">Svi korisnici</option>
        <?php 
            
            $veza=new Baza();
            $veza->spojiDB();

            $upitKorisnik="SELECT * FROM `korisnik`";

                $rezultat=$veza->selectDB($upitKorisnik);

                if(mysqli_num_rows($rezultat)>0){
                    while($red=mysqli_fetch_assoc($rezultat)){
                        if($red['nadimak']!=""){echo "<option value=\"{$red['email']}\">{$red['nadimak']}</option>";}
                    }
                } 

                $veza->zatvoriDB();
            ?>
        </select>
        
        <input type="submit" name="gumb_popis" id="gumb-popis" value="Odaberi">
</form>
    </div>
    <div style="padding-bottom: 5%;" class="popis-tablica print-odabir">
        <table class="tablica">
            <thead>
                <tr>
                    <th colspan="5">
                        <?php echo $naslov; ?>
                    </th>
                </tr>
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Email</th>
                    <th>Nadimak</th>
                    <th>Slika profila</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $veza=new Baza();
                $veza->spojiDB();

                
                $rezultat=$veza->selectDB($upit);

                if(mysqli_num_rows($rezultat)>0){
                    while($red=mysqli_fetch_assoc($rezultat)){
                        echo 
                        "<tr><td>".$red['ime']."</td>
                        <td>".$red['prezime']."</td>
                        <td>".$red['email']."</td>
                        <td>".$red['nadimak']."</td>";
                        if($red['slika_profila']!==""){echo "<td><img src=\"./Multimedija/{$red['slika_profila']}\" width = 125 height = 125</tr></td>";}
                        else{echo "<td>Korisnik nema sliku</tr></td>";}
                             
                    }
                }
                else{
                    echo "<tr><td colspan=5>Nijedan korisnik nema izrađen profil!</tr></td>";
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
        $upit="SELECT * FROM `korisnik`";
                $rezultat=$veza->selectDB($upit);
                //$veza->zatvoriDB();

                $red=mysqli_num_rows($rezultat);
                $stranice=ceil($red/$limitStranica);

                for ($i=0; $i < $stranice; $i++) { 
                    $vrijednosti=$i*$limitStranica;
                    if($i==0){
                        echo "<a class='stranice' href='popisIzradenihProfila.php?vrijednosti=".$vrijednosti."'>Početna</a>";
                    }
                    else{
                        echo "<a class='stranice' href='popisIzradenihProfila.php?vrijednosti=".$vrijednosti."'>".$i."</a>";
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