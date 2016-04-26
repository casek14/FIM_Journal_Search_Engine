<?php
// source: C:\games\XAMPP\htdocs\FIM_Journal_Search_Engine\app/templates/Detail/detail.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4373624155', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbffc7df9fb9_content')) { function _lbffc7df9fb9_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div id="center" >
<div class="w3-container">
<a class="w3-btn w3-large w3-blue w3-margin-top" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($detail->getLinkNaCasopis()), ENT_COMPAT) ?>" target="_blank"><i class="fa fa-link "></i> Link na časopis</a>
<a class="w3-btn w3-large w3-blue w3-margin-top" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($detail->getOdkaz()), ENT_COMPAT) ?>" target="_blank"><i class="fa fa-link "></i> Link na článek</a>
<button onclick="document.getElementById('id01').style.display='block'" class="w3-btn w3-margin-top w3-large w3-blue "><i class="fa fa-quote-right"></i> Generuj Citaci</button>



</div>
<div id="id01" class="w3-modal" >
    <div class="w3-modal-content">
        <div class="w3-container">
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">×</span>
            <h2>Citace - ISO 690</h2>
            <p class="w3-border-top w3-margin-top">
                <?php echo Latte\Runtime\Filters::escapeHtml($autor, ENT_NOQUOTES) ?>
, <?php echo Latte\Runtime\Filters::escapeHtml($detail->getTitulek(), ENT_NOQUOTES) ?>
.<?php echo Latte\Runtime\Filters::escapeHtml($detail->getNazevCasopisu(), ENT_NOQUOTES) ?>, 
                <?php echo Latte\Runtime\Filters::escapeHtml($detail->getDatumPublikace(), ENT_NOQUOTES) ?>
, <?php echo Latte\Runtime\Filters::escapeHtml($detail->getRocnikCasopisu(), ENT_NOQUOTES) ?>
. <?php echo Latte\Runtime\Filters::escapeHtml($detail->getCisloCasopisu(), ENT_NOQUOTES) ?>
:<?php echo Latte\Runtime\Filters::escapeHtml($detail->getRozsahStranek(), ENT_NOQUOTES) ?>

                         
            </p>
        </div>
    </div>
</div>
                
                
                
              <hr>  
     <div class="w3-container">
         <h3>Vydavatel: <?php echo Latte\Runtime\Filters::escapeHtml($detail->getNazevCasopisu(), ENT_NOQUOTES) ?></h3>
         <h4>Časopis: <?php echo Latte\Runtime\Filters::escapeHtml($detail->getNazevZdroje(), ENT_NOQUOTES) ?></h4>
         <p class="w3-small">Ročnik <?php echo Latte\Runtime\Filters::escapeHtml($detail->getRocnikCasopisu(), ENT_NOQUOTES) ?>
, číslo <?php echo Latte\Runtime\Filters::escapeHtml($detail->getCisloCasopisu(), ENT_NOQUOTES) ?>
, rozsah stránek <?php echo Latte\Runtime\Filters::escapeHtml($detail->getRozsahStranek(), ENT_NOQUOTES) ?> </p>
     </div> 
     <hr>
     
         <div class="w3-container">
             <h3><?php echo Latte\Runtime\Filters::escapeHtml(strip_tags($detail->getTitulek()), ENT_NOQUOTES) ?></h3> 
             DOI: <?php echo Latte\Runtime\Filters::escapeHtml($detail->getDoi(), ENT_NOQUOTES) ?>

             <h5>Auroři:</h5> <?php $iterations = 0; foreach ($detail->getAutori() as $a) { ?>

             <?php echo Latte\Runtime\Filters::escapeHtml($a, ENT_NOQUOTES) ?><br>
<?php $iterations++; } ?>
                 
         </div>
      <hr>  
      
      <div class="w3-container">
          <h4>Klíčová slova</h4>
          <?php echo Latte\Runtime\Filters::escapeHtml($detail->getKlicovaSlova(), ENT_NOQUOTES) ?>

      </div>
      <hr>  
      
      <div class="w3-container">
          <h4>Abstrakt</h4>
          <?php echo Latte\Runtime\Filters::escapeHtml(strip_tags($detail->getAbstrakt()), ENT_NOQUOTES) ?>

      </div>
      <hr>  
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