document.addEventListener("DOMContentLoaded", loadanjeStranice())

function loadanjeStranice() {
    validacijaObrasca(); // Uvodni zadatak
    slijednoIspunjavanje();// 1. zadatak
    viselinijskiTextUnos();// 5. zadatak
    provjeraSlanja();// 6. zadatak
    checkboxZadatak();// 4. zadatak
}
// 2. zadatak i 3. zadatak se nalaze u sklopu gore navedenih funkcija
// 7. zadatak nije realiziran

var poruke=document.getElementById("poruke");

var zastavicaProvjereNaslova = false;
var zastavicaProvjereCheckboxa = false;
var zastavicaProvjereSadrzaja = false;
var zastavicaProvjereEmailaPrimatelja = false;
var zastavicaProvjereEmailaPosiljatelja = false;


var zastavicaNaslova = false;
var zastavicaEmaila = false;
var zastavicaEmailaPosiljatelja = false;
var zastavicaCheckboxeva = false;
var zastavicaSadrzaja = false;
var zastavicaPriloga = false;
var zastavicaDatuma = false;

//Zastavice za mail primatelja
var zastavicaProvjereEmailaPrimatelja_Korisnik = false;
var zastavicaProvjereEmailaPrimatelja_NazivDomene = false;
var zastavicaProvjereEmailaPrimatelja_VrstaDomene = false;

//Zastavice za mail pošiljatelja
var zastavicaProvjereEmailaPosiljatelja_Korisnik = false;
var zastavicaProvjereEmailaPosiljatelja_NazivDomene = false;
var zastavicaProvjereEmailaPosiljatelja_VrstaDomene = false;


//Zastavice za 1. zadatak //
var slijedniNaslov = false;
var slijedniEmail = false;
var slijedniEmailPosiljatelja = false;
var slijedniCheckbox = false;
var slijedniSadrzaj = false;
var slijedniFile = false;
var slijedniDatum = false;
var slijedniRange = false;
var slijedniBoja = false;


//Validacija obrasca//

function validacijaObrasca() {

    console.log("Ulazak u js obrasca");

    
    var zastavicaSlanjaObrasca = false;

    obrazac = document.getElementById("obrazac-forma");

    greske = document.getElementById("greske");

    gumbPosalji = document.getElementById("submit");

    gumbPosalji.disabled = true;

    if (zastavicaSlanjaObrasca == true) {
        gumbPosalji.disabled = false;
    }
    console.log("Zastavica slanja obrasca je: "+zastavicaSlanjaObrasca);
    obrazac.addEventListener("submit", function (event) {
        greske.innerHTML = "";
        
        //console.log(obrazac.length);
       // provjeraNaslova(); 
        /*for (i = 0; i < obrazac.length; i++) {
            if (obrazac[i].value === "" && obrazac[i].name !== "gumb") {
                obrazac[i].style = "border-color:red";
                greske.innerHTML += "Nije ispunjeno: " + obrazac[i].name + "<br>";
                console.log(zastavicaProvjereNaslova);

            }

            else {
                obrazac[i].style = "border-color:none";
            }

        }*/;
        /*if (zastavicaProvjereNaslova == true) {
            greske.innerHTML += "U naslovu je unesen krivi znak" + "<br>";
        }*/
        
        if (zastavicaSlanjaObrasca == true) {
            gumbPosalji.disabled = false;
            if (gumbPosalji.disabled == false) {
                event.preventDefault();
            }

        }
    }, false);

}



//1. Zadatak //

