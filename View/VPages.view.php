<?php
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
--------------------------------------------LA CLINIQUE--------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		echo'			
				<section class="mon-header grid-x grid-padding-x ma_cellule_bleu align-middle align-center" id="example2">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">La clinique</h1>
						</header>	
					</div>
					<div class="cell large-3 medium-3 small-12">
						<img src="../img/01.jpg" alt="Logo CatClinic">
					</div>
					<div class="cell large-7 medium-7 small-12">
						<span class="typo_blanc"><strong>La clinique vétérinaire Cat Clinic</strong></span><br />
						Spécialisée dans l\'accueil et le soin des félins (chat, hyenes, tigres du bengales, etc..).
					</div>
				</section>
		';		
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------SERVICES-----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		echo'
				<section class="grid-x ma_cellule_gris bordure_section_haut section_picto">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Services</h1>
						</header>	
					</div>
					
					<div class="cell large-4 medium-4 small-12">
						<span class="bordure-bleu-picto picto">
							<i class="taille-icons fi-first-aid"></i>
						</span>
						<h4>Fiches</h4>
						<p class="text_picto">Si vous voulez consulter l\'ensemble de nos fiches.</p>
						<a class="button large" href="../Php/index.php?EX=lesfiches">En savoir plus ?</a>
					</div>
					
					<div class="cell large-4 medium-4 small-12">
						<span class="bordure-bleu-picto picto">
							<i class="taille-icons fi-folder-add"></i>
						</span>
						<h4>Documents</h4>
						<p class="text_picto">Si vous voulez consulter l\'ensemble de nos documents.</p>
						<a class="button large" href="../Php/index.php?EX=lesdocuments">En savoir plus ?</a>
					</div>
					
					<div class="cell large-4 medium-4 small-12">
						<span class="bordure-bleu-picto picto">
							<i class="taille-icons fi-address-book"></i>
						</span>
						<h4>Spécialités</h4>
						<p class="text_picto">Si vous voulez consulter l\'ensemble de nos spécialités.</p>
						<a class="button large" href="#services">En savoir plus ?</a>
					</div>
				</section>
		';	
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------TELPHONE-----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		echo'
				<section class="grid-x grid-padding-x ma_cellule_bleu bordure_section_haut bordure_section_bas align-middle align-center">
					<div class="cell large-1 medium-1 small-12 hide-for-small-only">
						<span><i class="fi-telephone h1"></i></span>
					</div>
					<div class="cell large-7 medium-7 small-12">
						<h1 class="h4">Notre Téléphone : 06.13.13.13.13</h1>
					</div>
				</section>
		';		
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------LOCALISATION-HORAIRE-----------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		echo '
			<section class="grid-x ma-loca section-no-padding ma_cellule_bleu">
				<div class="cell large-12 text-center">
				<!--
					<header>
						<h1 class="h3">Localisation</h1>
					</header>	
				-->
				</div>
				<div class="cell large-8 medium-8 small-12">
					<div class=" conteneur-loca">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2804.5288342981894!2d4.946674015553215!3d45.338136079099684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f53ab5fdf83913%3A0x4480d6093bfb5d6a!2sRoute+des+Chats+Noirs%2C+38270+Jarcieu!5e0!3m2!1sfr!2sfr!4v1555077641894!5m2!1sfr!2sfr" style="border:0" allowfullscreen></iframe>				
					</div>				
				</div>
				<div class="cell large-4 medium-4 small-12 padding-loca ma_cellule_gris">
					<h2 class="h4 ma_cellule_blanche"><i class="fi-fast-forward padding-icon-loca"></i>Horaire</h2>
					<p>Du Lundi au Vendredi de <span class="gras">8h30 à 19h30</span></p>
					<p>Le Samedi de <span class="gras">8h30 à 18h00</span></p>
					<p>Le Dimanche de <span class="gras">10h00 à 12h00</span></p>
					<h2 class="h4 ma_cellule_blanche"><i class="fi-plus padding-icon-loca"></i>Urgences</h2>
					<p class="h5">Assurées <span class="gras">24h/24 et 7j/7</span></p> 
					<p>après appel téléphonique.</p>
				</div>
				
			</section>
		';
