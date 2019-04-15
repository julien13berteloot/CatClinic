<?php
/**
 * Fichier de classe de type Vue
 * pour l'affichage des données de contact
 * @author Christian Bonhomme
 * @version 1.0
 * @package MVC
 */
 
/**
 * Classe pour l'affichage des données de contact
 */
class VSpecialites
{
	/**
	* Constructeur de la classe VContacts
	* @access public
	*        
	* @return none
	*/
	public function __construct(){}
  
	/**
	* Destructeur de la classe VContacts
	* @access public
	*        
	* @return none
	*/
	public function __destruct(){}
  

	public function showSpecialites($_contacts)
	{
		$spe= '';	
		foreach($_contacts as $val)
		{
			$spe .= 	'<tr>
								<td class="table-texte">'.$val['NOM'].'</td>
						</tr>';
		}
		
		echo <<<HERE
				<section> 
					<div class="grid-x align-center">
						<div class="cell large-12 text-center">
							<header>
								<h1 class="h3">Gestion des Spécialités</h1>
							</header>	
						</div>
						<div class="cell large-4 medium-4 small-12 text-center">
							<table class="hover stack">
								<thead>
									<tr>
										<th class="text-center table-texte">Spécialités</th>
									</tr>
								</thead>
								<tbody>
										$spe	
								</tbody>	
							</table>
						</div>
					</div>	
					<div class="grid-x align-center">
						<div class="cell large-4 medium-4 small-12 text-center">
							<p><button class ="button" id="admin_spe">Administrer</button><p>
						</div>
						<div class="cell large-4 medium-4 small-12 text-center">
							<p><button class ="button" id="return_spe">Retour</button></p>
						</div>
					</div>	
				</section>
HERE;
	   
		return;
    
	} // showSpecialites($_contacts)
  
	public function showAdminSpecialites($_specialite)
	{
		echo '
		<section>
		<form>
		<div class="grid-x">
		<div class="cell large-8 large-offset-2 medium-8 medium-offset-2 small-12 text-center">
			<header>					
				<h1 class="h3">Formulaire Modifier Supprimer des Specialités</h1>
			</header>
			
		';  
	 
		foreach($_specialite as $val)
		{
			echo '<p id="'.$val['ID_SPECIALITES'].'"><span class="nom">' . $val['NOM'] .'</span></p>';
		}
	
		echo '<p><button class ="button" id="update_spe">Modifier</button></p>';
	
		echo '</form>';
		
		echo '<p><button class ="button" id="delete_spe">Supprimer</button></p>';
	
		echo '<p><button class ="button" id="normal_spe">Mode normal</button></p>';
		
		echo '
				
		</div>
		</div>
		</section>
		';
  
		return;
  
	} // showAdminSpecialites($_specialite)
  
  
} // VSpecialites
?>