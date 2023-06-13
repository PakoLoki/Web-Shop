<?php

if (isset($_POST['registracija_gumb'])) {

    $greska = 0;
    $greskaUvjeti = "";
    $lozinka = "";
    $potvrdaLozinka = "";
    $greskaIme="";
    $greskaPrezime="";

    $checkiraniUvjeti=false;

    $stilIme = 'style="color:red;"';
    $stilPrezime = 'style="color:red;"';
    $stilDatum = 'style="color:red;"';
    $stilSpol = 'style="color:red;"';
    $stilTelefon = 'style="color:red;"';
    $stilAdresa = 'style="color:red;"';
    $stilMail = 'style="color:red;"';
    $stilUsername = 'style="color:red;"';
    $stilLozinka = 'style="color:red;"';
    $stilPotvrda = 'style="color:red;"';
    $stilUvjeti= 'style="color:red;"';

    $ime = XSS_SQL_inj($_POST['registracija_ime']);
    $prezime = XSS_SQL_inj($_POST['registracija_prezime']);
    $datum =XSS_SQL_inj($_POST['registracija_datum']);
    $telefon=XSS_SQL_inj($_POST['registracija_telefon']);
    $adresa=XSS_SQL_inj($_POST['registracija_adresa']);
    $email = XSS_SQL_inj($_POST['registracija_email']);
    $username = XSS_SQL_inj($_POST['registracija_username']);
    $sifra = XSS_SQL_inj($_POST['registracija_lozinka']);
    $ponovljenaSifra = XSS_SQL_inj($_POST['registracija_lozinka_potvrda']);
    $aktivacijskiKod=bin2hex(random_bytes(16));
    $uvjeti="";

    if (isset($_POST['spol'])) {
        $spol = XSS_SQL_inj($_POST['spol']);
    }

    foreach ($_POST as $key => $value) {

        if (empty($value) && $key !== "registracija_gumb") {

            //echo "Nije uneseno: " . $key . "<br>";
            $greska++;
        } elseif ($key === "registracija_ime") {

            if ($value === "") {
                $stilIme = 'style="color:red;"';
                
            } else {
                 $znakovi="/^[a-zA-ZčČćĆšŠđĐžŽ]*$/";
                 if (!preg_match($znakovi, $value)){
                    $greskaIme="Ime ne smije sadržavati brojeve!";
                 }
                 else{
                    $stilIme = 'style="color:rgb(242, 240, 234);;"';
                 }
                
            }
        } elseif ($key === "registracija_prezime") {

            if ($value === "") {
                $stilPrezime = 'style="color:red;"';
            } else {
                $znakovi="/^[a-zA-ZčćČĆšŠđĐžŽ]*$/";
                 if (!preg_match($znakovi, $value)){
                    $greskaPrezime="Prezime ne smije sadržavati brojeve!";
                 }
                 else{
                    $stilPrezime = 'style="color:rgb(242, 240, 234);;"';
                 }
            }
            
        } 
        
        elseif ($key === "registracija_datum") {

            if ($value === "") {
                $stilDatum = 'style="color:red;"';
            } else {
                $stilDatum = 'style="color:rgb(242, 240, 234);;"';
            }

            
        }

        elseif ($key === "registracija_username") {


            $provjeraUsername = "";


            $veza = new Baza();
            $veza->spojiDB();

            $upit = "SELECT * FROM `korisnik` WHERE `korisnicko_ime`= '{$username}'";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) != 0) {

                $provjeraUsername .= "Korisnicko ime zauzeto, odaberite drugo.";
                $stilUsername = 'style="color:red;"';
                $greska++;
            }

            $veza->zatvoriDB();

            if ($value === "" || $provjeraUsername!=="") {
                $stilUsername = 'style="color:red;"';
            } else {
                $stilUsername = 'style="color:rgb(242, 240, 234);;"';
            }
        }
        elseif ($key === "registracija_telefon") {

            if ($value === "") {
                $stilTelefon = 'style="color:red;"';
            } else {
                $stilTelefon = 'style="color:rgb(242, 240, 234);;"';
            }
        }
        elseif ($key === "registracija_adresa") {

            if ($value === "") {
                $stilAdresa = 'style="color:red;"';
            } else {
                $stilAdresa = 'style="color:rgb(242, 240, 234);;"';
            }
        }
        
        
        elseif ($key === "registracija_email") { // 2.a) Provjera emaila

            $provjeraMaila = "";


            $veza = new Baza();
            $veza->spojiDB();

            $upit = "SELECT * FROM `korisnik` WHERE `email`= '{$email}'";

            $rezultat = $veza->selectDB($upit);

            if (mysqli_num_rows($rezultat) != 0) {

                $provjeraMaila .= "Postoji korisnik s ovim emailom.";
                $stilMail = 'style="color:red;"';
                $greska++;
            }

            $veza->zatvoriDB();

            $uzorak = "/^[A-Za-z0-9._]{1,64}@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*\.(info|hr|com)$/";
            if (!preg_match($uzorak, $value)) {

                $provjeraMaila = "Format emaila nije u redu";
                $greska++;
            }

            if ($value === "" || $provjeraMaila !== "") {
                $stilMail = 'style="color:red;"';
                $greska++;
            } else {
                $stilMail = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "registracija_lozinka") { // 2.a)ii) Provjera lozinke

            $provjeraLozinke = "";
            $zadnjiElement = "";
            $lozinkaMaloSlovo = false;
            $lozinkaVelikoSlovo = false;
            $lozinkaBroj = false;
            $lozinkaRazmak = false;
            $lozinkaDuljina = false;
            $lozinkaZnakovi = false;

            $lozinka = $value;

            if (strlen($value) >= 15 && strlen($value) <= 25) {

                $lozinkaDuljina = true;

                $zadnjiElement = substr("$value", -1);

                //echo $zadnjiElement."<br>";

                for ($i = 0; $i < strlen($value); $i++) {

                    //echo $value[$i]. "<br>";
                    if (ctype_lower($value[$i])) {
                        // Ako je char malo slovo
                        $lozinkaMaloSlovo = true;
                    } elseif (ctype_upper($value[$i])) {
                        // Ako je char veliko slovo
                        $lozinkaVelikoSlovo = true;
                    } elseif (ctype_digit($value[$i])) {
                        // Ako je char broj
                        $lozinkaBroj = true;
                    } elseif ($value[$i] == " ") {
                        //Ako je char razmak
                        $lozinkaRazmak = true;
                    } elseif (
                        $value[0] === "=" ||
                        $value[0] === "*" ||
                        $value[0] === "/" ||
                        $value[0] === "%"
                    ) {
                        $lozinkaZnakovi = true;
                    } elseif (
                        $zadnjiElement === "=" ||
                        $zadnjiElement === "*" ||
                        $zadnjiElement === "/" ||
                        $zadnjiElement === "%"
                    ) {
                        $lozinkaZnakovi = true;
                    }
                }
            }

            if (
                $lozinkaDuljina === false ||
                $lozinkaMaloSlovo === false ||
                $lozinkaVelikoSlovo === false ||
                $lozinkaBroj === false ||
                $lozinkaRazmak === true ||
                $lozinkaZnakovi === true
            ) {
                $provjeraLozinke = "Šifra mora imati:<br> 
                Min. 15 znakova, a Max. 25 znakova<br>
                Jedno malo i jedno veliko slovo<br>
                Jedan broj<br>
                Bez razmaka<br>
                Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke<br>";
                $greska++;
            }

            if ($value === "" || $provjeraLozinke !== "") {
                $stilLozinka = 'style="color:red;"';
            } else {
                $stilLozinka = 'style="color:rgb(242, 240, 234);;"';
            }
        } elseif ($key === "registracija_lozinka_potvrda") {
            $potvrdaLozinka = $value;

            if ($lozinka !== $potvrdaLozinka) {
                $provjeraLozinke .= "Lozinke nisu iste";
                $greska++;
            }

            if ($value === "" || $provjeraLozinke !== "") {
                $stilPotvrda = 'style="color:red;"';
                $stilLozinka = 'style="color:red;"';
                $greska++;
            } else {
                $stilPotvrda = 'style="color:rgb(242, 240, 234);;"';
            }
        }



        if (!isset($_POST['spol'])) {
            $greska++;
            $stilSpol = 'style="color:red;"';
        } else {
            $stilSpol = 'style="color:rgb(242, 240, 234);;"';
        }
    }

    if(isset($_POST['registracija_uvjeti'])){

        $stilUvjeti='style="color:rgb(242, 240, 234);;"';
        $uvjeti=$_POST['registracija_uvjeti'];
        $checkiraniUvjeti=true;

        $imeCookie="Registrirani_korisnik";
        setcookie($imeCookie, "Uvjeti prihvaćeni",time() + (86400*2), "/");
    }
    else{
        $greskaUvjeti="Uvjeti korištenja moraju biti prihvaćeni!";
    }


    if($greska==0){

        $veza=new Baza();
        $veza->spojiDB();

        

            // 2. iii) 2) Kriptirajuća sol
            $salt="asdjdndsaj45jndfs#12";
            $kriptiranaSifra=$sifra;
            $sifraSHA=sha1($kriptiranaSifra.$salt);

            $datumRegistracije=date("Y-m-d h:i:s");
            
            mail($email,"Aktivacijski kod: ","Vaš aktivacijski kod je: {$aktivacijskiKod}");



            $upit="INSERT INTO `korisnik`(`email`,`tip_id`, `ime`, `prezime`, `datum_rodenja`, `spol`, 
            `broj_telefona`, `adresa`, `korisnicko_ime`, `lozinka`, `lozinka_sha256`, `nadimak`, `slika_profila`, 
            `datum_vrijeme_registracije`, `broj_unosa`, `status_racuna`, `uvjeti_koristenja`, `aktivacijski_kod`) 
            VALUES ('{$email}',3,'{$ime}','{$prezime}','{$datum}','{$spol}','{$telefon}','{$adresa}','{$username}',
            '{$sifra}','{$sifraSHA}','','','{$datumRegistracije}',0,true,{$checkiraniUvjeti},'{$aktivacijskiKod}')";

            Sesija::kreirajKorisnika($email,3);

            $_SESSION['trajanjeKoda']=time();

            $rezultat= $veza->updateDB($upit);

            $upit="INSERT INTO `registar_bodova`(`zapis_bodova_id`, `korisnik_email`, `broj_trenutnih_bodova`) 
            VALUES ('','{$_SESSION['korisnik']}',0)";

            $rezultat= $veza->updateDB($upit);

            $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
            VALUES ('','{$email}',2,'{$datumRegistracije}')";

            $rezultat= $veza->updateDB($upit);

            $veza->zatvoriDB();

            header("Location: aktivacija.php");    
    }
    else{

        $veza=new Baza();
        $veza->spojiDB();

        $datumRegistracije=date("Y-m-d h:i:s");

        $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
        VALUES ('','{$email}',3,'{$datumRegistracije}')";

        $rezultat= $veza->updateDB($upit);

        $veza->zatvoriDB();
    }
}

function XSS_SQL_inj($inputi) {
    $inputi = trim($inputi);
    $inputi = stripslashes($inputi);
    $inputi = htmlspecialchars($inputi);
    return $inputi;
}

?>