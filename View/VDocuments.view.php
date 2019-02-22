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
	
	/**
	* Affichage des documents de la page home
	* @param array données des documents
	*
	* @return none
	*/
	public function showDocAccueil($_data)
	{		
		// Contenu droite - Rubrique Fiches
		$last_rubrique ='';
		foreach ($_data['DOCUMENTS_FICHE'] as $val)
		{
			$last_rubrique .= 
			'	
			<div class="cell large-6">
				<div class="design-card card">
					<div class="card-animation"></div>
					<a href="">
						<img src="../image/b.jpg" alt="">
					</a>
					<div class="conteneur-card">
						<div class="card-section text-center">
							<h2 class="card-title"><a href="../Php/index.php?EX=doc&amp;ID_FICHE='.$val['ID_FICHE'].'">'.$val['FICHE_TITRE'].'</a></h2>
							<h3 class="h5">'.$val['TITRE'].'</h3>
							<p class="card-texte">'.$val['DOCUMENTS'].'</p>
						</div>
					</div>
					<div class="card-divider flex-container  align-center">
						<a class="button large" href="../Php/index.php?EX=doc&amp;ID_FICHE='.$val['ID_FICHE'].'">En savoir plus?</a>
					</div>
					<div class="card-animation"></div>
				</div>
			</div>
			';
		}	
		// Contenu droite - Rubrique Employers - DOCTEURS
		$nom_employer='';
		$prenom_employer='';
		$metier='';
		$structure_docteur="";
		foreach($_data['EMPLOYER_DOCTEUR'] as $val)
		{
			$nom_employer = '<td>' . $val['NOM'].'</td>';
			$prenom_employer = '<td>' . $val['PRENOM'].'</td>';
			$structure_docteur .= '<tr>' . $nom_employer . $prenom_employer . '</tr>';
		}
		// Contenu droite - Rubrique Employers - AVS
		$nom_employee='';
		$prenom_employee='';
		$metier_avs='';
		$structure_avs="";
		foreach($_data['EMPLOYER_AVS'] as $val)
		{
			$nom_employee = '<td>' . $val['NOM'].'</td>';
			$prenom_employee = '<td>' . $val['PRENOM'].'</td>';
			$structure_avs .= '<tr>' . $nom_employee . $prenom_employee . '</tr>';
		}
		// Contenu - Rubrique Les Specilaites
		$specialites = '';
		foreach ($_data['SPECIALITES'] as $val)
		{
			$specialites .= '<div class="masonry-css-item">
								<div class="callout">'
									.$val['NOM_SPECIALITES'].
								'</div>
							</div>';			
		}
		
		
		
		// Aside	
		echo '		
		<!-- GRILLE PRINCIPALE -->
		<!--<div id="id_sticky_aside" class="grid-x ma-grille-principal">-->
		
		
		<!-- GRILLE CONTENUE -->
			<!--<div id="id_sticky_content" class="cell large-9">-->

			
		<!-- Contenu droite - La Clinique -->	
					<div class="grid-x ma_cellule_bleu" id="first" data-magellan-target="first" style="padding:50px 0;">
						<div class="cell text-center">
							<header>
								<h1>La clinique</h1>
							</header>	
						</div>			
						<div class="cell large-3 large-offset-1 ma_margin">
							<img src="../image/bbb_copie.jpg" alt="">
						</div>
						<div class="cell large-7 large-offset-1 ma_margin">
							<p class="text-left">
							<span class="typo_blanc"><strong>La clinique vétérinaire Cat Clinic</strong></span><br />
							Spécialisée dans l\'accueil et le soin des félins (chat, hyenes, tigres du bengales, etc..)
							</p>
						</div>			
					</div>
					
					
		<!-- Contenu droite - Services -->			
					<div class="grid-x ma_cellule_gris" id="second" data-magellan-target="second" style="padding:50px 0;">
						<div class="cell text-center">
							<header>
								<h1>Services</h1>
							</header>
						</div>
						<div class="cell large-4  text-center">
							<span class="badge bordure-bleu-badge">
								<i class="fi-first-aid" style=""></i>
							</span>
							<p class="">
							Quam ob rem ut ii qui superiores sunt submittere se debent in amicitia, sic quodam modo inferiores extollere.
							</p>
							<a class="button large" href="#">So Large</a>
						</div>
						<div class="cell large-4  text-center">
							<span class="badge bordure-bleu-badge">
								<i class="fi-folder-add" style=""></i>
							</span>
							<p class="">
							Quam ob rem ut ii qui superiores sunt submittere se debent in amicitia, sic quodam modo inferiores extollere.
							</p>
							<a class="button large" href="#">So Large</a>
						</div>
						<div class="cell large-4  text-center">
							<span class="badge bordure-bleu-badge">
								<i class="fi-address-book" style=""></i>
							</span>
							<p class="">
							Quam ob rem ut ii qui superiores sunt submittere se debent in amicitia, sic quodam modo inferiores extollere.
							</p>
							<a class="button large" href="#">So Large</a>
						</div>	
					</div>

					
		<!-- Contenu droite - Télphone -->		
				<div class="grid-x ma_cellule_bleu align-center " style="border-bottom:3px solid #FFA500; ">	
					<div class="cell large-1 text-right">
						<span><i class="fi-telephone h1"></i></span>
					</div>
					<div class="cell large-7" style="margin:auto 0;">
						<h3>Notre Téléphone : 06 13 13 13 13</h3>
					</div>						
				</div>
			
		<!-- Contenu droite - FICHES -->
			
				<div class="grid-x grid-margin-x" id="third" data-magellan-target="third" style="padding:50px 0;">
				
					<div class="cell text-center">
						<header>
							<h1>Fiches</h1>
						</header>
					</div>
		';			
					echo <<<HERE
					$last_rubrique	
HERE;
		echo '			
				</div> <!-- end Fiches -->	
				
		<!-- Contenu droite - Email -->		
				<div class="grid-x ma_cellule_bleu align-center " style="border-bottom:3px solid #FFA500; margin-bottom:3px;">	
					<div class="cell large-1 text-right">
						<span><i class="fi-mail h1"></i></span>
					</div>
					<div class="cell large-7" style="margin:auto 0;">
						<h3>Notre Email : monmail@gmail.fr</h3>
					</div>						
				</div>
				
		<!-- Contenu droite - Employers -->		
				<div class="grid-x  ma_cellule_gris align-center" id="four" data-magellan-target="four" style="padding:50px 0;" >
						<div class="cell text-center">
							<header>
								<h1>Employers</h1>
							</header>
						</div>
						<div class="cell large-4  text-center">
							<ul class="vertical menu accordion-menu icons icon-top menu-picto" data-accordion-menu>
								<li>
									<a href="#">
										<span class="ma_margin bordure-bleu-picto picto" style=""> 
											<i class="taille-icons fi-book-bookmark"></i>	
										</span>
										<span class="mon-lien h4">
											Les Docteurs
										</span>																				
										<i class="taille-icons mon-lien fi-arrow-down"></i>
									</a>
									<ul class="menu vertical">
										<li>
											<table class="hover stack">
												<thead>
													<tr>
														<th>Nom</th>
														<th>Prenom</th>	  
													</tr>
												</thead>
		';
											echo <<<HERE
												<tbody>
													$structure_docteur
												</tbody>
HERE;
		echo '	
											</table>
										</li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="cell large-4  text-center">
							<ul class="vertical menu accordion-menu icons icon-top menu-picto" data-accordion-menu>
								<li>
									<a href="#">
										<span class="ma_margin bordure-bleu-picto picto" style=""> 
											<i class="taille-icons fi-torsos-all-female"></i>	
										</span>
										<span class="mon-lien h4">
											Les AVS
										</span>																				
										<i class="taille-icons mon-lien fi-arrow-down"></i>
									</a>
									<ul class="menu vertical">
										<li>
											<table class="hover stack">
												<thead>
													<tr>
														<th>Nom</th>
														<th>Prenom</th>	  
													</tr>
												</thead>
		';
											echo <<<HERE
												<tbody>
													$structure_avs
												</tbody>
HERE;
		echo '																							
											</table>
										</li>
									</ul>
								</li>
							</ul>
						</div>				
				</div> <!-- end Employers -->
				
		<!-- Contenu droite - Spécialisée -->		
				<div class="grid-x  align-center" id="five" data-magellan-target="five" style="padding:50px 0;" >
					<div class="cell large-12 text-center">
						<header>
							<h1>Spécialités</h1>
						</header>
					</div>
					<div  id="foo" class="cell large-12 masonry-css">
		';				
						echo <<<HERE
							$specialites
HERE;
		echo '
					</div>
				</div> <!-- END Contenu Spécialisée -->	
				
			<!--</div>--> <!-- END Contenu Droite -->		 
			
';

		return;	
	} //showDocAccueil($_data)  
  

	public function showDoc($_data)
	{
		echo '
			<div class="grid-x">
				<div class="cell text-center ma_cellule_bleu">
					<h1 class="h2">' . $_data['TITRE'] . '</h1>
				</div>
				<div class="cell">
					<p class="card-section">' . $_data['DOCUMENTS'] . '</p>' . $_data['ID_DOC'].' 
				</div>
			</div>			
		';	
	} // showDoc($_data)
	
	
	public function showDocuments($_data)
	{ 	
		echo '<div class="grid-x">';
		$doc_content='';
		
		foreach ($_data as $val)
		{			
			$doc_content .= '
							<div class="cell large-12 ma_cellule_gris">
								<h2 class="h3">
									<a href="../Php/index.php?EX=doc&amp;ID_DOC='.$val['ID_DOC'].'&amp;ID_FICHE='. $val['ID_FICHE'].'"> ' . $val['TITRE'] . '</a>
								</h2> 
							</div>
							<div class="cell large-12">
								<p class="card-section">' . $val['DOCUMENTS'] . '</p>' 
								. $val['ID_DOC'] .'-'. $val['ID_FICHE'].'
							</div>
							<div class="cell large-12 text-center">
								<a class="button large" href="../Php/index.php?EX=doc&amp;ID_DOC='.$val['ID_DOC'].'&amp;ID_FICHE='. $val['ID_FICHE'].'">Lire la suite?</a>		
							</div>				
							';
		}
		
		echo <<<HERE
		<div class="cell text-center ma_cellule_bleu">
		<h1 class="h2">{$_SESSION['FICHE_TITRE']}</h1>
		</div>
		$doc_content
HERE;
		echo '</div>';
  
	} // showDocuments($_data)
  

	public function formDocument($_data)
	{
		$data_fiches = isset($_data['FICHES']) ? $_data['FICHES'] : '';

		$data_doc = isset($_data['DOCUMENTS']) ? $_data['DOCUMENTS'] : '';
		
		$mfiches = new MFiches();
		$mfiches = $mfiches->SelectAllFiches();
		
		$selected = '';
		$options = '';
		foreach ($mfiches as $val1)
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

			$delete = $data_doc ? '<p><a href="../Php/index.php?EX=delete_document&amp;ID_DOC='.$data_doc['ID_DOC'].'"><button>Supprimer</button></a></p>' : '';	
  	  	
		}
		
		if ($data_doc)
		{
			$titre = $data_doc['TITRE'];
			$document = $data_doc['DOCUMENTS'];
			//$fichier = $data_doc['FICHIER'];
	  
			//$fichier = ($data_doc['FICHIER']) ? 'Fichier : ' . $data_doc['FICHIER'] : 'Fichier';
			//$fichier_old = ($data_doc['FICHIER']) ? $data_doc['FICHIER'] : '';
			$ex = 'update_document&amp;ID_DOC='.$data_doc['ID_DOC'];
		}
		else
		{
			$titre = '';
			$document = '';
			//$fichier = '';
			// $fichier_old = '';
			$ex = 'insert_document';
		}

		
		
		echo <<<HERE
			<div class="grid-x ma_cellule_bleu" id="first" data-magellan-target="first">
				<div class="cell text-center">
					<header>
						<h1>Formulaire nouveau Documents</h1>
					</header>	
				</div>								
			</div>
			<form data-abide novalidate action="../Php/index.php?EX=$ex" method="post">
				<div data-abide-error class="alert callout" style="display: none;">
					<p><i class="fi-alert"></i>Vous avez oubliez un ou plusieurs champs.</p>
				</div>
				<div class="grid-x ma_cellule_gris" style="">
					<div class="cell large-8 large-offset-2">
						<div class="grid-x">
							<div class="small-2 cell">
								<label for="titre" class="text-left middle">Titre</label>
							</div>
							<div class="small-10 cell">			
								<input class="" id="titre" name="TITRE" value="$titre" type="text" placeholder="Titre" 
								aria-describedby="exampleTitre" aria-errormessage="exampleErrorTitre" required pattern="text">
								<span class="form-error" id="exampleErrorTitre">
									Required!
								</span>	
								<p class="help-text" id="exampleTitre">Entrer le titre.</p>		
							</div>

							<div class="small-2 cell">
								<label for="doc" class="text-left middle">Documents</label>
							</div>
							<div class="small-10 cell">			
								<input class="" id="doc" name="DOCUMENTS" value="$document" type="text" placeholder="Documents" 
								aria-describedby="exampleDoc" aria-errormessage="exampleErrorDoc" required pattern="text">
								<span class="form-error" id="exampleErrorDoc">
									Required!
								</span>	
								<p class="help-text" id="exampleDoc">Entrer le Documents.</p>		
							</div>		
						
							<div class="small-2 cell">
								<label for="fiche" class="text-left middle">Fiches</label>
							</div>
							<div class="small-10 cell">
								<select id="fiche" name="ID_FICHE[]" multiple="multiple" required>
									$options
								</select>
							</div>
						</div>
					</div>
									
					<div class="cell large-12" style="">
						<div class="grid-x">
							<div class="cell large-3 large-offset-2" style="">
								<button class="button large" type="submit" value="Submit">Ok</button>
							</div>
						</div>		
					</div>
				</div>
			</form>
			$delete
