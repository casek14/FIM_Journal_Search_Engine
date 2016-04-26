<?php
namespace App\model;
use Nette\Object;

/**
 * Trida vykonava razeni seznamu clanku a filtrovani podle roku a databaze
 *
 * @author Jan Cach
 */
class SpravceClanku extends Object{

    /**
     * Porovna 2 ciselne hodnoty
     * @param Clanek $a
     * @param Clanek $b
     * @return ktery prvke je vetsi
     */
    private function hodnoceniSort( $a, $b ) {
    return $a->getHodnoceni() == $b->getHodnoceni() ? 0 : ( $a->getHodnoceni() > $b->getHodnoceni() ) ? -1 : 1;
}

/**
 * Porovna 2 datumy podle mesice a roku 
 * @param Clanek $a
 * @param Clanek $b
 * @return ktere datum je novejsi
 */
private function datumSort( $a, $b ) {
          $dateA = date_create_from_format('n-Y', $a->getMesicVytvoreni().'-'.$a->getRokVytvoreni());
          $dateB = date_create_from_format('n-Y',$b->getMesicVytvoreni().'-'.$b->getRokVytvoreni());
          
         return $dateA == $dateB ? 0 : ( $dateA > $dateB ) ? -1 : 1;
}


/**
 * Funkce, ktera seradi clanky podle data vydani
 * @param array[Clanek] $seznam
 * @return array[Clanek] serazeny seznam clanku
 */
public function seradPodleDatumu($seznam) {
    usort($seznam,array($this,"datumSort"));
        return $seznam; 
}

/**
 * Funkce, ktera seradi clanky podle hodnoceni
 * @param array[Clanek] $seznam
 * @return array[Clanek] serazeny seznam clanku
 */
    public function seradPodleHodnoceni($seznam) {
       
        
        usort($seznam,array($this,"hodnoceniSort"));
        return $seznam;  
    }
    
    
    /**
     * Funkce, ktera vrati pouze clanky, ktere maji datum publikovani stejne nebo vetsi jako zadane
     * @param array[clanek] $seznam seznam clanku
     * @param int $rok vydani clanku
     * @return array[clanek] seznam clanku, s pozadovanym datumem
     */
    public function filtrujRoky($seznam, $rok) {
        $vyfiltrovanySeznam = '';
        foreach ($seznam as $clanek) {
            if(intval($clanek->getRokVytvoreni()) >= intval($rok)){
                $vyfiltrovanySeznam [] = $clanek;
            }
        }
        
        return $vyfiltrovanySeznam;
    }
    
    /**
     * Funkce, ktera vrati clanky pouze z pozadovane databaze
     * @param array[clanek] $seznam
     * @param string $databaze pozadovana databaze
     * @return array[clanek] $seznam seznam clanku pouze s pozadovanou databazi
     */
    public function filtrujDatabazi($seznam, $databaze) {
        $vyfiltrovanySeznam = '';
        foreach ($seznam as $clanek) {
            if($clanek->getDatabaze() == $databaze){
                $vyfiltrovanySeznam [] = $clanek;
            }
        }
        return $vyfiltrovanySeznam;
        
            }
    
    
}
