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
	
	// index.php - admin_fiche()
	public function showGestionFiche()
	{		
		$mfiches = new MFiches();
		$data['FICHES_TITRES'] = $mfiches->SelectAllTitresFiches();
		$fiches_titres = '';
		foreach ($data['FICHES_TITRES'] as $val)
		{
			$href = '../Php/index.php?EX=form_fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
			//$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			$fiches_titres .= 	'<tr>
									<td class="table-texte"><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></td>
									<td><a href="'.$href.'"><p class="button">Modifier</p></a></td>
								</tr>';
		}
		
		echo <<<HERE
				<section class="grid-x align-center">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Gestion des fiches</h1>
						</header>	
					</div>
					<div class="cell large-8 medium-8 small-12">
						<!--
						<ul>
							$fiches_titres
						</ul>
						-->
						<table class="hover stack">
							<thead>
								<tr>
									<th>Fiches</th>
									<th>Modifier</th>
								</tr>
							</thead>
							<tbody>
									$fiches_titres	
							</tbody>	
						</table>
					</div>
				</section>
HERE;
		
	} // showGestionFiche()
	
	// index.php - form_fiche
	public function formFiche($_data)
	{
		if ($_data)
		{
			$ex = 'update_fiche&ID_FICHE='.$_data['ID_FICHE'];
			$fiche = $_data['FICHE_TITRE'];
			$delete = '<a href="../Php/index.php?EX=delete_fiche&amp;ID_FICHE='.$_data['ID_FICHE'].'"><p class="button">Supprimer</p></a>';
			$titre_fiche = '<h1 class="h3">Formulaire Supprimer Modifier Fiche</h1>';
			$img_fiche = '';
		}
		else
		{
			$ex = 'insert_fiche';
			$fiche = '';
			$delete = '';
			$titre_fiche = '<h1 class="h3">Formulaire Nouvelle Fiche</h1>';
			$img_fiche ='
							<div class="large-2 medium-2 small-12 cell">
								<label for="image" class="text-left middle">Image</label>
							</div>
							<div class="large-10 medium-10 small-12 cell">
								<input id="image" name="IMAGE" type="file" />
							</div>
						';
		}
		
		echo <<<HERE
		<section> 
			<form action="../Php/index.php?EX=$ex" method="post" enctype="multipart/form-data">
				<div class="grid-x">
					<div class="cell large-8 large-offset-2 medium-8 medium-offset-2 small-12 text-center"> 
						<header>					
							$titre_fiche
						</header>
						<div class="grid-x">
							<div class="large-2 medium-2 small-12 cell">
								<label for="fiche" class="text-left middle">Titre</label>
							</div>
							<div class="large-10 medium-10 small-12 cell" style="">			
								<input id="fiche" type="text" name="FICHE_TITRE" value="$fiche" size="45" maxlength="150" />	
							</div>
							$img_fiche
							<div class="cell large-3 large-offset-2" style="">
								<button class="button large" type="submit" value="Ok">Ok</button>
							</div>
						</div>
					</div>	
				</div>
			</form>
			<div class="cell large-12" style="">
				<div class="grid-x">
					<div class="cell large-3 large-offset-2 medium-3 medium-offset-2 small-12">
						$delete
					</div>
				</div>	
			</div>	
		</section>
HERE;

	} // formFiche($_data)
	
	// index.php - lesfiches()
	public function showPageFiches()
	{
		$mfiches = new MFiches();
		$data = $mfiches-> SelectAllFichePage();
		$lesFiches = '';
		foreach($data as $val)
		{			
			$lesFiches .= 	'
							<div class="cell large-6 medium-6 small-12 ma_bordure_bottom_bleu gestion-image-fiche">
								<div class="effet-survol-image">
									<img src="../img/d.jpg" alt="image d">
									<div class="effet-contenu">
										<h2>'.$val['FICHE_TITRE'].'</h2>
									</div>
								</div>						
							</div>

							<div class="cell large-6 medium-6 small-12 text-center ma_bordure_bottom_bleu ma_cellule_gris">
								<h2 class="gestion-titre-fiche"><a href="../Php/index.php?EX=la_fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']).'&amp;ID_DOC='.urlencode($val['ID_DOC']).'">'.$val['FICHE_TITRE'].'</a></h2>
								<h3 class="gestion-sous-titre-fiche">'.$val['TITRE'].'</h3>	
								<p class="gestion-texte">
									'.$val['DOCUMENT'].'
								</p>	
								<a href="../Php/index.php?EX=la_fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']).'&amp;ID_DOC='.urlencode($val['ID_DOC']).'" class="button">En savoir plus?</a>							
							</div>
							';
		}

			echo <<<HERE
				<section class="grid-x affichage_fiche_doc">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Les fiches</h1>
						</header>	
					</div>
				$lesFiches
				</section>
HERE;

	} // showPageFiches()
	
	// index.php - la_fiche()
	public function showLaFiches($_data)
	{
		$lafiche = 	'
						<div class="cell large-10 medium-10 small-12">
							<h1 class="h4">'.$_data['DOCUMENTS']['TITRE'].'</h1>
							<p>'.$_data['DOCUMENTS']['DOCUMENT'].'</p>
						</div>
					';

		echo <<<HERE
				<section class="grid-x grid-padding-x align-middle align-center affichage_fiche_doc">
					<div class="cell large-12 text-center gestion-fiche" style="">
						<header>
							<h1 class="h3">{$_SESSION['FICHE_TITRE']}</h1>
						</header>	
					</div>
				$lafiche
				</section>
HERE;

	} // showLaFiches()
	
	// index.php - fiche (ASIDE)
	public function showFiche($_data)
	{
		$fiche_content='';
		foreach ($_data as $val)
		{
			$fiche_content .= 	'
								<div class="cell large-8 medium-8 small-12 text-center ma_bordure_bottom_bleu ma_cellule_gris">
									<h2 class="gestion-titre-fiche"><a href="../Php/index.php?EX=la_fiche&amp;ID_DOC='.urlencode($val['ID_DOC']).'">'.$val['TITRE'].'</a></h2>
									<p class="gestion-texte">
										'.$val['DOCUMENT'].'
									</p>	
									<a href="../Php/index.php?EX=la_fiche&amp;ID_DOC='.urlencode($val['ID_DOC']).'" class="button">En savoir plus?</a>							
								</div>				
								';
		}
		
		echo <<<HERE
				<section class="grid-x affichage_fiche_doc align-center">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">{$_SESSION['FICHE_TITRE']}</h1>
						</header>	
					</div>
					$fiche_content
				</section>	
HERE;

	} // showFiche($_data)

	public function formFicheDocument($_data)
	{

	} // formFicheDocument($_data)

	
} // VFiches