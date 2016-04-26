<?php
// source: C:\games\XAMPP\htdocs\FIM_Journal_Search_Engine\app/templates/Chyba/chybaDetailu.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9605697734', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6a2a63ff6e_content')) { function _lb6a2a63ff6e_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1 id="chyba">Detail článku není dostupný !</h1>
<p id="center" class="w3-large">Omlouvame se, ale Vámi požadovaný detail článku není dsotupný.</p>

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
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 