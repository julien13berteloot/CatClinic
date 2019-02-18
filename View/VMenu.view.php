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
	echo'
	<div class="grid-container">
	
		<header id="header" class="header" style="padding:100px; background-color:red;">
			GGG
		</header>

		<nav data-sticky-container>
			<div data-sticky data-margin-top=\'0\' data-top-anchor="header:bottom" data-btm-anchor="id_sticky_content:bottom">
				<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium" data-animate="hinge-in-from-top hinge-out-from-top">
					<button class="menu-icon" type="button" data-toggle="example-menu"></button>
					<div class="title-bar-title">Menu</div>
				</div>
				<div class="top-bar" id="example-menu" >
					<div class="top-bar-left anim-menu" data-anim-menu>
						<ul class="vertical medium-horizontal menu align-center" data-responsive-menu="accordion ">
							<li>
								<a href="#">Home</a>
							</li>
							<li>
								<a href="#">Item 2</a>
							</li>
							<li>
								<a href="#">Item 3</a>						
							</li>
							<li>
								<a href="#">Item 4</a>						
							</li>		
						</ul>
					</div>
				</div>
			</div>
		</nav>
	
	';
  }
  
} // VMenu

?>
