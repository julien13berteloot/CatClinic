<?php
/**
 * Affichage du footer
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
class VFooter
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
	* Affichage du footer
	*
	* @return none
	*/
	public function showFooter()
	{
		echo '
			<div class="grid-x">
				<div class="cell large-12 text-center">
					<header>
						<p>footer</p>
					</header>
				</div>	
			</div>
			
		</div> <!-- END grid-container -->
		';
	}
  
} // VFooter

?>