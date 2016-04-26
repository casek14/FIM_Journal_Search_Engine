<?php
namespace App\model;
use Nette\Object;

/**
 * DoajParserDetailuClanku je trida slouzici k ziskani detailu clanku z databaze DOAJ
 *
 * @author Jan Cach
 */
class DoajParserDetailuClanku extends Object implements IZiskaniDetailuClanku {
   
    /**
     * Funkce, ktera ziska soubor z DOAJ ve formatu JSON
     * @param type $id pro ziskani informaci, pro DOAJ se pouziva id
     * @return type JSON soubor
     */
    private function ziskejSoubor($id) {
        $url = 'https://doaj.org/api/v1/articles/'.$id;
        
        $json = @file_get_contents($url);
        if ($json) {
            $soubor = json_decode($json, true);
            if($soubor){
                return $soubor;
            }
        }
            
        return null;
    }
    
    
     /**
     * Funcke, ktera rozparsuje zadany JSON soubor a vrati detail clanku
     * @param JSON $soubor
     * @return DetailClanku
     */
    private function parsuj($soubor) {
        if(! empty($soubor['bibjson'])){
            $klicovaSlova = $this->overKlicovaSlova($soubor);
            $rozsahStranek = $this->vratRozsahStranek($soubor);
            $doi = $this->vratDoi($soubor);
            $autori = $this->vratAutory($soubor);
            $issn = $this->vratIssn($soubor);
            $infoOVydavateli = $this->vratInfoOVydavateli($issn);
            $nazevZdroje = $this->vratNazevZdroje($soubor);
            $abstrakt = $this->vratAbstrakt($soubor);
            $volume = $this->vratRocnikCasopisu($soubor);
            $cisloCasopisu = $this->vratCisloCasopisu($soubor);
            
            $detailClanku = new DetailClanku($soubor['bibjson']['title'],
                    $nazevZdroje, 
                    $infoOVydavateli['vydavatel'],
                    $infoOVydavateli['odkaz'],
                    $volume, 
                    $cisloCasopisu, 
                    $rozsahStranek,
                    $soubor['bibjson']['year'], 
                    $autori, 
                    $doi, 
                    $abstrakt, 
                    $klicovaSlova, 
                    $soubor['bibjson']['link'][0]['url']);           
        }    
        return $detailClanku;
    }
    
    /**
     * Funkce, ktera vrati DOI k zadanemu clanku
     * @param JSON $soubor souborpro ziskani DOI
     * @return string DOI clanku
     */
     private function vratDoi($soubor) {
        $x = 0;
        while (! empty($soubor['bibjson']['identifier'][$x]['type'])){
            if ($soubor['bibjson']['identifier'][$x]['type'] == 'doi') {
               
            return $soubor['bibjson']['identifier'][$x]['id'];
        } 
        $x++;
            }
            return '';
    }
    
    /**
     * Funkce, ktera vrati ISSN k zadanemu clanku
     * @param JSON $soubor soubor, pro ziskani issn
     * @return string ISSN
     */
    private function vratIssn($soubor) {
        $x = 0;
        while (! empty($soubor['bibjson']['identifier'][$x])){
            if ($soubor['bibjson']['identifier'][$x]['type'] == 'pissn') {
            return $soubor['bibjson']['identifier'][$x]['id'];
        } 
        $x++;
        
            }
            return '';
    }
    
    
    /**
     * Funkce, ktera vrati seznam autoru spolecne s jejich afilem
     * @param JSON $soubor
     * @return array() seznam autoru s jejich affilem
     */
     private function vratAutory($soubor) {
        $index = 0;
        $affil = '';
        $autori = array();
        while (! empty($soubor['bibjson']['author'][$index])){
            $autor = $soubor['bibjson']['author'][$index]['name'];
            if(! empty($soubor['bibjson']['author'][$index]['affiliation'])){
            $affil = $affil = $soubor['bibjson']['author'][$index]['affiliation'];
            }
            
            $autori [] = $autor.' - '.$affil;
            $index++;
        }
        
        return $autori;
    }
    
