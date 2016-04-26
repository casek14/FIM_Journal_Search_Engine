<?php
namespace App\Presenters;
use App\Presenters\BasePresenter;
use App\model\DoajParserClanku;
use App\model\ScopusParserClanku;
use App\model\SpravceClanku;
/**
 * Description of ClanekPresenter
 *
 * @author Jan Cach
 */
class ClanekPresenter extends BasePresenter{
    
     private $doajParserClanku;
     private $scopusParserClanku;
     private $spravceClanku;
     
     public function __construct(DoajParserClanku $doajParserClanku, ScopusParserClanku $scopusParserClanku, SpravceClanku $spravceClanku) {
         parent::__construct();
         $this->doajParserClanku = $doajParserClanku;
         $this->scopusParserClanku = $scopusParserClanku;
         $this->spravceClanku = $spravceClanku;
     }


     public function renderSeznamClanku($vyraz,$metoda){
         $seznam = $this->vratSeznam($vyraz);
         if($seznam !== 'error' ){
         if ($metoda == 'hodnoceni') {
            $seznamClanku = $this->spravceClanku->seradPodleHodnoceni($seznam);
         }  elseif ($metoda == 'datum') {
             $seznamClanku = $this->spravceClanku->seradPodleDatumu($seznam);
         }  elseif (intval($metoda)) {
            $seznamClanku =  $this->spravceClanku->filtrujRoky($seznam, $metoda);
         } elseif ($metoda == 'DOAJ') {
             $seznamClanku = $this->spravceClanku->filtrujDatabazi($seznam, $metoda);
         } 
         elseif ($metoda == 'Scopus') {
             $seznamClanku = $this->spravceClanku->filtrujDatabazi($seznam, $metoda);
         } 
         
         
         $this->template->seznam = $seznamClanku;
         $this->template->vyraz = $vyraz;
         }  else {
             $this->redirect('Chyba:ChybaClanku',$vyraz);
         }
    }
    
    private function vratSeznam($vyraz) {
       if($_SESSION['vyraz'] == $vyraz){
           return unserialize($_SESSION['seznam']);
           
       }
        $seznam1 = $this->doajParserClanku->vratSeznamClanku($vyraz);
        $seznam2 = $this->scopusParserClanku->vratSeznamClanku($vyraz);
        $seznam = $this->spojSeznam($seznam1, $seznam2);
        $_SESSION['vyraz'] = $vyraz;
        $_SESSION['seznam'] = serialize($seznam);
        return $seznam;
    }
    
    
    
    
    private function spojSeznam($seznam1,$seznam2) {
        if ($seznam1 != 'error' && $seznam2 != 'error') {
            return array_merge($seznam1, $seznam2);
        }
        
        if ($seznam1 != 'error' && $seznam2 == 'error') {
            return $seznam1;
        }
        
        if ($seznam1 == 'error' && $seznam2 != 'error') {
            return $seznam2;
        }
        
        if($seznam1 == 'error' && $seznam2 == 'error'){
            return 'error';
        }
    }
}
