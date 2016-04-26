<?php
namespace App\model;
use Nette\Object;


/**
 * ScopusParserClanku ziska soubor z databaze scopus, rozparsuje soubor a vrati seznam clanku z databaze Scopus
 *
 * @author Jan Cach
 */
class ScopusParserClanku extends Object implements IZiskaniClanku{
    
    /**
     * Funkce, ktera vrati url pro dotaz na clanek do databaze Scopus
     * @param string $vyraz vyraz pro ktery chceme hledat clanky
     * @return string url adresa
     */
    private function sestavURL($vyraz) {
        $url = 'http://api.elsevier.com/content/search/scopus?httpAccept=application/xml&'
                . 'query=("'.$vyraz.'")&start=0&count=50&view=complete'
                . '&apiKey=6492f9c867ddf3e84baa10b5971e3e3d';
        return $url;
    }
    
    
    /**
     * Funkce vrati soubor XML podle zadane URL
     * @param type $url cesta k souboru
     * @return asociativni pole pokud ziskany soubor je XML jinak vraci null
     */
    private function ziskejSouborXML($url) {
        $soubor = @simplexml_load_file($url);
        if ($soubor) {
        return $soubor;    
        }
        return null;
    }
    
    
    /**
     * Rozparsuje zadany soubor a vrati seznam clanku
     * @param XML $soubor
     * @param string $vyraz hledany vyraz
     * @return array() seznam Clanku
     */
    private function parsuj($soubor,$vyraz) {
        $seznamClanku = ''; 
        
        foreach ($soubor->entry as $s) {
            $date = $s->children('prism',TRUE)->coverDate;
            $datum = date_parse($date);
            $titulek = $s->children('dc',TRUE)->title;
            $abstrakt = $s->children('dc',TRUE)->description;
            $klicovaSlova = $s->authkeywords;
            $doi = $s->children('prism',TRUE)->doi;
            $id = $s->eid;
            $hodnoceni = Clanek::vypoctiHodnoceni($titulek, $klicovaSlova, $abstrakt, $vyraz);
            $seznamClanku [] =  
                    new Clanek((string)$titulek, 
                            (string)$abstrakt,
                            (string)$doi, 
                            (string)$s->children('prism',TRUE)->issn, 
                            (string)$s->children('dc',TRUE)->creator,
                            (string)$klicovaSlova,
                            (string)'Scopus',
                            (string)$datum['year'],
                            (string)$datum['month'],
                            $hodnoceni,
                            (string)$id);
                    
        }
        return $seznamClanku;
    
    }
    
    
    
    
    
    
    
    /**
     * Vrati seznam clanku pro zadany vyraz z databaze Scopus
     * @param string $vyraz hledany vyraz
     * @return array<Clanek> seznam clanku, v pripade chyby nebo zadnych vysledku vrati string error
     */
    public function vratSeznamClanku($vyraz) {
         if(!empty($vyraz)){
        $url = $this->sestavURL($vyraz);
       
        $soubor = $this->ziskejSouborXML($url);
        if(! empty($soubor)){
        $seznamClanku = $this->parsuj($soubor, $vyraz);
        return $seznamClanku;
        }
        }
        return 'error';
    }
    

}
