<?php
/**
 * Class de type Modèle gérant la table DOCUMENTS
 * 
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 */
class MDocuments
{
  /**
   * Connexion à la Base de Données
   * @var object $conn
   */
  private $conn;

  /**
   * Clef primaire de la table DOCUMENTS
   * @var int identifiant du document
   */
  private $id_doc;
  
  /**
   * Tableau de gestion de données (insert ou update)
   * @var array tableau des données
   */
  private $value;
  
  /**
   * Constructeur de la class MDocuments
   * Instancie le membre privé $conn
   * @access public
   * @param int identifiant du document
   *        
   * @return none
   */
  public function __construct($_id_doc = null)
  {
    // Connexion à la Base de Données
    $this->conn = new PDO(DATABASE, LOGIN, PASSWORD);

    // Instanciation du membre $id_doc
    $this->id_doc = $_id_doc;
    
    return;
 
  } // __construct()
  
  /**
   * Destructeur de la class MDocuments
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
	
	
	public function SelectDocument()
	{
		$query = 	'select ID_DOC, TITRE, DOCUMENTS
					from DOCUMENTS
					where ID_DOC = :ID_DOC';
  
		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
    
		$result->execute() or die ($this->ErrorSQL($result));
    
		return $result->fetch();
  
	} // SelectDocument()
	
	
	public function SelectAllDocument()
	{
		$query =	'select ID_DOC,
						TITRE,
						DOCUMENTS
					from DOCUMENTS
					order by ID_DOC
					';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAllDocument()
	
	
	public function SelectAllFicheDocument()
	{
		$query = 	'select D.ID_DOC, TITRE, DOCUMENTS, F.ID_FICHE, F.FICHE_TITRE
					from DOCUMENTS D, FICHES_DOCUMENTS FD, FICHES F
					where FD.ID_DOC = D.ID_DOC
					and FD.ID_FICHE = F.ID_FICHE
					order by TITRE
					desc
					limit 2';

		$result = $this->conn->prepare($query);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAllFicheDocument()
	
	
	public function SelectAll()
	{
		$query = 	'select D.ID_DOC, TITRE, DOCUMENTS, ID_FICHE
					from DOCUMENTS D, FICHES_DOCUMENTS FD
					where FD.ID_DOC = D.ID_DOC
					and FD.ID_FICHE = :ID_FICHE
					order by TITRE';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_FICHE', $this->value['ID_FICHE'], PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAll()
	
	
	public function SelectFichesDocuments()
	{
		$query = 	'select ID_FICHE
					from FICHES_DOCUMENTS
					where ID_DOC = :ID_DOC';
  
		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
   	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
  
	} // SelectFichesDocuments()
	
	
	public function InsertDocument()
	{
		/*
		insert into DOCUMENTS (TITRE,DOCUMENTS)
					values("WOW","bb")
		
		$query = 'insert into DOCUMENTS (TITRE, AUTEUR, FICHIER)
              values(:TITRE, :AUTEUR, :FICHIER)';

		$result = $this->conn->prepare($query);
    
		$result->bindValue(':TITRE',$this->value['TITRE'], PDO::PARAM_STR);
		$result->bindValue(':AUTEUR',$this->value['AUTEUR'], PDO::PARAM_STR);
		$result->bindValue(':FICHIER',$this->value['FICHIER'], PDO::PARAM_STR);
     
		$result->execute() or die ($this->ErrorSQL($result));
    
		$this->id_doc = $this->conn->LastInsertId();
 
		return $this->id_doc;
		*/
		$query = 	'insert into DOCUMENTS (TITRE, DOCUMENTS)
					values(:TITRE, DOCUMENTS)';
					
		$result = $this->conn->prepare($query);
    
		$result->bindValue(':TITRE',$this->value['TITRE'], PDO::PARAM_STR);
		$result->bindValue(':DOCUMENTS',$this->value['DOCUMENTS'], PDO::PARAM_STR);

		$result->execute() or die ($this->ErrorSQL($result));
    
		$this->id_doc = $this->conn->LastInsertId();
 
		return $this->id_doc;	
	}


	public function InsertFichesDocuments()
	{
		$query = 	'insert into FICHES_DOCUMENTS (ID_FICHE, ID_DOC)
					values(:ID_FICHE, :ID_DOC)';
					
		$result = $this->conn->prepare($query);
		
		$result->bindValue(':ID_FICHE',$this->value['ID_FICHE'], PDO::PARAM_INT);
		$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
		
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return;
	}		
	
	
/*	
	
	public function InsertThemesDocuments()
  {
  	$query = 'insert into THEMES_DOCUMENTS (ID_DOC, ID_THEME)
              values(:ID_DOC, :ID_THEME)';
  
  	$result = $this->conn->prepare($query);
  
  	$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
  	$result->bindValue(':ID_THEME',$this->value['ID_THEME'], PDO::PARAM_INT);
   	 
  	$result->execute() or die ($this->ErrorSQL($result));
  	
  	return;
  
  } // InsertThemesDocuments()
	
	
	
	
	
	

	
	
	
*/
/*	
	public function Tout()
	{
		$query = 	'select *
					from DOCUMENTS D, FICHES_DOCUMENTS FD, FICHES F
					where FD.ID_DOC = D.ID_DOC
					and F.ID_FICHE = FD.ID_FICHE
                    and D.ID_DOC =  FD.ID_DOC
					order by TITRE';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
	}
*/  
 /*
  select *
					from DOCUMENTS D, FICHES_DOCUMENTS FD, FICHES F
					where FD.ID_DOC = D.ID_DOC
					and F.ID_FICHE = FD.ID_FICHE
                    and D.ID_DOC =  FD.ID_DOC
					order by TITRE
 
 
 select *
					from DOCUMENTS D, FICHES_DOCUMENTS FD, FICHES F
					where FD.ID_DOC = D.ID_DOC
					and FD.ID_FICHE = D.ID_DOC
                    
					order by TITRE
 
 
 
 select D.ID_DOC, F.FICHE_TITRE, TITRE, AUTEUR, FICHIER, DOCUMENTS, FICHE_TITRE ,F.ID_FICHE
					from DOCUMENTS D, FICHES_DOCUMENTS FD, FICHES F
					where FD.ID_DOC = D.ID_DOC
					and FD.ID_FICHE = D.ID_DOC
                    and F.ID_FICHE = FD.ID_FICHE
					order by TITRE
					
					
select ID_DOC, TITRE, AUTEUR, FICHIER, DOCUMENTS
					from DOCUMENTS
					order by ID_DOC					
*/ 
  
  
  
	/**
   * Récupère plusieurs tuples de la table DOCUMENTS
   * @access public
   *
   * @return array tuples de la table DOCUMENTS
   */
/*   
	
*/ 
/*
	public function SelectAllSimple()
	{
		$query =	'select ID_DOC,
						TITRE,
						DOCUMENTS
					from DOCUMENTS
					order by ID_DOC
					desc
					limit 1';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAll()
/*

/*
  
*/ 
 
} // MDocuments
?>