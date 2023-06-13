var registracijaGumb=document.getElementById("registracija-gumb");

var registracijaIme=document.getElementById("registracija-ime");
var registracijaPrezime=document.getElementById("registracija-prezime");
var registracijaTelefon=document.getElementById('registracija-telefon');
var registracijaEmail=document.getElementById('registracija-email');
var registracijaLozinka=document.getElementById('registracija-lozinka');

var labelaIme=document.getElementById("registracija-ime-labela");
var labelaPrezime=document.getElementById("registracija-prezime-labela");
var labelaTelefon=document.getElementById("registracija-telefon-labela");
var labelaEmail=document.getElementById("registracija-email-labela");
var labelaLozinka=document.getElementById("registracija-lozinka-labela");

var registracijeImeGreska=document.getElementById('registracija-ime-greska');
var registracijePrezimeGreska=document.getElementById('registracija-prezime-greska');
var registracijeTelefonGreska=document.getElementById('registracija-telefon-greska');
var registracijeEmailGreska=document.getElementById('registracija-email-greska');
var registracijeLozinkaGreska=document.getElementById('registracija-lozinka-greska');

//Ime
registracijaIme.addEventListener("focusout",  () =>{
    var znakovi=/\d/;

    if(registracijaIme.value==""){
        labelaIme.style="color:red;";
        registracijeImeGreska.innerHTML="";
        registracijaGumb.disabled=true;
        
    }
    else{
        if(registracijaIme.value.match(znakovi)){
            labelaIme.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeImeGreska.innerHTML="Ime ne može sadržavati broj";
            
        }
        else{
            labelaIme.style="color: rgb(242, 240, 234); ";
            registracijaGumb.disabled=false;
            registracijeImeGreska.innerHTML="";
        }
}
});

//Prezime
registracijaPrezime.addEventListener("focusout",  () =>{
    var znakovi=/\d/;

    if(registracijaPrezime.value==""){
        labelaIme.style="color:red;";
        registracijePrezimeGreska.innerHTML="";
        registracijaGumb.disabled=true;
        
    }
    else{
        if(registracijaPrezime.value.match(znakovi)){
            labelaPrezime.style="color:red;";
            registracijaGumb.disabled=true;
            registracijePrezimeGreska.innerHTML="Prezime ne može sadržavati broj";
            
        }
        else{
            labelaPrezime.style="color: rgb(242, 240, 234); ";
            registracijaGumb.disabled=false;
            registracijePrezimeGreska.innerHTML="";
        }
}
});

//Telefon
registracijaTelefon.addEventListener("focusout",  () =>{
    var znakovi=/^(?:\+?\d+|\d+)$/;

    if(registracijaTelefon.value==""){
        labelaTelefon.style="color:red;";
        registracijaGumb.disabled=true;
        registracijeTelefonGreska.innerHTML="";
        
    }
    else{
        if(!registracijaTelefon.value.match(znakovi)){
            labelaTelefon.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeTelefonGreska.innerHTML="Telefon ne može sadržavati specijalne znakove osim + ako je u formatu pozivnog broja";
            
        }
        else{
            labelaTelefon.style="color: rgb(242, 240, 234); ";
            registracijaGumb.disabled=false;
            registracijeTelefonGreska.innerHTML="";
        }  
}
});


//Email
registracijaEmail.addEventListener("focusout",  () =>{
    var znakovi=/^[A-Za-z0-9._]{1,64}@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*\.(info|hr|com)$/;

    if(registracijaEmail.value==""){
        labelaEmail.style="color:red;";
        registracijaGumb.disabled=true;
        registracijeEmailGreska.innerHTML="";
    }
    else{
        if(!registracijaEmail.value.match(znakovi)){
            labelaEmail.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeEmailGreska.innerHTML="Email nije u ispravnom formatu";
            
        }
        else{
            labelaEmail.style="color: rgb(242, 240, 234); ";
            registracijaGumb.disabled=false;
            registracijeEmailGreska.innerHTML="";
        }
}
});


//Lozinka
registracijaLozinka.addEventListener("focusout",  () =>{

    var uzorak=/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;

    if(registracijaLozinka.value.length==""){
        labelaLozinka.style="color:red;";
        registracijaGumb.disabled=true;
        registracijeLozinkaGreska.innerHTML="";
    }

    else if(registracijaLozinka.value.length >= 15 && registracijaLozinka.value.length <= 25){
        labelaLozinka.style="color: rgb(242, 240, 234); ";
        registracijeLozinkaGreska.innerHTML="";
        registracijaGumb.disabled=false;
        if(registracijaLozinka.value.startsWith('=')==true || registracijaLozinka.value.endsWith('=')==true){
            labelaLozinka.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeLozinkaGreska.innerHTML="Šifra mora imati:<br> Min. 15 znakova, a Max. 25 znakova<br>Jedno malo i jedno veliko slovo<br>Jedan broj<br>Bez razmaka<br>Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke";
        }
       else if(registracijaLozinka.value.startsWith('%')==true || registracijaLozinka.value.endsWith('%')==true){
        labelaLozinka.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeLozinkaGreska.innerHTML="Šifra mora imati:<br> Min. 15 znakova, a Max. 25 znakova<br>Jedno malo i jedno veliko slovo<br>Jedan broj<br>Bez razmaka<br>Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke";
        }
        else if(registracijaLozinka.value.startsWith('/')==true || registracijaLozinka.value.endsWith('/')==true){
            labelaLozinka.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeLozinkaGreska.innerHTML="Šifra mora imati:<br> Min. 15 znakova, a Max. 25 znakova<br>Jedno malo i jedno veliko slovo<br>Jedan broj<br>Bez razmaka<br>Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke";
        }
        else if(registracijaLozinka.value.startsWith('*')==true || registracijaLozinka.value.endsWith('*')==true){
            labelaLozinka.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeLozinkaGreska.innerHTML="Šifra mora imati:<br> Min. 15 znakova, a Max. 25 znakova<br>Jedno malo i jedno veliko slovo<br>Jedan broj<br>Bez razmaka<br>Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke";
        }
        
        else if(!registracijaLozinka.value.match(uzorak)){
            labelaLozinka.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeLozinkaGreska.innerHTML="Šifra mora imati:<br> Min. 15 znakova, a Max. 25 znakova<br>Jedno malo i jedno veliko slovo<br>Jedan broj<br>Bez razmaka<br>Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke";
        }
        else{
            labelaLozinka.style="color: rgb(242, 240, 234); ";
            registracijeLozinkaGreska.innerHTML="";
            registracijaGumb.disabled=false;
        }
    }

    else{
            labelaLozinka.style="color:red;";
            registracijaGumb.disabled=true;
            registracijeLozinkaGreska.innerHTML="Šifra mora imati:<br> Min. 15 znakova, a Max. 25 znakova<br>Jedno malo i jedno veliko slovo<br>Jedan broj<br>Bez razmaka<br>Dozvoljeni znakovi (=,*,/,%) ne smiju biti na početku ili na kraju lozinke";
    }

});


