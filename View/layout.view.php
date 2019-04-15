<?php
/**
 * Fichier de mise en page
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 */

global $content;
$vmenu = new VMenu();
$vfooter = new VFooter();
$caroussel = new VCaroussel();
$vcontent = new $content['class']();
$vaside = new VAside();
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$content['title']?></title>
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../icons/foundation-icons.css" />
</head>

<body>

	<?php $vmenu->showMenu() ?>

	<?php $caroussel->showCaroussel() ?>
	
	<div  class="grid-x ma-grille-principal">
		<aside class="cell large-3" data-sticky-container>
			<?php $vaside->showAside()?>
		</aside> <!-- END aside -->
		<div id="id_sticky_content" class="cell large-9">
			<?php $vcontent->{$content['method']}($content['arg']) ?>	
		</div> <!-- END Contenu Droite -->
	</div> <!-- END grid-x -->
	
	<?php $vfooter->showFooter() ?>

	<script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/what-input/dist/what-input.js"></script>
    <script src="../node_modules/foundation-sites/dist/js/foundation.js"></script>
    <script src="../js/app.js"></script>

	<script src="../Js/exercice.js"></script>
</body>
</html>
