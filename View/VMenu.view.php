<?php
class VMenu
{
	/**
	* Constructeur
	*/
	public function __construct() {}

	/**
	* Destructeur
	*/
	public function __destruct() {}

	/**
	* Affichage du menu
	*
	* @return none
	*/
	public function showMenu()
	{
		global $ID_USER;
		$li = '';
		if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER'])))
		{
			$li .= '<li><a href="../Php/index.php?EX=home">Home</a></li>';
			$li .= '<li><a href="../Php/index.php?EX=deconnect">Deconnexion</a></li>';
		}
		else
		{
			$li .= '<li><a href="../Php/index.php?EX=home">Home</a></li>';
			$li .= '<li><a href="../Php/index.php?EX=lesfiches">Fiches</a></li>';
			$li .= '<li><a href="../Php/index.php?EX=lesdocuments">Documents</a></li>';
			$li .= '<li><a href="../Php/index.php?EX=contact">Contact</a></li>';
			$li .= '<li><a href="../Php/index.php?EX=admin">Connexion</a></li>';	
		}
		
		echo'
	<div class="grid-container">
	
		<header id="header" class="">		
			<div class="mon-header grid-x grid-padding-x ma_cellule_gris align-middle hide-for-small-only">
				<div class="cell large-2 medium-4 small-12">
					<a href="../Php/index.php"><img src="../img/logo-clinic.jpg" alt="Logo CatClinic"></a>
				</div>
				<div class="cell large-8 medium-8 small-12">
					<p class="lead">Clinique vétériniaire CatClinic</p>
					<p>Urgences Assurées 24h/24 et 7j/7</p>
				</div>
			</div>
		</header>

		<nav data-sticky-container class="mon-menu">
			<div data-sticky data-margin-top=\'0\' data-top-anchor="header:bottom" data-btm-anchor="id_sticky_content:bottom">
				<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium" data-animate="hinge-in-from-top hinge-out-from-top">
					<button class="menu-icon" type="button" data-toggle="example-menu"></button>
					<div class="title-bar-title">Menu</div>
				</div>
				<div class="top-bar" id="example-menu" >
					<div class="top-bar-left anim-menu" data-anim-menu>					
';	
echo <<<HERE
						<ul class="vertical medium-horizontal menu align-center" data-responsive-menu="accordion ">
							$li 
						</ul>		
					
					</div>
				</div>
			</div>
		</nav>
	
HERE;
	}
  
} // VMenu

?>