function slijednoIspunjavanje() {
    
    var provjeriUnoseGumb = document.getElementById("gumb-provjera")
    var gumbDalje = document.getElementById("gumb-dalje");

    provjeriUnoseGumb.disabled = true;
    provjeriUnoseGumb.style="color:gray";
    provjeriUnoseGumb.style="background-color:black";


    var labela_naslov = document.getElementById("labela-naslov");
    var labela_obrazac_email = document.getElementById("labela-obrazac-email");
    var labela_obrazac_email_posiljatelj = document.getElementById("labela-obrazac-email-posiljatelj");
    var labela_checkbox = document.getElementById("labela-checkbox");
    var labela_pristigla = document.getElementById("pristigla-labela");
    var labela_poslana = document.getElementById("poslana-labela");
    var labela_nacrt = document.getElementById("nacrt-labela");
    var labela_smece = document.getElementById("smece-labela");
    var labela_nezeljena = document.getElementById("nezeljena-labela");
    var labela_vazno = document.getElementById("vazno-labela");
    var labela_obrazac_sadrzaj = document.getElementById("labela-obrazac-sadrzaj");
    var obrazac_file = document.getElementById("labela-obrazac-file");
    var obrazac_datum = document.getElementById("labela-obrazac-datum");
    var obrazac_range = document.getElementById("labela-obrazac-range");
    var obrazac_boja = document.getElementById("labela-obrazac-boja")

    var elementNaslov = document.getElementById("naslov");
    var elementEmail = document.getElementById("obrazac-email");
    var elementEmailPosiljatelja = document.getElementById("obrazac-email-posiljatelj");
    /*var elementPristigla=document.getElementById("pristigla");
    var elementPoslana=document.getElementById("poslana");
    var elementNacrt=document.getElementById("nacrt");
    var elementSmece=document.getElementById("smece");
    var elementNezeljena=document.getElementById("nezeljena");
    var elementVazno=document.getElementById("vazno");*/

    var checkboxes = document.querySelectorAll(".tip-poruke");
    var labela_checkbox = document.getElementById("labela-checkbox");
    var pristigla = document.getElementById("pristigla-labela");
    var poslana = document.getElementById("poslana-labela");
    var nacrt = document.getElementById("nacrt-labela");
    var smece = document.getElementById("smece-labela");
    var nezeljena = document.getElementById("nezeljena-labela");
    var vazno = document.getElementById("vazno-labela");

    var elementSadrzaj = document.getElementById("obrazac-sadrzaj");
    var elementFile = document.getElementById("obrazac-file");
    var elementDatum = document.getElementById("obrazac-datum");
    var checkboxevi = document.getElementById("checkboxevi");
    var elementRange = document.getElementById("obrazac-range");
    var elementBoje = document.getElementById("obrazac-boja");
    gumbPosalji.disabled = true;

    var gumbNaslov = document.getElementById("naslov-gumb");
    var gumbEmail = document.getElementById("email-gumb");
    var gumbEmailPosiljatelj = document.getElementById("email-gumb-posiljatelj");
    var gumbCheckboxes = document.getElementById("gumb-checkboxes");
    var gumbSadrzaj = document.getElementById("gumb-sadrzaj");
    var gumbFile = document.getElementById("gumb-file");
    var gumbDatum = document.getElementById("gumb-datum");

    gumbNaslov.style.visibility = "hidden";
    gumbEmail.style.visibility = "hidden";
    gumbEmailPosiljatelj.style.visibility = "hidden";
    gumbCheckboxes.style.visibility = "hidden";
    gumbSadrzaj.style.visibility = "hidden";
    gumbFile.style.visibility = "hidden";
    gumbDatum.style.visibility = "hidden";

    labela_obrazac_email.style.visibility = "hidden";
    labela_obrazac_email_posiljatelj.style.visibility = "hidden";
    labela_checkbox.style.visibility = "hidden";
    labela_pristigla.style.visibility = "hidden";
    labela_obrazac_sadrzaj.style.visibility = "hidden";
    obrazac_file.style.visibility = "hidden";
    obrazac_datum.style.visibility = "hidden";
    obrazac_range.style.visibility = "hidden";
    obrazac_boja.style.visibility = "hidden";

    elementEmail.style.visibility = "hidden";
    elementEmailPosiljatelja.style.visibility = "hidden";
    checkboxevi.style.visibility = "hidden";
    elementSadrzaj.style.visibility = "hidden";
    elementFile.style.visibility = "hidden";
    elementDatum.style.visibility = "hidden";
    elementRange.style.visibility = "hidden";
    elementBoje.style.visibility = "hidden";
    var broj_checkiranih = 0;

    

    for (var checkbox of checkboxes) {
        if (checkbox.type == "checkbox") {
            for (i = 0; i < checkboxes.length; i++) {
                if (checkbox.name == "pristigla") {
                    pristigla.style.visibility = "hidden";
                }
                else if (checkbox.name == "poslana") {
                    poslana.style.visibility = "hidden";
                }
                else if (checkbox.name == "nacrt") {
                    nacrt.style.visibility = "hidden";
                }
                else if (checkbox.name == "smece") {
                    smece.style.visibility = "hidden";
                }
                else if (checkbox.name == "nezeljena") {
                    nezeljena.style.visibility = "hidden";
                }
                else if (checkbox.name == "vazno") {
                    vazno.style.visibility = "hidden";
                }
            }
        }
    }

alert("U polje na obrascu upišite vrijednost te pritisnite gumb DALJE. Kasnije sva polja provjerite gumbom PROVJERI UNOSE! Obrazac se ne može poslati prije nego su svi elementi provjereni!");

    gumbDalje.addEventListener("click", function () {
        
        for (i = 0; i < obrazac.length; i++) {

            if (obrazac[i].name == "Naslov") {

                if (obrazac[i].value == "") {
                   // console.log("Naslov je prazan");

                    slijedniNaslov = false;

                }
                else {
                    if(zastavicaProvjereNaslova==true){
                        gumbPosalji.disabled=true;
                    }
                    else{
                        labela_obrazac_email.style.visibility = "visible";
                    elementEmail.style.visibility = "visible";
                    labela_naslov.style = "color:none";
                    slijedniNaslov = true;
                    }
                    
                }


            }
            else if (obrazac[i].name === "Email primatelja" && slijedniNaslov == true) {

                if (obrazac[i].value == "") {
                   // console.log("Prazan Email");
                    slijedniEmail = false;

                }
                else {
                    //console.log("Nije prazan");
                    labela_obrazac_email_posiljatelj.style.visibility = "visible";
                    elementEmailPosiljatelja.style.visibility = "visible";
                    slijedniEmail = true;
                }


            }
            else if (obrazac[i].name === "Email pošiljatelja" && slijedniEmail == true) {

                if (obrazac[i].value == "") {
                   // console.log("Prazan Email");
                    slijedniEmailPosiljatelja = false;
                }
                else if (obrazac[i].value !== "") {
                    console.log("Nije prazan");
                    slijedniEmailPosiljatelja = true;
                }

            }

            else if (obrazac[i].type === "checkbox" && slijedniEmailPosiljatelja == true) {
               // console.log("checkbox je");
                labela_checkbox.style.visibility = "visible";
                obrazac[i].style.visibility = "visible";
                labela_pristigla.style.visibility = "visible";
                labela_poslana.style.visibility = "visible";
                labela_nacrt.style.visibility = "visible";
                labela_smece.style.visibility = "visible";
                labela_nezeljena.style.visibility = "visible";
                labela_vazno.style.visibility = "visible";

                if (obrazac[i].checked == true) {
                    broj_checkiranih++;
                   // console.log(broj_checkiranih);
                    slijedniCheckbox = false;
                }
                else if (broj_checkiranih < 1) {
                    slijedniCheckbox = false;
                }
                else  {
                    slijedniCheckbox = true;
                    labela_obrazac_sadrzaj.style.visibility = "visible";
                    elementSadrzaj.style.visibility = "visible";
                }
            }

            else if(obrazac[i].name === "Sadržaj" && slijedniCheckbox == true){
                if(obrazac[i].value == ""){
                    slijedniSadrzaj=false;
                }
                else{
                    slijedniSadrzaj=true;
                    elementFile.style.visibility = "visible";
                    obrazac_file.style.visibility = "visible";
                }
            }
            else if(obrazac[i].name === "file" && slijedniSadrzaj == true){
                if(obrazac[i].value == ""){
                    slijedniFile=false;
                }
                else{
                    slijedniFile=true;
                    elementDatum.style.visibility = "visible";
                    obrazac_datum.style.visibility = "visible";
                }
            }
            else if(obrazac[i].name === "Datum i vrijeme" && slijedniFile == true){
                if(obrazac[i].value == ""){
                    slijedniDatum=false;
                }
                else{
                    slijedniDatum=true;
                    elementRange.style.visibility = "visible";
                    obrazac_range.style.visibility = "visible";
                }
            }
            else if(obrazac[i].name === "obrazac-raspon" && slijedniDatum == true){
                    slijedniRange=false;
                    obrazac_boja.style.visibility = "visible";
                    elementBoje.style.visibility = "visible";
                    provjeriUnoseGumb.disabled=false;
                    provjeriUnoseGumb.style="color: white";
                    provjeriUnoseGumb.style="background-color: #4CAF50"
            }
        }

    })
}

