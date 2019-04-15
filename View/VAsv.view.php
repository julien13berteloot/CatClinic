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
class VAsv
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
	public function showAsv($_asv)
	{
		$asv = '';
		foreach($_asv as $val)
		{
			$asv .=		'<tr>
							<td class="table-texte">'.$val['NOM'].'</td>
							<td class="table-texte">'.$val['PRENOM'].'</td>
						</tr>';
		}
		echo <<<HERE
				<section class="grid-x align-center">
					<div class="cell large-12 text-center">
						<header>
							<h1 class="h3">Administration ASV</h1>
						</header>	
					</div>
					<div class="cell large-8 medium-8 small-12">

						<table class="hover stack">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Prenom</th>
								</tr>
							</thead>
							<tbody>
									$asv	
							</tbody>	
						</table>
						
					</div>
					<div class="cell large-8 medium-8 small-12">
						<div class="grid-x">
							<div class="cell large-6 medium-6 small-12">
								<p><button class="button" id="admin_asv">Administrer</button><p>
							</div>
							<div class="cell large-6 medium-6 small-12">
								<p><button class="button" id="return_asv">Retour</button></p>
							</div>	
						</div>
					</div>

				</section>
	
HERE;

		return;

	} // showAsv($_asv)
  
   /**
   * Affichage des données de contact en mode administration
   * @access public
   * @param array données de contact 
   *
   * @return none
   */
  public function showAdminAsv($_doc)
  {
	echo '
		<section> 
			<div class="grid-x align-center">
				<div class="cell large-12 medium-12 small-12 text-center">
					<header>					
						<h1 class="h3">Formulaire gestions des asv</h1>
					</header>
				</div>
				<form>
				<div class="cell large-8 medium-8 small-12 text-center">
		';  
	 
  	foreach($_doc as $val)
	{
		echo '<p id="'.$val['ID_ASV'].'"><span class="nom">' . $val['NOM'] .'</span><span class="prenom"> ' .$val['PRENOM'].'</span></p>';
	}
	
	echo'
			</div>
				<div class="cell large-8 medium-8 small-12 text-center">
					<p><button class="button" id="update_asv">Modifier</button></p>
				</div>
			</form>

		</div>
			
		<div class="grid-x align-center">
			<div class="cell large-4 medium-4 small-12 text-center">
				<p><button class="button" id="delete_asv">Supprimer</button><p>
			</div>
			<div class="cell large-4 medium-4 small-12 text-center">
				<p><button class="button" id="normal_asv">Mode normal</button></p>
			</div>	
		</div>	
	</section>
		';
  
  	return;
  
  } // showAdmin($_contacts)
  
} // VAsv
?>