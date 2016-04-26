<?php
// source: C:\games\XAMPP\htdocs\FIM_Journal_Search_Engine\app/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9779109443', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb2cb465a78a_content')) { function _lb2cb465a78a_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><img id="logo" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/big.png" alt="logo aplikace Journal Search Engine">

<form class="w3-container w3-center w3-form"<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["searchForm"], array (
  'class' => NULL,
), FALSE) ?>>
    
    <input id="hledej" class="w3-large"<?php $_input = $_form["vyraz"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'id' => NULL,
  'class' => NULL,
))->attributes() ?>>
    <button  class="w3-btn w3-blue w3-center"<?php $_input = $_form["odeslat"]; echo $_input->{method_exists($_input, 'getControlPart')?'getControlPart':'getControl'}()->addAttributes(array (
  'class' => NULL,
))->attributes() ?>><i class="fa fa-search w3-xlarge"></i> Hledej</button>
    
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form, FALSE) ?></form>



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