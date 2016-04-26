<?php

namespace App\Presenters;
use App\model\DoajParserDetailuClanku;
use App\model\ScopusParserDetailuClanku;
/**
 * Description of DetailPresenter
 *
 * @author Jan Cach
 */
class DetailPresenter extends BasePresenter{
   
    private $doajParserDetailuClanku;
    private $scopusParserDetailuClanku;
    public function __construct(DoajParserDetailuClanku $doajParserDetailuClanku, ScopusParserDetailuClanku $scopusParserDetailuClanku) {
        parent::__construct();
        $this->doajParserDetailuClanku = $doajParserDetailuClanku;
        $this->scopusParserDetailuClanku = $scopusParserDetailuClanku;
    }
    
    public function renderDetail($id, $autor, $databaze){
       
        if($databaze == 'Scopus'){
           $detailClanku = $this->scopusParserDetailuClanku->vratDetailClanku($id);
        }
        
        if($databaze == 'DOAJ'){
        $detailClanku = $this->doajParserDetailuClanku->vratDetailClanku($id);
        }
        
        if($detailClanku != 'error'){
        $this->template->detail = $detailClanku;
        $this->template->autor = $autor;
        $this->template->databaze = $databaze;
        }else{
            $this->redirect('Chyba:ChybaDetailu');
        }
    }
}