HERE;
	
		return;	

	} // formDocument($_data)
 
	public function formEmployer($_data)
	{

	$data_themes = isset($_data['METIERS']) ? $_data['METIERS'] : '';

  	$data_doc = isset($_data['EMPLOYER']) ? $_data['EMPLOYER'] : '';
  	 
  	$mthemes = new MMetiers();
  	$themes = $mthemes->SelectAll();

  	$selected = '';
  	$options = '';
  	foreach ($themes as $val1)
  	{
  	  if ($data_themes)
  	  {
  	    foreach ($data_themes as $val2)
  	    {
			
  	      $selected = (isset($val2['ID_METIER']) && $val1['ID_METIER'] == $val2['ID_METIER']) ? 'selected="selected"' : '';
  	    
  	      if ($selected) break;
  	    }
  	  }
	  
	  $options .= '<option '.$selected.' value="'.$val1['ID_METIER'].'">'.$val1['METIER'].'</option>';	  
  	  	
  	  $delete = $data_doc ? '<p class="delete"><a href="../Php/index.php?EX=delete&amp;ID_EMPLOYER='.$data_doc['ID_EMPLOYER'].'"><button>Supprimer</button></a></p>' : '';
  	}

  	if ($data_doc)
  	{
  	  $titre = $data_doc['PRENOM'];
 	  $auteur = $data_doc['NOM'];

 	  $ex = 'update&amp;ID_EMPLOYER='.$data_doc['ID_EMPLOYER'];
  	}
  	else
  	{
  	  $titre = '';
  	  $auteur = '';
 	  $ex = 'insert_employer';
  	}
	
	
	
	
	
  	
  	echo <<<HERE
<form action="../Php/index.php?EX=$ex" method="post" enctype="multipart/form-data">
 <fieldset>
  <legend>Formulaire</legend>
  <p>
   <label for="prenom">PRENOM</label>
   <input id="prenom" name="PRENOM" value="$titre" size="15" maxlength="50" />
  </p>
  <p>
   <label for="nom">NOM</label>
   <input id="nom" name="NOM" value="$auteur" size="15" maxlength="50" />
  </p>
  
  
  <p>
   <label for="metier">METIER</label>
   <select id="metier" name="ID_METIER[]" multiple="multiple">
    $options
   </select>
  </p>
  

  </p>
  <p class="submit">
   <input type="submit" value="Ok" />
  </p>
 </fieldset>
</form>
$delete
HERE;
  	
  	return; 
	   
	}
	
	public function formMetier($_data)
	{
		if ($_data)
    {
  	  $ex = 'update_metier&ID_METIER='.$_data['ID_METIER'];
      $fiche = $_data['METIER'];
 	  $delete = '<p><a href="../Php/index.php?EX=delete_metier&amp;ID_METIER='.$_data['ID_METIER'].'"><button>Supprimer</button></a></p>';
    }
    else
    {
  	  $ex = 'insert_metier';
      $fiche = '';
 	  $delete = '';
    }
	
	
    
    echo <<<HERE
<form action="../Php/index.php?EX=$ex" method="post">
 <fieldset>
  <legend>Formulaire</legend>
  <p>
   <label for="titre_fiche">METIER</label>
   <input id="titre_fiche" name="METIER" value="$fiche" size="15" maxlength="50" />
  </p>
  <p class="submit">
   <input type="submit" value="Ok" />
  </p>
 </fieldset>
</form>
$delete
HERE;
  	 
  	return;
	}
	
	public function showEmployer()
	{
		$tr = '';
    foreach ($_data as $val)
    {
      
      	// Concaténation avec l'ancre et le titre de la catégorie
      	$tr .= '<tr><td><a href="../Php/index.php?EX=form_metier&amp;ID_EMPLOYER='.$val['ID_EMPLOYER'].'">'.$val['PRENOM'].'</a></td><td>'.$val['NOM'].'</td>';
      
    }
	
	$nouveau = isset($_SESSION['ADMIN_DOC']) ? '<p class="nouveau"><a href="../Php/index.php?EX=form_document"><button>NOUVEAU DOCUMENT</button></a></p>' : '';
	
	
	echo <<<HERE
<h2>{$_SESSION['METIER']}</h2>
<table id="table_documents">
 <thead>
  <tr>
   <th>PRENOM</th><th>NOM</th>
  </tr>
 </thead>
 <tbody>
  $tr
 </tbody>
</table>
  		
$nouveau
  		
<div id="admin"><a href="../Php/index.php?EX=admin"></a></div>
HERE;
	}
	
	
	
	
		
 
} // VDocuments
?>
