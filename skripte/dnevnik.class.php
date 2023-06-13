<?php
class Dnevnik {
    
    private $nazivDatoteke = "izvorne_datoteke/dnevnik.log";
    
    public function setNazivDatoteke($nazivDatoteke) {
        $this->nazivDatoteke = $nazivDatoteke;
    }
        
    /**
     * Funkcija za dodavanje u dnevnik!
     * @param type $tekst
     * @param type $baza - koristi bazu
     */
    public function spremiDnevnik($tekst,$baza=false) {
        if($baza){
            //TODO spremi u bazu
        } else {
            $f = fopen($this->nazivDatoteke,"a+");
            fwrite($f, date("d.m.Y H:i:s")." ".$tekst."\n");
            fclose($f);
        }
    }
    
    public function citajDnevnik($baza=false){
        if($baza){
            //TODO spremi u bazu
        } else {
            return file($this->nazivDatoteke);
        }
    }
}
?>