    /**
     * Funkce, ktera vrati nakladatele casopisu
     * @param JSON $soubor
     * @return string nazev nakladatele
     */
     private function vratNazevZdroje($soubor) {
        if(isset($soubor['bibjson']['journal']['publisher'])){
            return $soubor['bibjson']['journal']['publisher'];
        }else{return'';}
    }

    /**
     * Funkce, ktera vraci rozsah stranek, na kterych se clanek v casopise nachazi
     * @param JSON $soubor
     * @return string
     */
    private function vratRozsahStranek($soubor) {
        if(isset($soubor['bibjson']['journal']['start_page']) && isset($soubor['bibjson']['journal']['end_page'])){
            return $soubor['bibjson']['journal']['start_page'].'-'.$soubor['bibjson']['journal']['end_page'];
        }else{return '-';}
    }
    
    
    /**
     * Funkce ktera vraci informace o vydavateli, nazev casopisu a odkaz na web casopisu
     * @param string $issn
     * @return array(['odkaz'],['vydavatel']) 
     */
    private function vratInfoOVydavateli($issn) {
        $odkaz = '';
        $vydavatel = '';
        
        if(!empty($issn)){
        $url = 'https://doaj.org/api/v1/search/journals/issn:('.$issn.')';
        $json = file_get_contents($url);
        if($json){
            $soubor = json_decode($json, true);  
        }
        $x = 0;
        while (!empty($soubor['results'][0]['bibjson']['link'][$x]['type'])){
            if($soubor['results'][0]['bibjson']['link'][$x]['type'] == 'homepage'){
                $odkaz =  $soubor['results'][0]['bibjson']['link'][$x]['url'];       
            }
            $x++;
        }
        $vydavatel = $soubor['results'][0]['bibjson']['title'];
        }
        $vysledek = array('odkaz' => $odkaz, 'vydavatel' => $vydavatel);
        return $vysledek;
    }
    
    
    /**
     * Funkce overi ziskana klicova slova, a vrati string klicovych slov oddeleny carkou
     * @param JSON $soubor
     * @return string string klicovych slov
     */
    private function overKlicovaSlova($soubor) {
    if (!empty($soubor['bibjson']['keywords'])) {
        $a = 0;
       while (! empty($soubor['bibjson']['keywords'][$a])) {
        $keyword [] =  $soubor['bibjson']['keywords'][$a];
        $a++;
      }
      $klice  =  implode(", ",$keyword );
    }else{
        $klice = "";
    } 
    return $klice;
    }
    
    /**
     * Funkce, ktera vrati Abstrakt clanku
     * @param JSON $soubor
     * @return abstrakt souboru
     */
    private function vratAbstrakt($soubor) {
        if(isset($soubor['bibjson']['abstract'])){
            return $soubor['bibjson']['abstract'];
        }
        
        return '';
    }
    
    /**
     * Funkce vrati cislo casopisu
     * @param JSON $soubor
     * @return cislo casopisu
     */
    private function vratRocnikCasopisu($soubor) {
        if(isset($soubor['bibjson']['journal']['volume'])){
            return $soubor['bibjson']['journal']['volume'];
        }
        return '';
    }
    
    private function vratCisloCasopisu($soubor){
        if(isset($soubor['bibjson']['journal']['number'])){
            return $soubor['bibjson']['journal']['number'];
        }
        return '';
    }

    /**
     * Funkce vrati detail clanku pro clanek z databaze DOAJ
     * @param string $id ID clanku v databazi DOAJ
     * @return DetailClanku , pri nezdaru vraci string error
     */
    public function vratDetailClanku($id) {
        if(!empty($id)){
            $soubor = $this->ziskejSoubor($id);
           if(! empty($soubor)){
            $detailClanku = $this->parsuj($soubor);
            return $detailClanku;
           }
        }
        return 'error';
    }
    
    

}
