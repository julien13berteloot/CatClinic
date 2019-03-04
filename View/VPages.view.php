<?php
/**
 * Affichage des documents
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
class VPages
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
	* Affichage des documents de la page home
	* @param array données des documents
	*
	* @return none
	*/
	public function showPage($_data)
	{	
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------FICHE--------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$fiches = '';
		foreach ($_data['FICHES'] as $val)
		{
			$fiches .= 	'
							<p>'.$val['FICHE_TITRE'].
							' - ' .$val['TITRE'].'</p>
						';
		}

		echo <<<HERE
			<h1>Les fiches</h1>
			$fiches
HERE;
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------SPECIALITES----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$specialites = '';
		foreach ($_data['SPECIALITES'] as $val)
		{
			$specialites .= '<p>'.$val['NOM'].'</p>';
		}

		echo <<<HERE
			<h1>Les spécialités</h1>
			$specialites
HERE;

		
	} // showPage($data)
	
		
 
} // VPages
?>
