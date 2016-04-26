<?php
// source: C:\games\XAMPP\htdocs\FIM_Journal_Search_Engine\app/templates/Clanek/seznamClanku.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0416498186', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbd796d231cf_content')) { function _lbd796d231cf_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;$_b->templates['0416498186']->renderChildTemplate('filter.latte', array('vyraz' => $vyraz) + $template->getParameters()) ?>

<div id="vypisClanku">
<?php if ($seznam) { $iterations = 0; foreach ($seznam as $item) { ?>

            <?php if ($item->getDatabaze() == 'Scopus') { $barva = 'green'; } ?>

            <?php if ($item->getDatabaze() == 'DOAJ') { $barva = 'blue'; } ?>

            
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Detail:detail", array($item->getId(), $item->getAutor(), $item->getDatabaze())), ENT_COMPAT) ?>"> 


                <div class="w3-container w3-hoverable w3-card-4 w3-margin-bottom w3-padding-0">
                    <div class="w3-container w3-<?php echo Latte\Runtime\Filters::escapeHtml($barva, ENT_COMPAT) ?>
 w3-padding-8 "><?php echo Latte\Runtime\Filters::escapeHtml($item->getTitulek(), ENT_NOQUOTES) ?>

                        <span class="w3-margin-left w3-large w3-white  w3-badge"><?php echo Latte\Runtime\Filters::escapeHtml($item->getHodnoceni(), ENT_NOQUOTES) ?></span>

                    </div>


                    <div class="w3-container w3-padding-8 w3-small">

                        <span id="seznam"><strong id="tucne">Autor: </strong><?php echo Latte\Runtime\Filters::escapeHtml($item->getAutor(), ENT_NOQUOTES) ?></span>
                        <span id="seznam"><strong id="tucne">DOI: </strong><?php echo Latte\Runtime\Filters::escapeHtml($item->getDOI(), ENT_NOQUOTES) ?></span>
                        <span id="seznam"><strong class="w3-margin-left">ISSN: </strong><?php echo Latte\Runtime\Filters::escapeHtml($item->getIssn(), ENT_NOQUOTES) ?></span>
                        <span id="seznam"><strong class="w3-margin-left">Databáze: </strong><?php echo Latte\Runtime\Filters::escapeHtml($item->getDatabaze(), ENT_NOQUOTES) ?></span>
                        <span id="seznam"><strong class="w3-margin-left">Vytvořeno: </strong><?php echo Latte\Runtime\Filters::escapeHtml($item->getMesicVytvoreni(), ENT_NOQUOTES) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml($item->getRokVytvoreni(), ENT_NOQUOTES) ?></span>

                        <p id="seznam"><strong>Klíčová slova: </strong><?php echo Latte\Runtime\Filters::escapeHtml($item->getKlicovaSlova(), ENT_NOQUOTES) ?></p>
                    </div>
                    <p class="w3-margin-left w3-blockquote w3-section w3-tiny">
                        <?php echo Latte\Runtime\Filters::escapeHtml(substr($item->getAbstrakt(),0,650), ENT_NOQUOTES) ?> ...
                    </p>
            
        </div>
</a>
<?php $iterations++; } } ?>
</div>    
<div id="paticka"></div>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 