<?php
// source: C:\games\XAMPP\htdocs\FIM_Journal_Search_Engine\app/templates/Clanek/filter.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3199574946', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block sidenav
//
if (!function_exists($_b->blocks['sidenav'][] = '_lb2adfc74704_sidenav')) { function _lb2adfc74704_sidenav($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="w3-container w3-padding-8 w3-small w3-animate-right w3-center" id="filter">
    
    <div class="w3-center w3-container w3-medium">
        Specifikace požadavků 
    </div>
            <hr>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>'hodnoceni')), ENT_COMPAT) ?>"  >Seradit podle hodnoceni</a><br>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>'datum')), ENT_COMPAT) ?>">Seradit podle datumu</a>
            <hr>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>'datum')), ENT_COMPAT) ?>">Kdykoliv</a><br>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>2016)), ENT_COMPAT) ?>">Od 2016</a><br>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>2015)), ENT_COMPAT) ?>">Od 2015</a><br>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>2014)), ENT_COMPAT) ?>">Od 2014</a><br>
            
            <hr>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>'hodnoceni')), ENT_COMPAT) ?>"  >Všechny zdroje</a><br>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>'Scopus')), ENT_COMPAT) ?>">Scopus</a><br>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Clanek:seznamClanku", array('vyraz'=>$vyraz, 'metoda'=>'DOAJ')), ENT_COMPAT) ?>">DOAJ</a>
</div>


<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['sidenav']), $_b, get_defined_vars()) ; 