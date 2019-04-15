<?php
/**
 * Fichier de classe de type Vue
 * pour l'affichage des données des employés
 * @author Christian Bonhomme
 * @version 1.0
 * @package MVC
 */
 
/**
 * Classe pour l'affichage des données des employés
 */
class VDocteurs
{
	/**
	* Constructeur de la classe VEmployers
	* @access public
	*        
	* @return none
	*/
	public function __construct(){}
  
	/**
	* Destructeur de la classe VEmployers
	* @access public
	*        
	* @return none
	*/
	public function __destruct(){}
  
	/**
	* Affichage des données de employer
	* @access public
	* @param array données de employer 
	*
	* @return none
	*/
	public function showDocteur($_doc)
	{
		$docteur = '';
		foreach($_doc as $val)
		{
			$docteur .=		'<tr>
									<td class="table-texte">'.$val['NOM'].'</td>
									<td class="table-texte">'.$val['PRENOM'].'</td>
							</tr>';
		}

		echo <<<HERE
				<section class="grid-x align-center">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Administration docteur</h1>
						</header>	
					</div>
					<div class="cell large-8 medium-8 small-12">

						<table class="hover stack">
							<thead>
								<tr>
									<th class="table-texte">Nom</th>
									<th class="table-texte">Prenom</th>
								</tr>
							</thead>
							<tbody>
									$docteur	
							</tbody>	
						</table>
						
					</div>
					<div class="cell large-8 medium-8 small-12">
						<div class="grid-x">
							<div class="cell large-6 medium-6 small-12">
								<p><button class="button" id="admin_doc">Administrer</button><p>
							</div>
							<div class="cell large-6 medium-6 small-12">
								<p><button class="button" id="return_doc">Retour</button></p>
							</div>	
						</div>
					</div>

				</section>
	
HERE;

		return;
    
	} // showDocteur($_employers)
  
	/**
	* Affichage des données de contact en mode administration
	* @access public
	* @param array données de contact 
	*
	* @return none
	*/
	public function showAdminDoc($_doc)
	{
		echo '
		<section> 
			<div class="grid-x align-center">
				<div class="cell large-12 medium-12 small-12 text-center">
					<header>					
						<h1 class="h3">Formulaire gestions des docteurs</h1>
					</header>
				</div>
				<form>
				<div class="cell large-8 medium-8 small-12 text-center">
		';
						 
							foreach($_doc as $val)
							{
								echo ' 
									<p id="'.$val['ID_DOCTEUR'].'"><span class="nom">' . $val['NOM'] .'</span>
									<span class="prenom"> ' .$val['PRENOM'].'</span></p>		
									';
								}
						
		echo'
		</div>
			<div class="cell large-8 medium-8 small-12 text-center">
				<p><button class="button" id="update_doc">Modifier</button></p>
			</div>
		</form>

	</div>
		
	<div class="grid-x align-center">
		<div class="cell large-4 medium-4 small-12 text-center">
			<p><button class="button" id="delete_doc">Supprimer</button><p>
		</div>
		<div class="cell large-4 medium-4 small-12 text-center">
			<p><button class="button" id="normal_doc">Mode normal</button></p>
		</div>	
	</div>	
</section>
		';
  
		return;
  
	} // showAdminDoc($_doc)
  
} // VDocteurs
?>