// 2. Zadatak //
//Nalazi se  funkciji validacija obrasca//

function provjeraNaslova() {

    
    var naslov = document.getElementById("naslov");


    if (naslov.value.includes("+") == true) {
        alert("Naslov sadrži nedozvoljeni znak");
        gumbPosalji.disabled=true;
        zastavicaProvjereNaslova = true;
        zastavicaNaslova = false;
    }

    else if (naslov.value.includes("%") == true) {
        alert("Naslov sadrži nedozvoljeni znak");
        gumbPosalji.disabled=true;
        zastavicaProvjereNaslova = true;
        zastavicaNaslova = false;
    }

    else if (naslov.value.includes("'") == true) {
        alert("Naslov sadrži nedozvoljeni znak");
        gumbPosalji.disabled=true;
        zastavicaProvjereNaslova = true;
        zastavicaNaslova = false;
    }

    else if (naslov.value.includes("\"") == true) {
        alert("Naslov sadrži nedozvoljeni znak");
        gumbPosalji.disabled=true;
        zastavicaProvjereNaslova = true;
        zastavicaNaslova = false;
    }
    else {
        gumbPosalji.disabled=false;
        zastavicaProvjereNaslova = false;
        zastavicaNaslova = false;
    }

}


// 3. Zadatak //

