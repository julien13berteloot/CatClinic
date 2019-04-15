<?php
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
		$li='';
		$li .= '<li><a href="../Php/index.php?EX=home">Home</a></li>';
		$li .= '<li><a href="../Php/index.php?EX=lesfiches">Fiches</a></li>';
		$li .= '<li><a href="../Php/index.php?EX=lesdocuments">Documents</a></li>';
		$li .= '<li><a href="../Php/index.php?EX=contact">Contact</a></li>';
		
		$mfiches = new MFiches();
		$data['FICHES_TITRES'] = $mfiches->SelectAllTitresFiches();
		$fiches_titres = '';
		foreach ($data['FICHES_TITRES'] as $val)
		{
			$href = '../Php/index.php?EX=fiche&amp;ID_FICHE='.urlencode($val['ID_FICHE']).'&amp;FICHE_TITRE='.urlencode($val['FICHE_TITRE']);
			$fiches_titres .= '<li class="list-group-item"><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
		}

		echo '
			<div class="grid-x ma_cellule_bleu mon-footer">
				<div class="cell large-12 medium-12 small-12 text-center">
					<header>
						<h1 class="h3">Clinique vétériniaire CatClinic</h1>
					</header>
				</div>
				<div class="cell large-4 medium-4 small-12 padding-footer">
					<h2 class="h4">Menu</h2>
		';
		echo <<<HERE
					<ul class="no-bullet">
						$li
					</ul>
					<h2 class="h4">Aside</h2>
					<ul class="no-bullet">
						$fiches_titres
					</ul>
HERE;
		echo '
				</div>
				<div class="cell large-4 medium-4 small-12 padding-footer border-footer">
					<h2 class="h4">Adresse</h2>
					<p class="h5">Route des chats noirs</p>
					<p class="h5">38270 Jarcieu</p>
					<br />
					<h2 class="h4">Mentions légales</h2>
					<a href="../Texte/mentions-legales.txt"
					download="mentions-legales">Télécharger les Mentions légales</a>
				</div>
				<div class="cell large-4 medium-4 small-12 padding-footer">
					<h2 class="h4">Contact</h2>
					<p class="h5">catclinic@gmail.fr</p>
					<p class="h5">Tel: 06.13.13.13.13</p>
					<h2 class="h4">Horaire</h2>
					<p>Du Lundi au Vendredi de 8h30 à 19h30</p>
					<p>Le Samedi de 8h30 à 18h00</p>
					<p>Le Dimanche de 10h00 à 12h00</p>
					<h2 class="h4">Urgences</h2>
					<p>Assurées 24h/24 et 7j/7 après appel téléphonique</p>
				</div>
			</div>
			
			
		</div> <!-- END grid-container -->
		';
	}
  
} // VFooter

?>