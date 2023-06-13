var gumbEuri = document.getElementById('gumb-placanje-euri');
var gumbBodovi = document.getElementById('gumb-placanje-bodovi');
var formaEuri = document.getElementById('forma-euri');
var formaBodovi = document.getElementById('forma-bodovi');
var gumbPlatiEurima=document.getElementById('plati-eurima');
var gumbPlatiBodovima=document.getElementById('plati-bodovima');
var kupacPlacaEuri=document.getElementById('placanje-euri');
var kupacPlacaBodovi=document.getElementById('placanje-bodovi');
var cijenaProizvodaEuri=document.getElementById('cijena-proizvoda-euri');
var cijenaProizvodaBodovi=document.getElementById('cijena-proizvoda-bodovi');

formaEuri.style.display = 'none'
formaBodovi.style.display = 'none'

gumbEuri.addEventListener('click', () => {
  
    formaBodovi.style.display = 'none'

  if (formaEuri.style.display === 'none') {
    
    formaEuri.style.display = 'block';
    formaBodovi.style.display = 'none'
    
  } else {
    
    formaEuri.style.display = 'none';
    
  }
});

gumbBodovi.addEventListener('click', () => {
  
    formaEuri.style.display = 'none'

  if (formaBodovi.style.display === 'none') {
    
    formaBodovi.style.display = 'block';
    formaEuri.style.display = 'none'
  } else {
    
    formaBodovi.style.display = 'none';
    
  }
});



