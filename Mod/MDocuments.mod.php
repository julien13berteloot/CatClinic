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
	
	// Index.php - document()
	public function SelectAllDocuments()
	{
		$query = 	'
					select 
						D.ID_DOC, 
						TITRE, 
						DOCUMENT 
					from 
						DOCUMENTS D, 
						FICHES_DOCUMENTS FD
					where 
						FD.ID_DOC = D.ID_DOC
					and 
						FD.ID_FICHE = :ID_FICHE
					order by 
						TITRE
					';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_FICHE', $this->value['ID_FICHE'], PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAllDocuments()
	
	// Index.php - form_document()
	public function SelectDocument()
	{
		$query = 	'
					select 
						ID_DOC, 
						TITRE, 
						DOCUMENT 
					from 
						DOCUMENTS
					where 
						ID_DOC = :ID_DOC
					';
  
		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
    
		$result->execute() or die ($this->ErrorSQL($result));
    
		return $result->fetch();
  
	} // SelectDocument()
	
	// Index.php - form_document()
	public function SelectFichesDocuments()
	{
		$query = 	'
					select 
						ID_FICHE
					from 
						FICHES_DOCUMENTS
					where 
						ID_DOC = :ID_DOC
					';
  
		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
   	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
  
	} // SelectThemesDocuments()
	
	// Index.php - insert_document()
	public function InsertDocument()
	{
		$query = 	'
					insert into 
						DOCUMENTS (TITRE, DOCUMENT)
					values
						(:TITRE, :DOCUMENT)
					';

		$result = $this->conn->prepare($query);
    
		$result->bindValue(':TITRE',$this->value['TITRE'], PDO::PARAM_STR);
		$result->bindValue(':DOCUMENT',$this->value['DOCUMENT'], PDO::PARAM_STR);
     
		$result->execute() or die ($this->ErrorSQL($result));
    
		$this->id_doc = $this->conn->LastInsertId();
 
		return $this->id_doc;
    
	} // InsertDocument()
	
	// Index.php - insert_document() - update_document()
	public function InsertFichesDocuments()
	{
		$query = 	'
					insert into 
						FICHES_DOCUMENTS (ID_FICHE, ID_DOC)
					values
						(:ID_FICHE,:ID_DOC)
					';
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
		$result->bindValue(':ID_FICHE',$this->value['ID_FICHE'], PDO::PARAM_INT);
   	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return;
  
	} // InsertFichesDocuments()

	// Index.php - delete_document() - update_document()
	public function DeleteFichesDocuments()
	{
		$query = 	'
					delete from 
						FICHES_DOCUMENTS
					where 
						ID_DOC = :ID_DOC
					';
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
  	  	
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return;
  
	} // DeleteFichesDocuments()
	
	// Index.php - delete_document()
	public function DeleteDocument()
	{
		$query = 	'
					delete from 
						DOCUMENTS
					where 
						ID_DOC = :ID_DOC
					';
  
		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
    
		$result->execute() or die ($this->ErrorSQL($result));
    
		return;
       
	} // DeleteDocument()

	// Index.php - update_document()
	public function UpdateDocument()
	{
		$query = 	'
					update 
						DOCUMENTS
					set 
						TITRE = :TITRE,
						DOCUMENT = :DOCUMENT
					where 
						ID_DOC = :ID_DOC
					';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
		$result->bindValue(':TITRE', $this->value['TITRE'], PDO::PARAM_STR);
		$result->bindValue(':DOCUMENT',$this->value['DOCUMENT'], PDO::PARAM_STR);
    
		$result->execute() or die ($this->ErrorSQL($result));
    
		return;
  
	} // UpdateDocument()






	
	
	
	
/*	
	// index.php - form_document()
	public function selectDocumentByFiche()
	{
		$query = 	'
					select 
						D.ID_DOC, 
						D.TITRE, 
						D.DOCUMENT
					from 
						DOCUMENTS D 
					where
						D.ID_DOC = :ID_DOC
					';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_DOC', $this->id_doc, PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetch();
		
	} // selectDocumentByFiche()
/*
/*	
	// index.php - form_document()
	public function SelectFichesDocuments()
	{
		$query =  	'
					select 
						ID_DOC
					from 
						FICHES_DOCUMENTS
					where 
						ID_DOC = :ID_DOC';
  
  	$result = $this->conn->prepare($query);

  	$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
   	 
  	$result->execute() or die ($this->ErrorSQL($result));
  	
  	return $result->fetchAll();
  
	} // SelectFichesDocuments()
*/	
/*
	public function SelectAll()
	{
		$query = 	'
						select 
							D.ID_DOC, 
							D.TITRE, 
							D.DOCUMENT 
						from 
							DOCUMENTS D, 
							FICHES_DOCUMENTS FD
						where 
							FD.ID_DOC = D.ID_DOC
						and 
							FD.ID_FICHE = :ID_FICHE
						order by 
							D.TITRE
					';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_FICHE', $this->value['ID_FICHE'], PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAll()
*/
  
/*	
	// VAside - 
	public function SelectAllTitresDocuments()
	{
		$query = 	'
					select 
						ID_DOC, 
						TITRE
					from 
						DOCUMENTS
					order by 
						TITRE
					asc
					';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAllTitresDocuments()
	
	// index.php  - fiche($id_fiche = null)
	public function SelectAllDocuments()
	{ 	  
		$query = 	'
					select 
						D.ID_DOC, 
						TITRE, 
						DOCUMENT
					from 
						DOCUMENTS D, 
						FICHES_DOCUMENTS FD
					where
						FD.ID_DOC = D.ID_DOC
					and 	
						FD.ID_FICHE = :ID_FICHE
					order by 
						TITRE
					';

		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_FICHE', $this->value['ID_FICHE'], PDO::PARAM_INT);
  	 
		$result->execute() or die ($this->ErrorSQL($result));
  	
		return $result->fetchAll();
   
	} // SelectAllDocuments()
		
	// index.php - form_document()
	public function SelectFichesDocuments()
	{
		$query =  	'
					select 
						ID_DOC
					from 
						FICHES_DOCUMENTS
					where 
						ID_DOC = :ID_DOC';
  
  	$result = $this->conn->prepare($query);

  	$result->bindValue(':ID_DOC',$this->id_doc, PDO::PARAM_INT);
   	 
  	$result->execute() or die ($this->ErrorSQL($result));
  	
  	return $result->fetchAll();
  
	} // SelectFichesDocuments()
	
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
 
} // MDocuments
?>