function provjeraPrimatelj() {

    var emailPrimatelj = document.getElementById("obrazac-email");

    if (emailPrimatelj.value.includes("@") == true) {

       // console.log("Dobro je");
        var prvi_dio = emailPrimatelj.value.split("@");
        var korisnik = prvi_dio[0];
        var domena = prvi_dio[1];//Provjera za ispis domene
        var domena_razdvojak = prvi_dio[1].split(".");
        var naziv_domene = domena_razdvojak[0];
        var vrsta_domene = domena_razdvojak[1];

        provjeraKorisnika(korisnik);
        provjeraNazivaDomene(naziv_domene);
        provjeraVrsteDomene(vrsta_domene);

        if (zastavicaProvjereEmailaPrimatelja_Korisnik == true &&
            zastavicaProvjereEmailaPrimatelja_NazivDomene == true &&
            zastavicaProvjereEmailaPrimatelja_VrstaDomene == true) {
            zastavicaProvjereEmailaPrimatelja = true;
        }
        else {
            zastavicaProvjereEmailaPrimatelja = false;
        }


    }

    else {
        alert("Mail nije u dobrom formatu");
        alert("Email primatelja nije u dobrom formatu");
        zastavicaProvjereEmailaPrimatelja = false;
    }

    //console.log("Mail zastavica je: " + zastavicaProvjereEmailaPrimatelja);
}

function provjeraKorisnika(korisnik) {

    if (korisnik.length > 0 && korisnik.length < 64) {
       // console.log(korisnik);
       // console.log(korisnik);
        if (korisnik.startsWith(".") == true && korisnik.endsWith(".") == true) {
            alert("Email primatelja nije u dobrom formatu");

            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPrimatelja_Korisnik = false;
        }
        else if (korisnik.startsWith("_") == true && korisnik.endsWith("_") == true) {
           // console.log("Ne moze startati s _");
            alert("Email primatelja nije u dobrom formatu");
            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPrimatelja_Korisnik = false;
        }
        else if (korisnik.startsWith("-") == true && korisnik.endsWith("-") == true) {
           // console.log("Ne moze startati s -");
            alert("Email primatelja nije u dobrom formatu");
            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPrimatelja_Korisnik = false;
        }
        else if (korisnik.startsWith("+") == true && korisnik.endsWith("+") == true) {
           // console.log("Ne moze startati s +");
            alert("Email primatelja nije u dobrom formatu");
            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPrimatelja_Korisnik = false;
        }
        else {

            gumbPosalji.disabled = false;
            zastavicaProvjereEmailaPrimatelja_Korisnik = true;
        }
    }

    
}

function provjeraNazivaDomene(naziv_domene) {

    if (naziv_domene.length !== 0) {

        //console.log("Naziv domene je tu")
       // console.log(naziv_domene);

        if (naziv_domene.length < 253) {

            if (naziv_domene.startsWith(".") == true && naziv_domene.endsWith(".") == true) {
               // console.log("Naziv domene ne moze startati s .");
                alert("Email primatelja nije u dobrom formatu");
                zastavicaProvjereEmailaPrimatelja_NazivDomene = false;
            }
            else if (naziv_domene.startsWith("-") == true && naziv_domene.endsWith("-") == true) {
               // console.log("Naziv domene ne moze startati s -");
                alert("Email primatelja nije u dobrom formatu");
                zastavicaProvjereEmailaPrimatelja_NazivDomene = false;
            }
            else if (naziv_domene.includes("+") == true || naziv_domene.includes("_") == true) {
               // console.log("Naziv domene sadrzi krive znakove");
                alert("Naziv domene sadrzi krive znakove");
                zastavicaProvjereEmailaPrimatelja_NazivDomene = false;
            }
            else {
                zastavicaProvjereEmailaPrimatelja_NazivDomene = true;
            }

        }

    }
    else {
       // console.log("Naziv domene nije tu");
        alert("Naziv domene nije tu");
        zastavicaProvjereEmailaPrimatelja_NazivDomene = false;
    }
   // console.log("Zastavica naziva domene je: " + zastavicaProvjereEmailaPrimatelja_NazivDomene);
}


function provjeraVrsteDomene(vrsta_domene) {

    if (vrsta_domene !== 0) {
       // console.log("Vrsta domene je tu")


        if (vrsta_domene === "com" || vrsta_domene === "hr" || vrsta_domene === "info") {
          //  console.log("Vrsta domene je ok");
            zastavicaProvjereEmailaPrimatelja_VrstaDomene = true;
        }
        else {
           // console.log("Vrsta domene nije ok");
            alert("Vrsta domene nije ok");
            zastavicaProvjereEmailaPrimatelja_VrstaDomene = false;
        }

    }
    else {
       // console.log("Vrsta domene nije tu")
        zastavicaProvjereEmailaPrimatelja = false;
    }

   // console.log("Zastavica vrste domene je: " + zastavicaProvjereEmailaPrimatelja_VrstaDomene);
}


