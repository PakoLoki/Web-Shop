<?php



if (!isset($_GET['prijava_username'])){  
    $korisnickoIme = isset($_COOKIE['Spremljeni_username']) ? $_COOKIE['Spremljeni_username'] : '';
}


if(isset($_GET['prijava_gumb'])){

    $greska=0;
    $poruka="";
    //$brojNeuspjesnihPrijava=0;

    $prijavaUsername=XSS_SQL_inj($_GET['prijava_username']);
    $prijavaLozinka=XSS_SQL_inj($_GET['prijava_lozinka']);

    $stilUsernamePrijava =""; 
    $stilLozinkaPrijava="";

    foreach($_GET as $k => $v){
        if(empty($v) && $k!=="prijava_gumb"){
            $greska++;
        }
    }

    $provjeraLogina="";

    if(!empty($prijavaUsername) && !empty($prijavaLozinka)){
            $veza=new Baza();
            $veza->spojiDB();

            $upit="SELECT * FROM `korisnik` WHERE korisnicko_ime='{$prijavaUsername}' and lozinka='{$prijavaLozinka}'";

            $rezultat=$veza->selectDB($upit);

            if(mysqli_num_rows($rezultat)==1){
                //echo "Šifra matcha";
                $stilUsernamePrijava = 'style="color:rgb(242, 240, 234);;"';
                $stilLozinkaPrijava= 'style="color:rgb(242, 240, 234);;"';
                while($red=mysqli_fetch_assoc($rezultat)){
                    $idTipa=$red['tip_id'];
                    $prijavaEmail=$red['email'];
                }
                $upit="UPDATE `korisnik` SET `broj_unosa`= 0, `status_racuna`= 1  WHERE `korisnicko_ime`='{$prijavaUsername}'";

                $rezultat=$veza->updateDB($upit);


            }
            else{
                $stilUsernamePrijava = 'style="color:red;"';
                $stilLozinkaPrijava= 'style="color:red;"';
                $greska++;
                $provjeraLogina="Neuspješna prijava, pokušajte ponovo!<br><br>";
                $upit="SELECT `broj_unosa` FROM `korisnik` WHERE korisnicko_ime='{$prijavaUsername}'";

                $rezultat=$veza->selectDB($upit);

                if(mysqli_num_rows($rezultat)==1){
                    while($red=mysqli_fetch_assoc($rezultat)){
                        $brojNeuspjesnihPrijava=$red['broj_unosa'];
                        
                    }
                    

                    $brojNeuspjesnihPrijava++;

                    $upit="UPDATE `korisnik` SET `broj_unosa`='{$brojNeuspjesnihPrijava}' WHERE `korisnicko_ime`='{$prijavaUsername}'";

                    $rezultat=$veza->updateDB($upit);

                    if($brojNeuspjesnihPrijava>4){

                        $upit="UPDATE `korisnik` SET `status_racuna`= 0 WHERE `korisnicko_ime`='{$prijavaUsername}'";
                        $rezultat=$veza->updateDB($upit);

                        $upit="SELECT * FROM `korisnik` WHERE `korisnicko_ime`='{$prijavaUsername}'";
                        $rezultat=$veza->selectDB($upit);
                        if(mysqli_num_rows($rezultat)==1){
                            while($red=mysqli_fetch_assoc($rezultat)){
                                $email=$red['email'];
                                
                            }
                        }

                        $datumUnosauDnevnik=date("Y-m-d h:i:s");

                        $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                        VALUES ('','{$email}',6,'{$datumUnosauDnevnik}')";

                        $rezultat= $veza->updateDB($upit);
                    }

                }
                else{
                    $stilUsernamePrijava = 'style="color:red;"';
                    $stilLozinkaPrijava= 'style="color:red;"';
                    $greska++;
                }

                
            }

            $veza->zatvoriDB();


            if ($greska==0) {
                $poruka = 'Nema greške!';

                $veza=new Baza();
                $veza->spojiDB();
        
                if (isset($_GET['prijava_zapamti'])){
                    $korisnickoIme=XSS_SQL_inj($_GET['prijava_username']);
                    setcookie('Spremljeni_username',$korisnickoIme);

                }
                else{
                    if (isset($_COOKIE['Spremljeni_username'])){

                        unset($_COOKIE['Spremljeni_username']);
                        setcookie("Spremljeni_username", "", time()-3600);
                    }
                }

                session_set_cookie_params(1200);
                Sesija::kreirajKorisnika($prijavaEmail, $idTipa);

                $datumUnosauDnevnik=date("Y-m-d h:i:s");

                $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                VALUES ('','{$prijavaEmail}',7,'{$datumUnosauDnevnik}')";

                $rezultat= $veza->updateDB($upit);

                $veza->zatvoriDB();
                
                header("Location: profil.php");
            }
        }
        else{

                $veza=new Baza();
                $veza->spojiDB();

                $stilUsernamePrijava = 'style="color:red;"';
                $stilLozinkaPrijava= 'style="color:red;"';
                $greska++;
                
                $upit="SELECT * FROM `korisnik` WHERE korisnicko_ime='{$prijavaUsername}' and lozinka='{$prijavaLozinka}'";

                $rezultat=$veza->selectDB($upit);

                if(mysqli_num_rows($rezultat)==1){
                    while($red=mysqli_fetch_assoc($rezultat)){
                        $prijavaEmail=$red['email'];
                    }
                    $datumUnosauDnevnik=date("Y-m-d h:i:s");

                    $upit="INSERT INTO `dnevnik_rada`(`dnevnik_id`, `email`, `tip_radnje_id`, `datum_vrijeme_zapisa`) 
                    VALUES ('','{$prijavaEmail}',8,'{$datumUnosauDnevnik}')";
    
                    $rezultat= $veza->updateDB($upit);
                }
                else{
                    $stilUsernamePrijava = 'style="color:red;"';
                    $stilLozinkaPrijava= 'style="color:red;"';
                    $greska++;
                    $provjeraLogina="Neuspješna prijava, pokušajte ponovo!<br><br>";
                }

                
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