/*-------------------------------------------------------------------------------------------------------------------
-----------------------------------------------EMAIL-----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		echo'
				<section class="grid-x grid-padding-x ma_cellule_bleu bordure_section_haut bordure_section_bas align-middle align-center">
					<div class="cell large-1 medium-1 small-12 hide-for-small-only">
						<span><i class="fi-mail h1"></i></span>
					</div>
					<div class="cell large-7 medium-7 small-12">
						<h1 class="h4">Notre Email : catclinic@gmail.fr</h1>
					</div>
				</section>
		';
/*-------------------------------------------------------------------------------------------------------------------
--------------------------------------------FICHE--------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$yy = '';
		$fichesDernier = '';
		foreach ($_data['FICHESDERNIERE'] as $val)
		{
			$yy = '../Php/index.php?EX=ficheDocument&amp;ID_DOC='.urlencode($val['ID_DOC']).'&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
			
			$href = 'index.php?EX=fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
			//$fiches .= 	'<p><a href="'.urlencode($href).'">'.$val['FICHE_TITRE'].'</a>
			$fichesDernier = 	'<h2 class="gestion-titre-fiche-home"><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></h2>
								<p class="gestion-sous-titre-fiche-home">' .$val['TITRE'].'</p>
								';								
		}
		
		$y = '';	
		$fichesLastDernier = '';
		foreach ($_data['FICHESLASTDERNIERE'] as $val)
		{
			$y = '../Php/index.php?EX=ficheDocument&amp;ID_DOC='.urlencode($val['ID_DOC']).'&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
			
			$href = 'index.php?EX=fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
			//$fiches .= 	'<p><a href="'.urlencode($href).'">'.$val['FICHE_TITRE'].'</a>
			$fichesLastDernier = 	'<h2 class="gestion-titre-fiche-home"><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></h2>
									<p class="gestion-sous-titre-fiche-home"> ' .$val['TITRE'].'</p>
									';						
		}		
			
		echo <<<HERE
				<section class="grid-x fiche-home bordure_section_bas">
					<div class="cell large-12 text-center">
					
						<header>
							<h1 class="h3">Documents</h1>
						</header>	
					
					</div>
					
					<div class="cell large-6 medium-6 small-12 gestion-image-fiche-home ">
						<img src="../img/d.jpg" alt="image d">
					</div>
					<div class="cell large-6 medium-6 small-12 gestion-contenu-fiche-home"> 
						$fichesDernier
						<a class="button " href="$href">En savoir plus?</a>
					</div>
	

					<div class="cell large-6 medium-6 small-12 small-order-2 medium-order-1 gestion-contenu-fiche-home"> 
						$fichesLastDernier
						<a class="button " href="$href">En savoir plus?</a>
					</div>
					<div class="cell large-6 medium-6 small-12 small-order-1 medium-order-2 gestion-image-fiche-home">
						<img src="../img/b.jpg" alt="image d">
					</div>
				</section>
HERE;
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------DOCTEURS-ASV---------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$docteurs = '';
		$nom_doc = '';
		$prenom_doc = '';
		$structure_docteur = '';
		foreach ($_data['DOCTEURS'] as $val)
		{		
			$nom_doc = '<td class="table-texte">' . $val['NOM'].'</td>';
			$prenom_doc = '<td class="table-texte">' . $val['PRENOM'].'</td>';
			$structure_docteur .= '<tr>' . $nom_doc . $prenom_doc . '</tr>';
		}
		
		$asv = '';
		$nom_asv = '';
		$prenom_asv = '';
		$structure_asv = '';
		foreach ($_data['ASV'] as $val)
		{		
			$nom_asv = '<td class="table-texte">' . $val['NOM'].'</td>';
			$prenom_asv = '<td class="table-texte">' . $val['PRENOM'].'</td>';
			$structure_asv .= '<tr>' . $nom_asv . $prenom_asv . '</tr>';
		}
		
		echo <<<HERE

				<section class="grid-x align-center ma_cellule_gris bordure_section_bas section_picto ">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Employers</h1>
						</header>	
					</div>
				
					<div class="cell large-4 medium-4 small-12">
						<a href="#">
							<span class="bordure-bleu-picto picto">
								<i class="taille-icons fi-page-add"></i>
							</span>
						</a>
						<div class="cell small-12">
							<span class="h4">
								Les ASV
							</span>
						</div>
						<div class="cell small-12">		
							<i id="lienboxasv" class="taille-icons_fleche mon-lien fi-arrow-down"></i>
							<div id="boxasv">
								<table class="hover stack">
									<thead>
										<tr>
											<th class="table-texte">Nom</th>
											<th class="table-texte">Prenom</th>	  
										</tr>
									</thead>
										<tbody>
											$structure_asv
										</tbody>
								</table>
							</div>
						</div>
					</div>
  
					<div class="cell large-4 medium-4 small-12">
						<a href="#">
							<span class="bordure-bleu-picto picto">
								<i class="taille-icons fi-torso-business"></i>
							</span>
						</a>
						<div class="cell small-12">
							<span class="h4">
								Les Docteurs
							</span>
						</div>
						<div class="cell small-12">
							<i id="lienboxdocteur" class="taille-icons_fleche mon-lien fi-arrow-down"></i>
							<div id="boxdocteur">
								<table class="hover stack">
									<thead>
										<tr>
											<th class="table-texte">Nom</th>
											<th class="table-texte">Prenom</th>	  
										</tr>
									</thead>
										<tbody>
											$structure_docteur
										</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</section>

HERE;
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------SPECIALITES----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
		$specialites = '';
		foreach ($_data['SPECIALITES'] as $val)
		{
			$specialites .= '
							<div class="masonry-spe-item">
								<div class="callout">'
									.$val['NOM'].
								'</div>
							</div>
							';
		}
		
		echo '
			<section class="grid-x" id="services">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Spécialités</h1>
						</header>
					</div>
					<div class="cell large-12 masonry-spe">
		';				
						echo <<<HERE
						$specialites	
HERE;
		echo '
					</div>
			</section> <!-- END Contenu Spécialisée -->		
		';
/*-------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/		
	} // showPage($data)
	
		
 
} // VPages
?>
