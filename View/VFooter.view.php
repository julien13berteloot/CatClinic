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
			<div class="grid-x ma_cellule_bleu align-center" style="padding:150px 0;" >
				<div class="cell large-12 text-center">
					<header>
						<h1>FOOTER</h1>
					</header>
				</div>	
			</div>
			
		</div> <!-- END grid-container -->
		';
	}
  
} // VFooter

?>