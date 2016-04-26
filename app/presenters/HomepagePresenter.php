<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;

/**
 * Presenter, ktery obsluhuje uvodni stranku
 */
class HomepagePresenter extends BasePresenter
{

    /**
     * Funkce, ktera vrati formular pro zadani vyrazu
     * @return Form
     */
    protected function createComponentSearchForm() {
        $form = new Form();
            $form->addText('vyraz')
                 ->setRequired('Zadejte prosim vyraz, ktery chcete hledat')
                    ->addRule(Form::FILLED,'Zadejte vyraz');
            $form->addSubmit('odeslat');
            $form->onSuccess[]=array($this,'searchFormSucceeded');
            return $form;
    }
    
	

        public function searchFormSucceeded($form,$values){
            $this->redirect('Clanek:seznamClanku', $values->vyraz, 'hodnoceni');
        }

                public function renderAbout(){
            
        }
        
         public function renderContact(){
            
        }
}
