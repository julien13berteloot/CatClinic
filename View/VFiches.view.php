<?php
/**
 * Affichage des fiches
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
class VFiches
{
	/**
	* Constructeur
	*/ 
	public function __construct() {}

	/**
	* Destructeur
	*/ 
	public function __destruct() {}
	
	
	public function showGestionFiche()
	{
		echo'GESTION DES FICHES';
	}
	
	
	
	public function showFiche($_data)
	{
/*
		$fiche_content='';
			foreach ($_data as $val)
			{
				if (!isset($_SESSION['ADMIN']) && (!isset($_SESSION['ID_USER'])))
				{
					$fiche_content .= '
										<h2><a href="../Php/index.php?EX=document&amp;ID_DOC='.$val['ID_DOC'].'">'.$val['TITRE'].'</a></h2>
										<p>'.$val['DOCUMENT'].'</p>
									';
				}
				else
				{	
					$fiche_content .= '
										<h2><a href="../Php/index.php?EX=form_document&amp;ID_DOC='.$val['ID_DOC'].'">'.$val['TITRE'].'</a></h2>
										<p>'.$val['DOCUMENT'].'</p>
									';
				}
			}
		
		echo <<<HERE
				<h1 class="h2">{$_SESSION['TITRE']}</h1>
				$fiche_content
HERE;
*/
	} // showFiche($_data)
	
	public function formFiche($_data)
	{
		
		if ($_data)
		{
			$ex = 'update_fiche&ID_FICHE='.$_data['ID_FICHE'];
			$fiche = $_data['FICHE_TITRE'];
			$delete = '<p class="button"><a href="../Php/index.php?EX=delete_fiche&amp;ID_FICHE='.$_data['ID_FICHE'].'"><button>Supprimer</button></a></p>';
		}
		else
		{
			$ex = 'insert_fiche';
			$fiche = '';
			$delete = '';
		}
		
		echo <<<HERE
		<form action="../Php/index.php?EX=$ex" method="post">
			<fieldset>
				<legend>Formulaire Fiche</legend>
				<p>
					<label for="fiche">Titre</label>
					<input id="fiche" name="FICHE_TITRE" value="$fiche" size="45" maxlength="150" />
				</p>
				<p class="submit">
					<input type="submit" value="Ok" />
				</p>
			</fieldset>
		</form>
$delete
HERE;
  	 
  	return;
				
	} // formFiche($_data)
	
	
} // VFiches