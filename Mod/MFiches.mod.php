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
	
	public function SelectAllFiches()
	{
		$query = 'select ID_FICHE, FICHE_TITRE
				  from FICHES
				  order by FICHE_TITRE';

			$result = $this->conn->prepare($query);

			$result->execute() or die ($this->Error($result));
	  
			return $result->fetchAll();
	   
	} // SelectAllFiches()
  
	public function UpdateFiche()
	{  
		$query = 'update FICHES
				  set FICHE_TITRE = :FICHE_TITRE
				  where ID_FICHE = :ID_FICHE';
	  
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':ID_FICHE', $this->id_fiche, PDO::PARAM_INT);
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
  
	} // UpdateFiche()
  
	public function InsertFiche()
	{
		$query = 'insert into FICHES (FICHE_TITRE)
				  values(:FICHE_TITRE)';
	 
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
  
	} // InsertFiche()
  
	public function DeleteFiche()
	{
		$query = 'delete from FICHES
				  where ID_FICHE = :ID_FICHE';
	  
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':ID_FICHE', $this->id_fiche, PDO::PARAM_INT);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
		 
	} // DeleteFiche()
  
	public function Insert()
	{
		$query = 'insert into THEMES (THEME)
				  values(:THEME)';
	 
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':THEME', $this->value['THEME'], PDO::PARAM_STR);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
	  
	} // Insert()

	public function Update()
	{	
		$query = 'update THEMES
				  set THEME = :THEME
				  where ID_THEME = :ID_THEME';
	  
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':ID_THEME', $this->id_theme, PDO::PARAM_INT);
		$result->bindValue(':THEME', $this->value['THEME'], PDO::PARAM_STR);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
  
	} // Update()
  
  
  
  
	

/*	
	public function SelectAllFiches()
	{
		$query = 	'select ID_FICHE, FICHE_TITRE
					from FICHES
					order by FICHE_TITRE';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAllFiches()
	
	
	public function InsertFiche()
	{
		$query = 'insert into FICHES (FICHE_TITRE)
              values(:FICHE_TITRE)';
 
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
  
		$result->execute() or die ($this->Error($result));
  	
  	return;
  
	} // InsertFiche()
	
	public function Delete()
	{
		$query = 'delete from FICHES
				  where ID_FICHE = :ID_FICHE';
	  
		$result = $this->conn->prepare($query);
	  
		$result->bindValue(':ID_FICHE', $this->id_fiche, PDO::PARAM_INT);
	  
		$result->execute() or die ($this->Error($result));
		
		return;
		 
	} // Delete()
	
	public function Update()
	{		  
		$query = 	'update FICHES
					set FICHE_TITRE = :FICHE_TITRE
					where ID_FICHE = :ID_FICHE';
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_FICHE', $this->id_fiche, PDO::PARAM_INT);
		$result->bindValue(':FICHE_TITRE', $this->value['FICHE_TITRE'], PDO::PARAM_STR);
  
		$result->execute() or die ($this->Error($result));
  	
		return;
  
	} // Update()
	
	
	
	
  
	/**
	* Récupère plusieurs tuples de la table FICHES
	* @access public
	*
	* @return array tuples de la table FICHES
	*/
	/*
	public function SelectAll()
	{
		$query = 	'select ID_FICHE, FICHE_TITRE
					from FICHES
					order by FICHE_TITRE';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAll()
	*/
	/*
	public function Test()
	{
		$query = 	'select E.ID_EMPLOYER, NOM, PRENOM, F.ID_FICHE, FICHE_TITRE
						from EMPLOYER E,  
                        FICHES F, FICHES_EMPLOYERS FE
						where F.ID_FICHE = FE.ID_FICHE
                        and E.ID_EMPLOYER = FE.ID_EMPLOYER           
						order by E.NOM';

		$result = $this->conn->prepare($query);

		//$result->bindValue(':ID_EMPLOYER', $this->value['ID_EMPLOYER'], PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAll(
	*/
	
	
	/*
						select E.ID_EMPLOYER, NOM, PRENOM, F.ID_FICHE, FICHE_TITRE
						from EMPLOYER E,  
                        FICHES F, FICHES_EMPLOYERS FE
						where F.ID_FICHE = FE.ID_FICHE
                        and E.ID_EMPLOYER = FE.ID_EMPLOYER
                      
						and FE.ID_EMPLOYER = 1
						order by E.NOM
	
	
	
						select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER, F.ID_FICHE, FICHE_TITRE
						from EMPLOYER E, METIERS M,
                        FICHES F, FICHES_EMPLOYERS FE
						where F.ID_FICHE = FE.ID_FICHE
                        and E.ID_EMPLOYER = FE.ID_EMPLOYER
						and FE.ID_EMPLOYER = 1
						order by E.NOM
	
	
						select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER, F.ID_FICHE, FICHE_TITRE
						from EMPLOYER E, METIERS M, METIERS_EMPLOYERS ME, FICHES F, FICHES_EMPLOYERS FE
						where ME.ID_EMPLOYER = E.ID_EMPLOYER
						and M.ID_METIER = ME.ID_METIER
                        and E.ID_EMPLOYER = FE.ID_EMPLOYER
						order by E.NOM
						
						select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER, F.ID_FICHE, FICHE_TITRE
						from EMPLOYER E, METIERS M, METIERS_EMPLOYERS ME, FICHES F, FICHES_EMPLOYERS FE
						where ME.ID_EMPLOYER = E.ID_EMPLOYER
						and M.ID_METIER = ME.ID_METIER
                        and E.ID_EMPLOYER = FE.ID_EMPLOYER
						and FE.ID_EMPLOYER = :ID_EMPLOYER
						order by E.NOM
						
						
						'select D.ID_DOC, TITRE, AUTEUR, FICHIER, DOCUMENTS, ID_FICHE
					from DOCUMENTS D, FICHES_DOCUMENTS FD
					where FD.ID_DOC = D.ID_DOC
					and FD.ID_FICHE = :ID_FICHE
					order by TITRE';
	*/

  

	private function ErrorSQL($result)
	{
		// Récupère le tableau des erreurs
		$error = $result->errorInfo();
  	 
		echo 'TYPE_ERROR = ' . $error[0] . '<br />';
		echo 'CODE_ERROR = ' . $error[1] . '<br />';
		echo 'MSG_ERROR = ' . $error[2] . '<br />';
  
		return;
  
	} // ErrorSQL($result)
  
} // MThemes
?>