function provjeraPosiljatelj() {
    var emailPosiljatelj = document.getElementById("obrazac-email-posiljatelj");

    if (emailPosiljatelj.value.includes("@") == true) {

       // console.log("Dobro je");
        var prvi_dio = emailPosiljatelj.value.split("@");
        var korisnik = prvi_dio[0];
        var domena = prvi_dio[1];//Provjera za ispis domene
        var domena_razdvojak = prvi_dio[1].split(".");
        var naziv_domene = domena_razdvojak[0];
        var vrsta_domene = domena_razdvojak[1];

        provjeraKorisnikaPosiljatelja(korisnik);
        provjeraNazivaDomenePosiljatelja(naziv_domene);
        provjeraVrsteDomenePosiljatelja(vrsta_domene);

        if (zastavicaProvjereEmailaPosiljatelja_Korisnik == true &&
            zastavicaProvjereEmailaPosiljatelja_NazivDomene == true &&
            zastavicaProvjereEmailaPosiljatelja_VrstaDomene == true) {
            zastavicaProvjereEmailaPosiljatelja = true;
        }
        else {
            zastavicaProvjereEmailaPosiljatelja = false;
        }


    }

    else {
        alert("Mail nije u dobrom formatu");
        zastavicaProvjereEmailaPosiljatelja = false;
    }

   // console.log("Mail posiljatelj zastavica je: " + zastavicaProvjereEmailaPosiljatelja);
}

function provjeraKorisnikaPosiljatelja(korisnik) {

    if (korisnik.length > 0 && korisnik.length < 64) {
       // console.log(korisnik);
       // console.log(korisnik);
        if (korisnik.startsWith(".") == true && korisnik.endsWith(".") == true) {


            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPosiljatelja_Korisnik = false;
        }
        else if (korisnik.startsWith("_") == true && korisnik.endsWith("_") == true) {
           // console.log("Ne moze startati s _");
            alert("Email pošiljatelja nije u dobrom formatu");
            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPosiljatelja_Korisnik = false;
        }
        else if (korisnik.startsWith("-") == true && korisnik.endsWith("-") == true) {
           // console.log("Ne moze startati s -");
            alert("Email pošiljatelja nije u dobrom formatu");
            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPosiljatelja_Korisnik = false;
        }
        else if (korisnik.startsWith("+") == true && korisnik.endsWith("+") == true) {
           // console.log("Ne moze startati s +");
            alert("Email pošiljatelja nije u dobrom formatu");
            gumbPosalji.disabled = true;
            zastavicaProvjereEmailaPosiljatelja_Korisnik = false;
        }
        else {

            gumbPosalji.disabled = false;
            zastavicaProvjereEmailaPosiljatelja_Korisnik = true;
        }
    }

   // console.log("Zastavica korisnika posiljatelja je: " + zastavicaProvjereEmailaPosiljatelja_Korisnik);
}

function provjeraNazivaDomenePosiljatelja(naziv_domene) {

    if (naziv_domene.length !== 0) {

        //console.log("Naziv domene je tu")
       // console.log(naziv_domene);

        if (naziv_domene.length < 253) {

            if (naziv_domene.startsWith(".") == true && naziv_domene.endsWith(".") == true) {
                //console.log("Naziv domene ne moze startati s .");
                alert("Email pošiljatelja nije u dobrom formatu");
                zastavicaProvjereEmailaPosiljatelja_NazivDomene = false;
            }
            else if (naziv_domene.startsWith("-") == true && naziv_domene.endsWith("-") == true) {
               // console.log("Naziv domene ne moze startati s -");
                alert("Email pošiljatelja nije u dobrom formatu");
                zastavicaProvjereEmailaPosiljatelja_NazivDomene = false;
            }
            else if (naziv_domene.includes("+") == true || naziv_domene.includes("_") == true) {
                //console.log("Naziv domene sadrzi krive znakove");
                alert("Email pošiljatelja nije u dobrom formatu");
                zastavicaProvjereEmailaPosiljatelja_NazivDomene = false;
            }
            else {
                zastavicaProvjereEmailaPosiljatelja_NazivDomene = true;
            }

        }

    }
    else {
       // console.log("Naziv domene nije tu");
        zastavicaProvjereEmailaPosiljatelja_NazivDomene = false;
    }
    //console.log("Zastavica naziva domene je: " + zastavicaProvjereEmailaPosiljatelja_NazivDomene);
}


