<?php
/**
 * Affichage du aside
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
class VAside
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
	* Affichage du aside
	*
	* @return none
	*/
	public function showAside()
	{	
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------FICHE--------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$mfiches = new MFiches();
		$data['FICHES_TITRES'] = $mfiches->SelectAllTitresFiches();
		$fiches_titres = '';
		foreach ($data['FICHES_TITRES'] as $val)
		{
			if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_FICHE']) )))
			{
				$href = '../Php/index.php?EX=form_fiche&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
				$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			}
			elseif (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_DOC']) )))
			{
				$href = '../Php/index.php?EX=document&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
				$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			}
			else
			{
				$href = '../Php/index.php?EX=fiche&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
				$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			}
		}
				
		echo <<<HERE
			<h1>Fiches</h1>
			$fiches_titres
HERE;
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------ADMIN--------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$admin_fiche = '';
		$admin_document = '';
		$admin_spe = '';
		if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER'])))
		{
			$href = '../Php/index.php?EX=admin_fiche';
			$admin_fiche =	'
								<h1>Admin</h1>
								<li><a href="'.$href.'">Gestion des Fiches</a></li>
							';
			$href = '../Php/index.php?EX=admin_doc';
			$admin_document =	'
								<li><a href="'.$href.'">Gestion des Document</a></li>
							';
			//$href = '../Php/index.php?EX=admin_spe';
			/*$admin_spe = 	'
								<li><a href="'.$href.'">Gestion des Specialites</a></li>
							';
			*/
			$admin_spe = '<li id="specialites">Gestion des Specialites</li>';
		}

		$insert_fiche = (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_FICHE']) ))) ? 
		'<li><a href="../Php/index.php?EX=form_fiche">Nouvelle Fiche</a></li>' : '';

		echo <<<HERE
			$admin_fiche
			$insert_fiche
			$admin_document
			$admin_spe
HERE;

/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------DOCUMENT--------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
/*
		$mdocuments = new MDocuments();
		$_data['DOCUMENT_TITRES'] = $mdocuments->SelectAllTitresDocuments();
		$document_titres = '';
		
		foreach ($_data['DOCUMENT_TITRES'] as $val)
		{				
			if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER'])))
			{
				$href = '../Php/index.php?EX=form_document&amp;ID_DOC='.$val['ID_DOC'].'&amp;TITRE='.$val['TITRE'];
				$document_titres .= '<li><a href="'.$href.'">'.$val['TITRE'].'</a></li>';
			}			
		}

		if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER'])))
		{		
			echo'
				<div class="sticky">
					<div class="grid-x ">
						<div class="cell large-12;">
							<h2 class="callout">Document</h2>	
						</div>
						<div class="cell large-12">
							<ul>
							';
							echo <<<HERE
								$document_titres
HERE;
			echo'
							</ul>
						</div>	
					</div>
				</div>			
			';	
		}
*/		
	} // showAside()
	

  
} // VAside

?>