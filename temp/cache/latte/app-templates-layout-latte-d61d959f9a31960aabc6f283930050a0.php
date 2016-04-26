<?php
// source: C:\games\XAMPP\htdocs\FIM_Journal_Search_Engine\app/templates/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7050528071', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb8286160078_head')) { function _lb8286160078_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
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
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacros::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>FIM UHK Journal search engine</title>
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/my.css">
	<link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/w3schools.css">
	<link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>
	
    <header class="w3-container w3-white w3-center w3-padding-8 w3-hide-small">
              <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/logo.png" alt="logo search engine" class="w3-right">
              <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/logo_fim.png" alt="logo fakulty fim" class="w3-left">
              
          </header> 
        <div class="w3-border-bottom w3-padding-4 w3-container w3-blue">
           
             <div class="w3-left-align w3-hide-medium w3-hide-large w3-opennav"><a class="w3-xxlarge" href="javascript:void(0);" onclick="myFunction()">☰</a></div>
          <nav class="w3-topnav w3-container  w3-row-padding w3-padding-4 w3-center  w3-blue">
             
              <div class="w3-hide-small">
          <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:default"), ENT_COMPAT) ?>" class="w3-margin-right w3-large  w3-blue" >Domu</a>
          <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:About"), ENT_COMPAT) ?>" class="w3-margin-left w3-margin-right w3-large  w3-blue" >O projektu</a>
          <a href="" class="w3-margin-left w3-large  w3-blue" >Kontakt</a>
               </div>
          </nav>
        
        <div id="demo" class="w3-hide w3-hide-large w3-hide-medium">
  <ul class="w3-navbar w3-left-align w3-large">
    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:default"), ENT_COMPAT) ?>">Domu</a></li>
    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:About"), ENT_COMPAT) ?>">O projektu</a></li>
    <li><a href="#">Kontakt</a></li>
  </ul>
</div>
          
        </div>
        
        <section class="w3-section w3-white w3-centered ">
            
<?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>
            
            
        </section>
        
        
        
        
        
        
             <footer class="w3-blue w3-container w3-bottom">
            <p><a href="https://www.uhk.cz/cs-CZ/FIM" target="_blank">© Univerzita Hradec Králové</a></p>
        </footer>
        
        
        <script>
function myFunction() {
    document.getElementById("demo").classList.toggle("w3-show");
}
</script>
	

	
        
</body>
</html>
