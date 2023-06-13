$(document).ready(function (){
   // alert("Dokument učitan!"); 
    naslov=$(document).find("title").text();

    console.log(naslov, typeof(naslov));


    switch (naslov) {
        case "Obrazac":
            $("#poruke").html("<p>Js program!</p>");
            let blok= $("<p>jQuery</p>");
            blok.append("<p>jQuery</p>");
            blok.append("<p>Autocomplete</p>");
            blok.append("<p>DataTables</p>");
            $("#poruke").html(blok);
            break;
            
        default:
            
            break;
    }
 });