function provjeraVrsteDomenePosiljatelja(vrsta_domene) {

    if (vrsta_domene !== 0) {
       // console.log("Vrsta domene je tu")


        if (vrsta_domene === "com" || vrsta_domene === "hr" || vrsta_domene === "info") {
           // console.log("Vrsta domene je ok");
            zastavicaProvjereEmailaPosiljatelja_VrstaDomene = true;
        }
        else {
          //  console.log("Vrsta domene nije ok");
            alert("Vrsta domene nije ok");
            zastavicaProvjereEmailaPosiljatelja_VrstaDomene = false;
        }

    }
    else {
       // console.log("Vrsta domene nije tu")
        zastavicaProvjereEmailaPosiljatelja_VrstaDomene = false;
    }

   // console.log("Zastavica vrste domene je: " + zastavicaProvjereEmailaPosiljatelja_VrstaDomene);
}

//4. Zadatak //


function checkboxZadatak() {

    var broj_oznacenih = 2;

    var checkboxes = document.querySelectorAll(".tip-poruke");

    var pristigla = document.getElementById("pristigla-labela");
    var poslana = document.getElementById("poslana-labela");
    var nacrt = document.getElementById("nacrt-labela");
    var smece = document.getElementById("smece-labela");
    var nezeljena = document.getElementById("nezeljena-labela");
    var vazno = document.getElementById("vazno-labela");

    for (var checkbox of checkboxes) {
        if (checkbox.type == "checkbox") {


            for (i = 0; i < checkboxes.length; i++) {
                if (checkbox.checked == true) {
                    if (checkbox.name == "pristigla") {
                        pristigla.style = "font-weight: bold";
                    }
                    else if (checkbox.name == "poslana") {
                        poslana.style = "font-weight: bold";
                    }
                    else if (checkbox.name == "nacrt") {
                        nacrt.style = "font-weight: bold";
                    }
                    else if (checkbox.name == "smece") {
                        smece.style = "font-weight: bold";
                    }
                    else if (checkbox.name == "nezeljena") {
                        nezeljena.style = "font-weight: bold";
                    }
                    else if (checkbox.name == "vazno") {
                        vazno.style = "font-weight: bold";
                    }
                }


            }

            checkbox.addEventListener("change", function () {

                if (this.checked == true) {
                   // console.log(this.value);
                    broj_oznacenih++;

                    zastavicaProvjereCheckboxa = false;

                    if (this.name == "pristigla") {
                        pristigla.style = "font-weight: bold";
                    }
                    else if (this.name == "poslana") {
                        poslana.style = "font-weight: bold";
                    }
                    else if (this.name == "nacrt") {
                        nacrt.style = "font-weight: bold";
                    }
                    else if (this.name == "smece") {
                        smece.style = "font-weight: bold";
                    }
                    else if (this.name == "nezeljena") {
                        nezeljena.style = "font-weight: bold";
                    }
                    else if (this.name == "vazno") {
                        vazno.style = "font-weight: bold";
                    }
                }
                else {

                    broj_oznacenih--;





                    if (this.name == "pristigla") {
                        pristigla.style = "color:none";
                        if (broj_oznacenih < 1) {
                            alert("Barem jedan tip poruke mora biti označen!")
                            zastavicaProvjereCheckboxa = true;
                            gumbPosalji.disabled = true;
                            //Postavljanje zastavice da nije nijedan označen
                        }

                    }
                    else if (this.name == "poslana") {
                        poslana.style = "color:none";
                        if (broj_oznacenih < 1) {
                            alert("Barem jedan tip poruke mora biti označen!")
                            zastavicaProvjereCheckboxa = true;
                            gumbPosalji.disabled = true;
                            //Postavljanje zastavice da nije nijedan označen
                        }

                    }
                    else if (this.name == "nacrt") {
                        nacrt.style = "color:none";
                        if (broj_oznacenih < 1) {
                            alert("Barem jedan tip poruke mora biti označen!")
                            zastavicaProvjereCheckboxa = true;
                            gumbPosalji.disabled = true;
                            //Postavljanje zastavice da nije nijedan označen
                        }

                    }
                    else if (this.name == "smece") {
                        smece.style = "color:none";
                        if (broj_oznacenih < 1) {
                            alert("Barem jedan tip poruke mora biti označen!")
                            zastavicaProvjereCheckboxa = true;
                            gumbPosalji.disabled = true;
                            //Postavljanje zastavice da nije nijedan označen
                        }

                    }
                    else if (this.name == "nezeljena") {
                        nezeljena.style = "color:none";
                        if (broj_oznacenih < 1) {
                            alert("Barem jedan tip poruke mora biti označen!")
                            zastavicaProvjereCheckboxa = true;
                            gumbPosalji.disabled = true;
                            //Postavljanje zastavice da nije nijedan označen
                        }

                    }
                    else if (this.name == "vazno") {
                        vazno.style = "color:none";
                        if (broj_oznacenih < 1) {
                            alert("Barem jedan tip poruke mora biti označen!")
                            zastavicaProvjereCheckboxa = true;
                            gumbPosalji.disabled = true;
                            //Postavljanje zastavice da nije nijedan označen
                        }

                    }
                }

            })
        }

    }
}


