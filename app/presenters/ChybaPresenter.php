<?php
namespace App\Presenters;
use App\Presenters\BasePresenter;
/**
 * Description of ChybaPresenter
 *
 * @author Jan Cach
 */
class ChybaPresenter extends BasePresenter{
   /**
     * Funkce, ktera vykresli chybu pri nacitani seznamu clanku
     */
    public function renderChybaClanku($vyraz) {
        $this->template->vyraz = $vyraz;
    }
    
    public function renderChybaDetailu() {
        
    }
}
