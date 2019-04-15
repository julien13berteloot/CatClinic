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

	// VAside - showAside() - VDocument - formDocument($_data)
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
	
	// Index.php - insert_fiche ()
	public function InsertFiche()
	{
		$query = 	'
					insert into 
						FICHES (FICHE_TITRE,IMAGE)
					values
						(:FICHE_TITRE, :IMAGE)
					';
	 
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
		$result->bindValue(':IMAGE', $this->value['IMAGE'], PDO::PARAM_STR);
	  
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
	
	// Index.php - home() - lesfiches()
	public function SelectAllFichePage()
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
					
	}	// SelectAllFichePage()
	
	// Index.php - home()
	public function SelectAvantDerniereFiche()
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
						D.ID_DOC 
					desc 
					limit 1,1
					';
		
		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();		
					
	}	// SelectAvantDerniereFiche()
	
	// Index.php - home()
	public function SelectDerniereFiche()
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
						D.ID_DOC 
					desc 
					limit 0,1
					';
		
		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();		
					
	}	// SelectDerniereFiche()
	
	
	
	
	
	
	
	
	
	
	/*
	// Index.php - home() - lesfiches()
	public function SelectAllFichePage()
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
					
	}	// SelectAllFichePage()
	*/
	/*
	public function SelectLaFiche()
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
					and 	
						F.ID_FICHE = :ID_FICHE
					';
		
		$result = $this->conn->prepare($query);
		
		$result->bindValue(':ID_FICHE', $this->value['ID_FICHE'], PDO::PARAM_INT);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();		
					
	}	// SelectLaFiche()
	*/
	
	private function ErrorSQL($result)
	{
		$error = $result->errorInfo();
  	 
		echo 'TYPE_ERROR = ' . $error[0] . '<br />';
		echo 'CODE_ERROR = ' . $error[1] . '<br />';
		echo 'MSG_ERROR = ' . $error[2] . '<br />';
  
		return;
  
	} // ErrorSQL($result)
  
} // MFiches
?>