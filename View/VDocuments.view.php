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
	
	
	public function showGestionDoc()
	{
		echo'GESTION DES DOCUMENTS';
	}
	
	
	/**
	* Affichage des documents de la page home
	* @param array données des documents
	*
	* @return none
	*/
	public function showDocument($_data)
	{	
		$document = '';
		foreach ($_data as $val)
		{
			$document .= '<p><a href="../Php/index.php?EX=form_document&amp;ID_DOC='.$val['ID_DOC'].'">'
			.$val['TITRE'].'</a></p>
			<p>'.$val['DOCUMENT'].'</p>';
		}
	
		$nouveau_doc = isset($_SESSION['ADMIN']) && (isset($_SESSION['ID_USER']) && (isset($_SESSION['ADMIN_DOC']) )) ? '<p class="button"><a href="../Php/index.php?EX=form_document"><button>Nouveau document</button></a></p>' : '';

		echo <<<HERE
		<h2>{$_SESSION['FICHE_TITRE']}</h2>
		$document
		$nouveau_doc 		
HERE;
	
	}// showDocument($_data)
	
	public function formDocument($_data)
	{				
		$data_fiches = isset($_data['FICHES']) ? $_data['FICHES'] : '';

		$data_doc = isset($_data['DOCUMENTS']) ? $_data['DOCUMENTS'] : '';
  	 
		$mfiches = new MFiches();
		$f = $mfiches->SelectAllFiche();

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
  	  	
		$delete = $data_doc ? '<p class="button"><a href="../Php/index.php?EX=delete_document&amp;ID_DOC='.$data_doc['ID_DOC'].'"><button>Supprimer</button></a></p>' : '';
		
		}

		if ($data_doc)
		{
			$titre = $data_doc['TITRE'];
			$document = $data_doc['DOCUMENT'];
			$ex = 'update_document&amp;ID_DOC='.$data_doc['ID_DOC'];
		}
		else
		{
			$titre = '';
			$document = '';
			$ex = 'insert_document';
		}
  	
  	echo <<<HERE
		<form action="../Php/index.php?EX=$ex" method="post" enctype="multipart/form-data">
			<p>
				<label for="titre">Titre</label>
				<input id="titre" name="TITRE" value="$titre" size="15" maxlength="50" />
			</p>
			<p>
				<label for="document">Document</label>
				<input id="document" name="DOCUMENT" value="$document" size="15" maxlength="50" />
			</p> 
			<p>
				<label for="fiches">Fiches</label>
				<select id="fiches" name="ID_FICHE[]" multiple="multiple">
					$options
				</select>
			</p>
			<p class="submit">
				<input type="submit" value="Ok" />
			</p>
		</form>
		$delete
HERE;

  	return;

	} // formDocument($_data)
	
}
?>