//5. Zadatak //

function viselinijskiTextUnos() {

    var textArea = document.getElementById("obrazac-sadrzaj");

    textArea.addEventListener("focusout", function () {

        if (textArea.value.length < 50) {
            alert("Textarea ima manje od 50 znakova");
            gumbPosalji.disabled = true;
            zastavicaProvjereSadrzaja = true;
        }
        else {
            zastavicaProvjereSadrzaja = false;
        }
        for (i = 0; i < textArea.value.length; i++) {

            if (textArea.value.includes("<") == true) {
                var originalniText = textArea.value;
                var noviText = originalniText.replace('<', '');
                textArea.value = noviText;

            }
            else if (textArea.value.includes(">") == true) {
                var originalniText = textArea.value;
                var noviText = originalniText.replace('>', '');
                textArea.value = noviText;

            }
        }
    })
}

//6. Zadatak //

function provjeraSlanja() {



    var provjeriUnoseGumb = document.getElementById("gumb-provjera")

    var pritisnutGumb = false;

    var labela_naslov = document.getElementById("labela-naslov");
    var labela_obrazac_email = document.getElementById("labela-obrazac-email");
    var labela_obrazac_email_posiljatelj = document.getElementById("labela-obrazac-email-posiljatelj");
    var labela_checkbox = document.getElementById("labela-checkbox");
    var labela_obrazac_sadrzaj = document.getElementById("labela-obrazac-sadrzaj");
    var obrazac_file = document.getElementById("labela-obrazac-file");
    var obrazac_datum = document.getElementById("labela-obrazac-datum");

    var gumbNaslov = document.getElementById("naslov-gumb");
    var gumbEmail = document.getElementById("email-gumb");
    var gumbEmailPosiljatelj = document.getElementById("email-gumb-posiljatelj");
    var gumbCheckboxes = document.getElementById("gumb-checkboxes");
    var gumbSadrzaj = document.getElementById("gumb-sadrzaj");
    var gumbFile = document.getElementById("gumb-file");
    var gumbDatum = document.getElementById("gumb-datum");

    gumbNaslov.style.visibility = "hidden";
    gumbEmail.style.visibility = "hidden";
    gumbEmailPosiljatelj.style.visibility = "hidden";
    gumbCheckboxes.style.visibility = "hidden";
    gumbSadrzaj.style.visibility = "hidden";
    gumbFile.style.visibility = "hidden";
    gumbDatum.style.visibility = "hidden";

    provjeriUnoseGumb.addEventListener("click", function () {

        pritisnutGumb = true;

        var greske = 0;

        for (i = 0; i < obrazac.length; i++) {

            if (obrazac[i].value === "" && obrazac[i].name !== "gumb") {

                greske++

            }


            if (obrazac[i].name === "Naslov") {
                provjeraNaslova();
                gumbNaslov.style.visibility = "hidden";
                if (obrazac[i].value === '') {
                    greske++;
                    labela_naslov.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);

                }

                else if (zastavicaProvjereNaslova == true) {
                    greske++;
                    labela_naslov.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }

                else {

                    zastavicaNaslova = true;
                    gumbPosalji.disabled=false;           
                    labela_naslov.style = "color:none";
                    gumbNaslov.style.visibility = "hidden";
                }
            }

            else if (obrazac[i].name === "Email primatelja") {

                gumbEmail.style.visibility = "hidden";
                if (obrazac[i].value === '') {
                    greske++;
                    labela_obrazac_email.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }
                else {
                    provjeraPrimatelj();
                    if (zastavicaProvjereEmailaPrimatelja == true) {
                        zastavicaEmaila = true;
                        labela_obrazac_email.style = "color:none";
                        gumbEmail.style.visibility = "hidden";
                    }
                    else {
                        greske++;
                        labela_obrazac_email.style = "color:red";
                        gumbPosalji.disabled = true;
                        otvaranjeGumbaIspravi(obrazac[i]);
                    }

                }
            }

            else if (obrazac[i].name === "Email pošiljatelja") {
                gumbEmailPosiljatelj.style.visibility = "hidden";
                if (obrazac[i].value === '') {
                    greske++;
                    labela_obrazac_email_posiljatelj.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }
                else {
                    provjeraPosiljatelj();
                    if (zastavicaProvjereEmailaPosiljatelja == true) {
                        zastavicaEmailaPosiljatelja = true;
                        labela_obrazac_email_posiljatelj.style = "color:none";
                        gumbEmailPosiljatelj.style.visibility = "hidden";
                    }
                    else {
                        greske++;
                        labela_obrazac_email_posiljatelj.style = "color:red";
                        gumbPosalji.disabled = true;
                        otvaranjeGumbaIspravi(obrazac[i]);
                    }

                }
            }
            else if (obrazac[i].type === "checkbox") {
                gumbCheckboxes.style.visibility = "hidden";
                if (zastavicaProvjereCheckboxa == true) {
                    greske++;
                    labela_checkbox.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }
                else {
                    zastavicaCheckboxeva = true;
                    labela_checkbox.style = "color:none";
                    gumbCheckboxes.style.visibility = "hidden";
                }
            }
            else if (obrazac[i].name === "Sadržaj") {
                gumbSadrzaj.style.visibility = "hidden";
                if (obrazac[i].value === '') {
                    greske++;
                    labela_obrazac_sadrzaj.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }
                else {
                    if (zastavicaProvjereSadrzaja == true) {
                        greske++;
                        labela_obrazac_sadrzaj.style = "color:red";
                        gumbPosalji.disabled = true;
                        otvaranjeGumbaIspravi(obrazac[i]);
                    }
                    else {
                        zastavicaSadrzaja = true;
                        labela_obrazac_sadrzaj.style = "color:none";
                        gumbSadrzaj.style.visibility = "hidden";
                    }
                }
            }
            else if (obrazac[i].name === "file") {
                gumbFile.style.visibility = "hidden";
                if (obrazac[i].value === '') {
                    greske++;
                    obrazac_file.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }
                else {
                    zastavicaPriloga = true;
                    obrazac_file.style = "color:none";
                    gumbFile.style.visibility = "hidden";
                }
            }
            else if (obrazac[i].name === "Datum i vrijeme") {
                gumbDatum.style.visibility = "hidden";
                if (obrazac[i].value === '') {
                    greske++;
                    obrazac_datum.style = "color:red";
                    gumbPosalji.disabled = true;
                    otvaranjeGumbaIspravi(obrazac[i]);
                }
                else {
                    zastavicaDatuma = true;
                    obrazac_datum.style = "color:none";
                    gumbDatum.style.visibility = "hidden";
                }
            }
        }
        if (greske == 0 && pritisnutGumb == true) {
            console.log("Nema greški");
            zastavicaSlanjaObrasca = true;
            gumbPosalji.disabled = false;
        }
        else{
            zastavicaSlanjaObrasca = false;
            gumbPosalji.disabled = true;
        }
    })
}

