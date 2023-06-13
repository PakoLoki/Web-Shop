<?php

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = dirname(getcwd());

require "./skripte/zaglavlje.php";
require "./skripte/meni.php";


if($_SESSION['uloga']>1){
    header("Location: profil.php");
}

if(isset($_GET['vrijednosti'])){
    $donjiLimit=$_GET['vrijednosti'];
}
else{
    $donjiLimit=11;
}


if(isset($_POST['gumb_popis'])){
    
    $limitStranica=11;
    $upit="";

    $veza=new Baza();
    $veza->spojiDB();

    if(isset($_POST['popis'])){
        $upit="SELECT `email` FROM `korisnik`";
        $rezultat=$veza->selectDB($upit);

        while($red=mysqli_fetch_array($rezultat)){
            if($_POST['popis']==$red['email']){
                $upit="SELECT dnevnik_rada.*, tip_radnje.naziv_radnje
                FROM dnevnik_rada
                JOIN tip_radnje ON dnevnik_rada.tip_radnje_id = tip_radnje.tip_radnje_id
                WHERE email='{$red['email']}'
                LIMIT $donjiLimit,$limitStranica";
            }
            if($_POST['popis']=="svi"){
                $upit="SELECT dnevnik_rada.*, tip_radnje.naziv_radnje
                    FROM dnevnik_rada
                    JOIN tip_radnje ON dnevnik_rada.tip_radnje_id = tip_radnje.tip_radnje_id
                    LIMIT $donjiLimit,$limitStranica";
    
            }
        }
        
        
    }
    
}
else{

    $limitStranica=11;

    $upit="SELECT dnevnik_rada.*, tip_radnje.naziv_radnje
            FROM dnevnik_rada
            JOIN tip_radnje ON dnevnik_rada.tip_radnje_id = tip_radnje.tip_radnje_id
            LIMIT $donjiLimit,$limitStranica";
    
    
}
$veza->zatvoriDB();
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
        <h2 id="pocetak" style="padding-left: 0%; padding-right:10%; ">Podaci iz dnevnika rada</h2>
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
    <form method="POST" style="padding-top: 5%;">
        <label for="datumi-popis" style="font-family:Georgia, 'Times New Roman', Times, serif;
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
                        echo "<option value=\"{$red['email']}\">{$red['email']}</option>";
                        
                    }
                } 

                $veza->zatvoriDB();
            ?>
        </select>
        
        <input type="submit" name="gumb_popis" value="Odaberi">
</form>
    <div style="padding-bottom: 5%;" class="popis-tablica print-odabir">
    <?php 
       echo "<table class=\"tablica\">
            <thead>
                <tr>
                    <th colspan=\"4\">
                        Registar dnevnika
                    </th>
                </tr>
                <tr>
                    <th>ID zapisa</th>
                    <th>Email</th>
                    <th>Radnja</th>
                    <th>Datum i vrijeme zapisa</th>
                </tr>
            </thead>
            <tbody>";
                 
                $veza=new Baza();
                $veza->spojiDB();


                $rezultat=$veza->selectDB($upit);

                if(mysqli_num_rows($rezultat)>0){
                    while($red=mysqli_fetch_assoc($rezultat)){
                    echo 
                        "<tr><td>".$red['dnevnik_id']."</td>
                        <td>".$red['email']."</td>
                        <td>".$red['naziv_radnje']."</td>
                        <td>".$red['datum_vrijeme_zapisa']."</td>";                
                    }
                }
                else{
                    echo "<tr><td colspan=4>Nema postojećih zapisa</tr></td>";
                }

                
                
                
      echo  "</tbody>
            <tfoot>
                
            </tfoot>
        </table><br><br>";

        $limitStranica=11;
        $upit="SELECT * FROM `dnevnik_rada`";
                $rezultat=$veza->selectDB($upit);
                $veza->zatvoriDB();

                $red=mysqli_num_rows($rezultat);
                $stranice=ceil($red/$limitStranica);

                for ($i=0; $i < $stranice; $i++) { 
                    $vrijednosti=$i*$limitStranica;
                    if($i==0){
                        echo "<a class='stranice' href='pregledDnevnika.php?vrijednosti=".$vrijednosti."'>Početna</a>";
                    }
                    else{
                        echo "<a class='stranice' href='pregledDnevnika.php?vrijednosti=".$vrijednosti."'>".$i."</a>";
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
<script>
  // Retrieve the selected value from local storage
  var selectedValue = localStorage.getItem('selectedValue');

  // Set the selected value in the select element
  if (selectedValue) {
    document.getElementById('popis').value = selectedValue;
  }

  // Save the selected value to local storage when the selection changes
  document.getElementById('popis').addEventListener('change', function() {
    var newValue = this.value;
    localStorage.setItem('selectedValue', newValue);
  });
</script>

</html>