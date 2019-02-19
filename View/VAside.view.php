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
		// Les sections
		
		$mfiches = new MFiches();
		$_data['FICHES_TITRES'] = $mfiches->SelectAllFiches();
		// Les Documents
		$mdocuments = new MDocuments();
		$_data['DOCUMENTS'] = $mdocuments->SelectAllDocument();
		$_data['DOCUMENTS_FICHE'] = $mdocuments->SelectAllFicheDocument();
		
		// ASIDE - Les fiches par titres
			
		$fiches_titres = '';
		foreach ($_data['FICHES_TITRES'] as $val)
		{			
			if (isset($_SESSION['ADMIN']))
			{
				$href = '../Php/index.php?EX=form_fiche&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
			}
			else
			{
				//$href = '../Php/index.php?EX=document&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
				//$href = '../Php/index.php?EX=document&amp;ID_FICHE='.$val['ID_FICHE'];
				
				//$href = '../Php/index.php?EX=document&amp;FICHE_TITRE='.$val['FICHE_TITRE'].'&amp;ID_FICHE='.$val['ID_FICHE'];
				$href = '../Php/index.php?EX=document&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'];
			}	
			$fiches_titres .= '<li><a  href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			//$fiches_titres .= '<li><a href="'.$href.'">'.$val['FICHE_TITRE'].'</a></li>';
			//$fiches_documents .= '<li><a href="../Php/index.php?EX=doc&amp;ID_DOC='.$val['ID_DOC'].'">'.$val['TITRE'].'</a></li>';
	
//$fiches_titres .= '<li><a href="../Php/index.php?EX=document&amp;ID_FICHE='.$val['ID_FICHE'].'&amp;FICHE_TITRE='.$val['FICHE_TITRE'].'">'.$val['FICHE_TITRE'].'</a></li>';			

			
		}
		// ASIDE - Les documents 
		$fiches_documents = '';
		foreach ($_data['DOCUMENTS'] as $val)
		{			
			if (isset($_SESSION['ADMIN']))
			{
				$href = '../Php/index.php?EX=form_document&amp;ID_DOC='.$val['ID_DOC'];
			}
			else
			{
				$href = '../Php/index.php?EX=doc&amp;ID_DOC='.$val['ID_DOC'];
			}		
			$fiches_documents .= '<li><a href="'.$href.'">'.$val['TITRE'].'</a></li>';			
		}
		
		echo '
		
		
				<div class="sticky" data-sticky data-margin-top="5" data-top-anchor="id_sticky_aside:top" data-btm-anchor="foo:bottom">
					<div class="grid-x ">
						<div class="cell large-12;">
							<h2 class="callout">Section</h2>	
						</div>
						<div class="cell large-12">
							<ul data-magellan>
								<li><a href="#first">La clinique</a></li>
								<li><a href="#second">Services</a></li>
								<li><a href="#third">Fiches</a></li>
								<li><a href="#four">Employers</a></li>
								<li><a href="#five">Spécialités</a></li>
							</ul>
						</div>
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
			
		
		';
	}
	
	public function formFiche($_data)
	{
		if ($_data)
		{
			//$ex = 'update_theme&ID_THEME='.$_data['ID_THEME'];
			//$theme = $_data['THEME'];
			//$delete = '<p class="delete"><a href="../Php/index.php?EX=delete_theme&amp;ID_THEME='.$_data['ID_THEME'].'"><button>Supprimer</button></a></p>';
		}
		else
		{
			//$ex = 'insert_fiche';
			$fiche = '';
			//$delete = '';
		}
	
		echo <<<HERE
		<div class="grid-x ma_cellule_bleu" id="first" data-magellan-target="first">
			<div class="cell text-center">
				<header>
					<h1>Formulaire changement Fiche</h1>
				</header>	
			</div>								
		</div>
		<form data-abide novalidate action="../Php/index.php?EX=insert_fiche" method="post">
			<div data-abide-error class="alert callout" style="display: none;">
				<p><i class="fi-alert"></i>Vous avez oubliez un ou plusieurs champs.</p>
			</div>
			<div class="grid-x ma_cellule_gris" style="">
				<div class="cell large-8 large-offset-2">
					<div class="grid-x">
						<div class="small-2 cell">
							<label for="fiche" class="text-left middle">Fiche</label>
						</div>
						<div class="small-10 cell">			
							<input class="" id="fiche" name="FICHE_TITRE" value="" type="text" placeholder="fiche" 
							aria-describedby="examplefiche" aria-errormessage="exampleErrorfiche" required pattern="text">
							<span class="form-error" id="exampleErrorfiche">
								Required!
							</span>	
							<p class="help-text" id="exampleLogin">Entrer le nom d'une fiche.</p>		
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
HERE;

	} // formFiche($_data)
  
} // VAside

?>