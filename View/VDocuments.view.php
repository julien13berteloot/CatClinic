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
		// ASIDE - Les fiches par titres
		$fiches_titres = '';
		foreach ($_data['FICHES_TITRES'] as $val)
		{			
			if (isset($_SESSION['ADMIN']))
			{
				$href = '';
			}
			else
			{
				$href = '../Php/index.php?EX=document&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
			}			
			$fiches_titres .= '<li><a  href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';			
		}
		// ASIDE - Les documents 
		$fiches_documents = '';
		foreach ($_data['DOCUMENTS'] as $val)
		{			
			if (isset($_SESSION['ADMIN']))
			{
				$href = '';
			}
			else
			{
				$href = '../Php/index.php?EX=doc&amp;ID_DOC='.$val['ID_DOC'];
			}			
			$fiches_documents .= '<li><a href="'.$href.'">'.$val['TITRE'].'</a></li>';			
		}
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
							<a href="">
								<h2 class="card-title"><a href="../Php/index.php?EX=doc&amp;ID_FICHE='.$val['ID_FICHE'].'">'.$val['FICHE_TITRE'].'</h2>
							</a>
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
			$prenom_employer = '<td>' . $val['PRENOM'].'<td>';
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
			$prenom_employee = '<td>' . $val['PRENOM'].'<td>';
			$structure_avs .= '<tr>' . $nom_employee . $prenom_employee . '</tr>';
		}
		
		// Caroussel
		echo '
		<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
			<div class="orbit-wrapper">
				<div class="orbit-controls">
				  <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
				  <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
				</div>
				<ul class="orbit-container">
					<li class="is-active orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/999?text=Slide-1" alt="Space">
							<figcaption class="orbit-caption">Space, the final frontier.</figcaption>
						</figure>
					</li>
					<li class="orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/888?text=Slide-2" alt="Space">
							<figcaption class="orbit-caption">Lets Rocket!</figcaption>
						</figure>
					</li>
					<li class="orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/777?text=Slide-3" alt="Space">
							<figcaption class="orbit-caption">Encapsulating</figcaption>
						</figure>
					</li>
					<li class="orbit-slide">
						<figure class="orbit-figure">
							<img class="orbit-image" src="https://placehold.it/1200x600/666&text=Slide-4" alt="Space">
							<figcaption class="orbit-caption">Outta This World</figcaption>
						</figure>
					</li>
				</ul>
			</div>
			<nav class="orbit-bullets">
				<button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
				<button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
				<button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
				<button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
			</nav>
		</div>
		';
		
		// Aside	
		echo '			
		<div id="id_sticky_aside" class="grid-x">

			<aside class="cell large-3 right" data-sticky-container>
				<div class="sticky" data-sticky data-margin-top="5" data-top-anchor="id_sticky_aside:top">
					<div class="grid-x ">
						<div class="cell large-12;">
							<h2 class="callout">Titres</h2>	
						</div>
						<div class="cell large-12 ma_cellule_blanc">					
		';
								echo <<<HERE
								<ul>
									$fiches_titres
								</ul>
HERE;
		echo '
						</div>
						<div  class="cell large-12">
								<h2 class="callout">Documents</h2>	
							</div>
							<div class="cell large-12">
		';						
									echo <<<HERE
									<ul>
										$fiches_documents		
									</ul>
HERE;
		echo '						
							</div>
							<div  class="cell large-12">
								<h2 class="callout">Auteurs</h2>	
							</div>
							<div class="cell large-12 ma_cellule_blanc">
								<dl>
									<dt>
										Remain, André
									</dt>
										<dd>
											Administration des médicaments
										</dd>
										<dd>
											Les dangers domestiques
										</dd>									
									<dt>
										Burlotte, Sylvie
									</dt>
										<dd>
											Maladies et vaccination
										</dd>
								</dl>
							</div>
						</div>
					</div>		
			</aside>
		
		
		<!-- Contenu droite - Rubrique - La clinique - Services - télphone -->
		
			<div id="id_sticky_content" class="cell large-9">
		
				
					<div class="grid-x ma_cellule_bleu">
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
					
					<div class="grid-x ma_cellule_gris">
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
				
				
				
				
				
			</div> <!-- END Contenu Droite -->
				
		</div> <!-- END grid-x --> 
			
	</div> <!-- END grid-container -->		
';
		return;	
	} //showDocAccueil($_data)  
  

  
  

  
  
  
  
  
  
  
} // VDocuments
?>
