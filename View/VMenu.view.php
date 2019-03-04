<?php
/**
 * Affichage du menu
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
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
			$li .= '<li><a href="../Php/index.php?EX=admin">Connexion</a></li>';	
		}
		
		//$insert_document = (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']))) ? '<li><a href="../Php/index.php?EX=form_document">Nouveau document</a></li>' : '';
	  
echo'
	<div class="grid-container">
	
		<header id="header" class="header text-center">
			<p>header</p>
		</header>

		<nav data-sticky-container>
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
							<!--<h1 id="logo" title="Logo"><a href="../Php/index.php?EX=home&amp;ID_USER=$ID_USER">Logo</a></h1>-->
							$li 
						
						</ul>		
HERE;
echo '											
					</div>
				</div>
			</div>
		</nav>
	
	';
	}
  
} // VMenu

?>