function otvaranjeGumbaIspravi(vrijednost) {
    if (vrijednost.name === "Naslov") {
        var gumbNaslov = document.getElementById("naslov-gumb");
        gumbNaslov.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbNaslov.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaNaslova = false;
            event.preventDefault();
        })
    }
    else if (vrijednost.name === "Email primatelja") {
        var gumbEmail = document.getElementById("email-gumb");
        gumbEmail.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbEmail.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaEmaila = false;
            event.preventDefault();
        })
    }
    else if (vrijednost.name === "Email pošiljatelja") {
        var gumbEmailPosiljatelj = document.getElementById("email-gumb-posiljatelj");
        gumbEmailPosiljatelj.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbEmailPosiljatelj.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaEmailaPosiljatelja = false;
            event.preventDefault();
        })
    }
    else if (vrijednost.type === "checkbox") {
        var gumbCheckboxes = document.getElementById("gumb-checkboxes");
        gumbCheckboxes.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbCheckboxes.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaCheckboxeva = false;
            event.preventDefault();
        })
    }
    else if (vrijednost.name === "Sadržaj") {
        var gumbSadrzaj = document.getElementById("gumb-sadrzaj");
        gumbSadrzaj.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbSadrzaj.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaSadrzaja = false;
            event.preventDefault();
        })
    }
    else if (vrijednost.name === "file") {
        var gumbFile = document.getElementById("gumb-file");
        gumbFile.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbFile.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaPriloga = false;
            event.preventDefault();
        })
    }
    else if (vrijednost.name === "Datum i vrijeme") {
        var gumbDatum = document.getElementById("gumb-datum");
        gumbDatum.style.visibility = "visible";
        vrijednost.disabled = true;
        gumbDatum.addEventListener("click", function (event) {
            vrijednost.disabled = false;
            zastavicaDatuma = false;
            event.preventDefault();
        })
    }
}



