<?php
namespace App\model;
use Nette\Object;
/**
 * Description of ScopusParserDetailuClanku
 *
 * @author Jan Cach
 */
class ScopusParserDetailuClanku extends Object implements IZiskaniDetailuClanku{
    
    /**
     * Funkce, ktera ziska soubor ze Scopusu ve formatu XML
     * @param type $id pro ziskani informaci, pro scopus se pouziva DOI
     * @return type XML soubor
     */
    private function ziskejSoubor($id) {
        if(!empty($id)){
        $url = 'http://api.elsevier.com/content/search/scopus?query=eid%28'.$id.'%29&apiKey=6492f9c867ddf3e84baa10b5971e3e3d&httpaccept=application/xml&view=complete';
        $soubor = @simplexml_load_file($url);
        return $soubor;
        }  
        
        return null;
        
    }
    
    
    
    /**
     * Funcke, ktera rozparsuje zadany XML soubor a vrati detail clanku
     * @param XML $soubor
     * @return DetailClanku
     */
    private function parsuj($soubor) {
        if (isset($soubor->entry)) {
            $doi = $soubor->entry->children('prism',true)->doi;
            $rozsahStranek = $this->vratRozsahStran($soubor);
            $issn = $this->vratIssn($soubor);
            $infoOVydavateli = $this->vratInformaceOVydavateli($issn);
            $autori = $this->vratAutory($soubor);
            $odkaz = $this->vratOdkaz($soubor);
            
          
         $detailClanku = new DetailClanku($soubor->entry->children('dc',true)->title,
                    $soubor->entry->children('prism',true)->publicationName,
                    $infoOVydavateli['vydavatel'],
                    $infoOVydavateli['odkaz'],
                    $soubor->entry->children('prism',true)->volume, 
                    $soubor->entry->children('prism',true)->issueIdentifier, 
                    $rozsahStranek,
                    $soubor->entry->children('prism',true)->coverDate, 
                    $autori, 
                    $doi, 
                    $soubor->entry->children('dc',true)->description, 
                    $soubor->entry->authkeywords, 
                    $odkaz);
        }else{
            $detailClanku= '';
        }
        
        return $detailClanku;
    }
    
    
    /**
     * Funkce, ktera vrati seznam autoru spolecne s jejich afilem
     * @param XML $soubor soubor pro parsovani
     * @return array() seznam autoru s jejich affilem
     */
    private function vratAutory($soubor){
        $seznamAutoru = '';
        $a = 'affiliation-city';
        $b = 'affiliation-country';
        $jmeno = '';
        $nazev = '';
        $mesto = '';
        $zeme = '';
            
        
        
        foreach ($soubor->entry->author as $autor) {
            $jmeno = $autor->authname;
            $aId = $autor->afid;
            foreach ($soubor->entry->affiliation as $affil){
                
            if(strcmp($affil->afid,$aId) == 0){
                
                $nazev = $affil->affilname;
                $mesto = $affil->$a;
                $zeme = $affil->$b;
                $seznamAutoru [] = $jmeno.' - '.$nazev.', '.$mesto.', '.$zeme;
            }
            }
        
        
    }
    return $seznamAutoru;
    } 
    
    /**
     * Funkce, ktera vraci rozsah stranek, na kterych se clanek v casopise nachazi
     * @param XML $soubor soubor pro parsovani
     * @return string rozsah stranek
     */
    private function vratRozsahStran($soubor){
        
        if (($soubor->entry->children('prism',true)->pageRange) !== ''){
            return $soubor->entry->children('prism',true)->pageRange; 
            }
            return $rozsahStranek = '-';
                     
    }
    
    /**
     * Funkce, ktera vrati ISSN k zadanemu clanku
     * @param XML $soubor
     * @return string ISSN daneho clanku
     */
    private function vratIssn($soubor) {
        if(! empty($soubor->entry->children('prism',true)->issn)){
            return $soubor->entry->children('prism',true)->issn;
        }
        return '';
    }
    
    /**
     * Funkce ktera vraci informace o vydavateli, nazev casopisu a odkaz na web casopisu
     * @param XML $issn
     * @return array(['odkaz'],['vydavatel']) 
     */
    private function vratInformaceOVydavateli($issn) {
        $odkaz = '';
        $vydavatel = '';
        if(!empty($issn)){
        $url = 'http://api.elsevier.com/content/serial/title?issn='.$issn.'&apiKey=6492f9c867ddf3e84baa10b5971e3e3d&httpAccept=application/xml';
        $soubor = @simplexml_load_file($url);
        if($soubor){
            
        $vydavatel = $soubor->entry->children('dc',true)->publisher;
        foreach ($soubor->entry->link as $x) {
            if ($x->attributes()['ref'] === 'homepage') {
                $odkaz =  $x->attributes()['href'];
               
            }
            }
          }
        
        
        }
        $infoOVydavateli = array('vydavatel' => $vydavatel,'odkaz' => $odkaz);
        return $infoOVydavateli;
    }
    
    /**
     * Funkce, ktera vrati odkaz na casopis
     * @param XML $soubor
     * @return string odkaz na clanek
     */
    private function vratOdkaz($soubor) {
        foreach ($soubor->entry->link as $link) {
           if($link->attributes()['ref'] === 'full-text'){
               return   $link->attributes()['href'];
           }
           
        }
        
        foreach ($soubor->entry->link as $link) {
           if($link->attributes()['ref'] === 'scopus'){
               return $link->attributes()['href'];
           }
           
        }
        
        return '';
    }
    
     /**
     * Funkce vrati detail clanku pro clanek z databaze Scopus
     * @param string $id DOI clanku v databazi Scopus
     * @return DetailClanku , pri nezdaru vraci string error
     */
    public function vratDetailClanku($id) {
        if(!empty($id)){
            $soubor = $this->ziskejSoubor($id);
           if(!empty($soubor->entry)){
            $detailClanku = $this->parsuj($soubor);
            return $detailClanku;
           }
        }
        return 'error';
    }

}
