<?php
/**
 * Affichage des documents
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 *
 */
class VDocuments
{
	/**
	* Constructeur
	*/ 
	public function __construct() {}

	/**
	* Destructeur
	*/ 
	public function __destruct() {}
	
	// index.php - admin_doc() 
	public function showGestionDoc()
	{
		$mdocu = new MDocuments();
		$data = $mdocu-> SelectAllDocumentsPages();
		$lesDocu = '';
		
		foreach($data as $val)
		{
			$href = '../Php/index.php?EX=form_document&amp;ID_DOC='.urlencode($val['ID_DOC']).'&amp;TITRE='.urlencode($val['TITRE']);

			$lesDocu .= 	'<tr>
									<td class="table-texte"><a href="'.$href.'">'.$val['TITRE'].'</a></td>
									<td><a href="'.$href.'"><p class="button">Modifier</p></a></td>
							</tr>';	
		}
		
		echo <<<HERE
				<section class="grid-x align-center">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Gestion des documents</h1>
						</header>	
					</div>
					<div class="cell large-8 medium-8 small-12">
						<table class="hover stack">
							<thead>
								<tr>
									<th>Documents</th>
									<th>Modifier</th>
								</tr>
							</thead>
							<tbody>
									$lesDocu	
							</tbody>	
						</table>
					</div>
				</section>
HERE;
		
	} // showGestionDoc()
	
	// index.php - document()
	public function showDocument($_data)
	{	
		$document = '';
		foreach ($_data as $val)
		{
			$href = '../Php/index.php?EX=form_document&amp;ID_DOC='.urlencode($val['ID_DOC']).'&amp;TITRE='.urlencode($val['TITRE']);
			
			$document .= 	'<tr>
								<td class="table-texte"><a href="'.$href.'">'.$val['TITRE'].'</a></td>
								<td>'.$val['DOCUMENT'].'</td>
								<td><a href="'.$href.'"><p class="button">Modifier</p></a></td>
							</tr>';		
		}
	
		$nouveau_doc = isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_DOC']) )) ? 
		'<a href="../Php/index.php?EX=form_document"><p class="button">Nouveau document</p></a>' : '';

		echo <<<HERE
				<section class="grid-x align-center">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Gestion des documents</h1>
						</header>	
					</div>
					<div class="cell large-12 text-center">
						<h2 class="h4">{$_SESSION['FICHE_TITRE']}</h2>
					</div>
					<div class="cell large-8 medium-8 small-12">
						<table class="hover stack">
							<thead>
								<tr>
									<th>Titre</th>
									<th>Document</th>
									<th>Modifier</th>
								</tr>
							</thead>
							<tbody>
									$document	
							</tbody>	
						</table>
					</div>
					<div class="cell large-8 medium-8 small-12">
						$nouveau_doc
					</div>
				</section> 		
HERE;
	
	}// showDocument($_data)
	
	// index.php - form_document()
	public function formDocument($_data)
	{	
		$data_fiches = isset($_data['FICHES']) ? $_data['FICHES'] : '';

		$data_doc = isset($_data['DOCUMENTS']) ? $_data['DOCUMENTS'] : '';
  	 
		$mfiches = new MFiches();
		$f = $mfiches->SelectAllTitresFiches();

		$selected = '';
		$options = '';
		foreach ($f as $val1)
		{
			if ($data_fiches)
			{
				foreach ($data_fiches as $val2)
				{
					$selected = (isset($val2['ID_FICHE']) && $val1['ID_FICHE'] == $val2['ID_FICHE']) ? 'selected="selected"' : '';
  	    
					if ($selected) break;
				}
			}

			$options .= '<option '.$selected.' value="'.$val1['ID_FICHE'].'">'.$val1['FICHE_TITRE'].'</option>';
  	  	
			$delete = $data_doc ? '<a href="../Php/index.php?EX=delete_document&amp;ID_DOC='.$data_doc['ID_DOC'].'"><p class="button">Supprimer</p></a>' : '';
		}

		if ($data_doc)
		{
			$titre = $data_doc['TITRE'];
			$document = $data_doc['DOCUMENT'];
			$ex = 'update_document&amp;ID_DOC='.$data_doc['ID_DOC'];
			$titre_doc = '<h1 class="h3">Formulaire Supprimer Modifier Document</h1>';
		}
		else
		{
			$titre = '';
			$document = '';
			$ex = 'insert_document';
			$titre_doc = '<h1 class="h3">Formulaire Nouvelle Document</h1>';
		}
  	
  	echo <<<HERE
	<section>
		<form action="../Php/index.php?EX=$ex" method="post" enctype="multipart/form-data">
			<div class="grid-x">
				<div class="cell large-8 large-offset-2 medium-8 medium-offset-2 small-12 text-center"> 
					<header>					
							$titre_doc
					</header>
					<div class="grid-x">
						<div class="large-2 medium-2 small-12 cell">
							<label for="titre" class="text-left middle">Titre</label>
						</div>	
						<div class="large-10 medium-10 small-12 cell">			
							<input id="titre" name="TITRE" type="text" value="$titre" size="45" maxlength="200" />								
						</div>
						
						<!--
						<div class="large-2 medium-2 small-12 cell">
							<label for="document" class="text-left middle">Document</label>
						</div>
						<div class="large-10 medium-10 small-12 cell">
							<input id="document" name="DOCUMENT" type="text" value="$document" size="15" maxlength="50" />
						</div>
						-->
						<div class="large-2 medium-2 small-12 cell">
							<label class="text-left">
								Document
							</label>
						</div>
						<div class="large-12 medium-12 small-12 cell">
							<textarea name="DOCUMENT" rows="5" cols="33">$document</textarea>
						</div>
						
						
						<div class="large-2 medium-2 small-12 cell">
							<label for="fiches" class="text-left middle">Fiches</label>
						</div>
						<div class="large-10 medium-10 small-12 cell">
							<select id="fiches" name="ID_FICHE[]" multiple="multiple">
								$options
							</select>
						</div>
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

  	return;
	
	} // formDocument($_data)
	
	// index.php - lesdocuments()
	public function showLesDocuments()
	{
		$mdocu = new MDocuments();
		$data = $mdocu-> SelectAllDocumentsPages();
		$lesDocu = '';
		
		foreach($data as $val)
		{
			$lesDocu .= 	'			
								<div class="cell large-6 medium-6 small-12 ma_bordure_bottom_bleu gestion-image-fiche">
									<div class="effet-survol-image">
										<img src="../img/d.jpg" alt="image d">
										<div class="effet-contenu">
											<h2>'.$val['TITRE'].'</h2>
										</div>
									</div>						
								</div>
								
								<div class="cell large-6 medium-6 small-12 text-center ma_bordure_bottom_bleu ma_cellule_gris">
									<h2 class="gestion-titre-fiche"><a href="../Php/index.php?EX=la_fiche&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']).'&amp;ID_DOC='.urlencode($val['ID_DOC']).'">'.$val['TITRE'].'</a></h2>	
									<p class="gestion-texte">
										'.$val['DOCUMENT'].'
									</p>	
									<a class="button" href="../Php/index.php?EX=la_fiche&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']).'&amp;ID_DOC='.urlencode($val['ID_DOC']).'">En savoir plus?</a>							
								</div>
							';
		}
		
		echo <<<HERE
				<section class="grid-x affichage_fiche_doc">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Les documents</h1>
						</header>	
					</div>
					$lesDocu
				</section>
HERE;

	} // showLesDocuments()
	
} // VDocuments ()
?>