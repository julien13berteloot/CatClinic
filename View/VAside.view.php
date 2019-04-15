<?php
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
				$href = '../Php/index.php?EX=form_fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
				$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			}
			elseif (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_DOC']) )))
			{
				$href = '../Php/index.php?EX=document&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
				$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			}
			else
			{
				$href = '../Php/index.php?EX=fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
				$fiches_titres .= '<li class="list-group-item"><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			}
		}
		
		echo '		
		<div class="sticky" data-sticky data-margin-top="3.3" data-top-anchor="example2">
			<div class="grid-x ma_cellule_gris">
				<div class="cell large-12">
					<h2 class="callout h3">Fiches</h2>	
				</div>					
		';

		echo <<<HERE
				<div class="cell large-12 medium-12 small-12">
					<ul>
						$fiches_titres
					</ul>
				</div>
HERE;
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------ADMIN--------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$admin_fiche = '';
		$admin_document = '';
		$admin_spe = '';
		$admin_docteur = '';
		$admin_asv = '';
		if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER'])))
		{
			$href = '../Php/index.php?EX=admin_fiche';
			$admin_fiche =	'						
								<li><a href="'.$href.'">Gestion des Fiches</a></li>
							';
			$href = '../Php/index.php?EX=admin_doc';
			$admin_document =	'
								<li><a href="'.$href.'">Gestion des Document</a></li>
								';
			
			$admin_spe = '<li id="specialites">Gestion des Specialites</li>';
			
			$admin_docteur = '<li id="docteur">Gestion des docteur</li>';
			
			$admin_asv = '<li id="asv">Gestion des Asv</li>';
		}
		
		$admin_mode = '';
		if (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER'])))
		{
			$admin_mode =	'
							<div class="cell medium-12 small-12">
								<h2 class="callout h3">Admin</h2>	
							</div>
							';
		}
		
		$insert_fiche = (isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_FICHE']) ))) ? 
		'<li><a href="../Php/index.php?EX=form_fiche">Nouvelle Fiche</a></li>' : '';
		
		echo <<<HERE
				$admin_mode
				<ul>
					$admin_fiche
					$insert_fiche
					$admin_document
					$admin_spe
					$admin_docteur
					$admin_asv
				</ul>			
HERE;

		echo '
			</div><!-- grid-x ma_cellule_gris -->
		';
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------DOCUMENT-----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------------------*/

	
	echo '			
			
		</div><!-- End Sticky -->					
	';
	
	}
	
	
} // VAside

?>