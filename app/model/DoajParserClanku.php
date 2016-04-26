<?php
namespace App\model;
use Nette\Object;
/**
 * DoajParserClanku ziska soubor z databaze doaj, rozparsuje soubor a vrati seznam clanku z databaze DOAJ
 *
 * @author Jan Cach
 */
class DoajParserClanku extends Object implements IZiskaniClanku{
    
    /**
     * Funkce, ktera vrati url pro dotaz na clanek do databaze DOAJ
     * @param string $vyraz vyraz pro ktery chceme hledat clanky
     * @return string url adresa
     */
    private function sestavURL($vyraz) {
        $url = 'https://doaj.org/api/v1/search/articles/'.$vyraz.'?pageSize=50';
        return $url;
    }
    
    /**
     * Funkce vrati soubor JSON podle zadane URL
     * @param type $url cesta k souboru
     * @return asociativni pole pokud ziskany soubor je JSON jinak vraci null
     */
    private function ziskejSoubor($url) {
        $json = @file_get_contents($url);
        if ($json) {
            return json_decode($json, true);
        }
        return null;
    }
    
    /**
     * Rozparsuje zadany soubor a vrati seznam clanku
     * @param JSON $soubor
     * @param string $vyraz hledany vyraz
     * @return array() seznam Clanku
     */
    private function parsujSoubor($soubor, $vyraz) {
    $seznamClanku = Array();
    $index = 0;
    
    while (!empty($soubor['results'][$index])) {
        
        $datum = $this->vratDatumVytvoreni($soubor, $index);
        $titulek =  $soubor['results'][$index]['bibjson']['title'];
        $klice = $this->vratKlicovaSlova($soubor, $index);
        $abstrakt = $this->vratAbstrakt($soubor, $index);
        
        $seznamClanku [] = new Clanek(
               $titulek, 
                $abstrakt, 
                $this->vratDoi($soubor,$index), 
                $this->vratISSN($soubor, $index), 
                $this->vratAutora($soubor, $index),   
                $klice,
                'DOAJ',
                $datum['year'],
                $datum['month'],
                Clanek::vypoctiHodnoceni($titulek, $klice, $abstrakt, $vyraz),
                $soubor['results'][$index]['id']);
    
        $index++;
    }
    
    return $seznamClanku;
    }
    
    
    /**
     * Funkce vrati string klicovych slov, pokud clanek nema klicova slova je vranen prazdny retezec
     * @param JSON $soubor 
     * @param int $index index clanku, pro ktery chceme ziskat Klicova slova
     * @return string klicova slova, v pripade neuspechu vraci ''
     */
    private function vratKlicovaSlova($soubor,$index) {
        
    if (!empty($soubor['results'][$index]['bibjson']['keywords'])) {
        $a = 0;
       while (! empty($soubor['results'][$index]['bibjson']['keywords'][$a])) {
        $keyword [] =  $soubor['results'][$index]['bibjson']['keywords'][$a];
        $a++;
      }
      
      if(!empty($keyword)){
      $klice  =  implode(", ",$keyword );
      return $klice;  
      }
    
    }
    return '';
    }
    
    /**
     * Overi zda je k clanku dostupny abstrakt, kdyz ano tak ho vrati, jinak vraci prazny retezec
     * @param JSON $soubor
     * @param int $index
     * @return string abstrakt
     */
    private function vratAbstrakt($soubor, $index) {
        if (! empty($soubor['results'][$index]['bibjson']['abstract'])){
    $abstrakt = strip_tags($soubor['results'][$index]['bibjson']['abstract']);
    }else{ 
        $abstrakt = '';
    }
    return $abstrakt;
    }
    
    /**
     * Vrati datum vytvoreni clanku pokud je k dispozici
     * @param JSON $soubor
     * @param int $index 
     * @return string datum vytvoreni
     */
    private function vratDatumVytvoreni($soubor,$index) {
         if (! empty($soubor['results'][$index]['created_date'])){
        return date_parse($soubor['results'][$index]['created_date']);
    }
    return '';
    }
    
    /**
     * Vrati prvniho autora clanku
     * @param JSON $soubor
     * @param int $index
     * @return string autora
     */
    private function vratAutora($soubor,$index) {
        if (! empty($soubor['results'][$index]['bibjson']['author'][0]['name'])) {
            return $soubor['results'][$index]['bibjson']['author'][0]['name'];
     }
    return '';
    }
    
    /**
     * Vrati DOI clanku
     * @param JSON $soubor
     * @param int $index
     * @return string doi clanku
     */
    private function vratDoi($soubor,$index) {
        $x = 0;
        while (! empty($soubor['results'][$index]['bibjson']['identifier'][$x]['type'])){
            if ($soubor['results'][$index]['bibjson']['identifier'][$x]['type'] == 'doi') {
            return $soubor['results'][$index]['bibjson']['identifier'][$x]['id'];
        } 
        $x++;
            }
            return '';
    }
    
    /**
     * Overi zda je k clanku dostupne issn, kdyz ano tak ho vrati, jinak vraci prazny retezec
     * @param JSON $soubor
     * @param int $index
     * @return string issn
     */
    private function vratISSN($soubor,$index) {
        $x = 0;
        while (! empty($soubor['results'][$index]['bibjson']['identifier'][$x]['type'])){
            if ($soubor['results'][$index]['bibjson']['identifier'][0]['type'] == 'pissn') {
            return $soubor['results'][$index]['bibjson']['identifier'][0]['id'];
        } 
        $x++;
            }
            return '';
    }
    
    
    /**
     * Vrati seznam clanku pro zadany vyraz z databaze DOAJ
     * @param string $vyraz hledany vyraz
     * @return array<Clanek> seznam clanku, v pripade chyby nebo zadnych vysledku vrati string error
     */
    public function vratSeznamClanku($vyraz) {
        if(!empty($vyraz)){
        $url = $this->sestavURL($vyraz);
        $soubor = $this->ziskejSoubor($url);
        if(! empty($soubor['results'])){
        $seznamClanku = $this->parsujSoubor($soubor, $vyraz);
        return $seznamClanku;
        }
        }
        return 'error';
    }

}
