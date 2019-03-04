<?php
/**
 * Class de type Modèle gérant la table FICHES
 * 
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 */
class MFiches
{
	/**
	* Connexion à la Base de Données
	* @var object $conn
	*/
	private $conn;

	/**
	* Clef primaire de la table FICHES
	* @var int identifiant d'une fiche
	*/
	private $id_fiche;
  
	/**
	* Tableau de gestion de données (insert ou update)
	* @var array tableau des données
	*/
	private $value;
  
	/**
	* Constructeur de la class MFiches
	* Instancie le membre privé $conn
	* @access public
	* @param int identifiant d'une fiche
	*        
	* @return none
	*/
	public function __construct($_id_fiche = null)
	{
		// Connexion à la Base de Données
		$this->conn = new PDO(DATABASE, LOGIN, PASSWORD);

		// Instanciation du membre $id_fiche
		$this->id_fiche = $_id_fiche;
		
		// debug($this->conn);
    
		return;
 
	} // __construct()
  
	/**
	* Destructeur de la class MFiches
	* @access public
	*        
	* @return none
	*/
	public function __destruct() {}

	/**
	* Instancie le membre $value
	* @access public
	* @param array tableau des données
	*
	* @return none
	*/
	public function SetValue($_value)
	{
		$this->value = $_value;
    
		return;
  
	} // SetValue($_value)
	
	// Index.php - home()
	public function SelectAllFicheDocuement()
	{
		$query =	'
					select 
						D.ID_DOC, 
						D.TITRE, 
						D.DOCUMENT,
						F.ID_FICHE,
                        F.FICHE_TITRE
					from 
						DOCUMENTS D, 
						FICHES_DOCUMENTS FD,
                        FICHES F
					where
						FD.ID_DOC = D.ID_DOC
					and 	
						FD.ID_FICHE = F.ID_FICHE
					order by 
						F.FICHE_TITRE
					';
		
		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();		
					
	}	// SelectAllFicheDocuement()
	
	// VAside - showAside() 
	public function SelectAllTitresFiches()
	{
		$query = 	'
					select 
						ID_FICHE, 
						FICHE_TITRE
					from 
						FICHES
					order by 
						FICHE_TITRE
					';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAllTitresFiches()

	// VDocument - formDocument($_data)
	public function SelectAllFiche()
	{
		$query = 	'
					select 
						ID_FICHE, FICHE_TITRE
					from 
						FICHES
					order by 
						FICHE_TITRE
					';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAll()
	
	// Index.php - insert_fiche ()
	public function InsertFiche()
	{
		$query = 	'
					insert into 
						FICHES (FICHE_TITRE)
					values
						(:FICHE_TITRE)
					';
	 
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
  
	} // InsertFiche()
	
	// Index.php - delete_fiche ()	
	public function DeleteFiche()
	{
		$query = 	'	
					delete from 
						FICHES
					where 
						ID_FICHE = :ID_FICHE
					';
	  
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':ID_FICHE', $this->id_fiche, PDO::PARAM_INT);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
		 
	} // DeleteFiche()
	
	// Index.php - Update_fiche ()
	public function UpdateFiche()
	{  
		$query = 	'
					update 
						FICHES
					set 
						FICHE_TITRE = :FICHE_TITRE
					where 
						ID_FICHE = :ID_FICHE
					';
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_FICHE', $this->id_fiche, PDO::PARAM_INT);
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
  
		$result->execute() or die ($this->Error($result));
  	
		return;
  
	} // UpdateFiche()
	
	
	private function ErrorSQL($result)
	{
		// Récupère le tableau des erreurs
		$error = $result->errorInfo();
  	 
		echo 'TYPE_ERROR = ' . $error[0] . '<br />';
		echo 'CODE_ERROR = ' . $error[1] . '<br />';
		echo 'MSG_ERROR = ' . $error[2] . '<br />';
  
		return;
  
	} // ErrorSQL($result)
  
} // MFiches
?>