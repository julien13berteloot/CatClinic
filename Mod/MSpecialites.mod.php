<?php
/**
 * Class de type Modèle gérant la table DOCUMENTS
 * 
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 */
class MSpecialites
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
  private $id_specialites;
  
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
  public function __construct($_id_specialites = null)
  {
    // Connexion à la Base de Données
    $this->conn = new PDO(DATABASE, LOGIN, PASSWORD);

    // Instanciation du membre $id_doc
    $this->id_specialites = $_id_specialites;
    
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
	
	// Index.php - home()	
	public function SelectAllSpecialites()
	{
		$query = 	'
					select 
						ID_SPECIALITES, 
						NOM
					from 
						SPECIALITES
					order by 
						ID_SPECIALITES
					';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAllSpecialites()
	
	public function Insert()
	{				
		$query = 	"
					insert into 
						SPECIALITES (NOM)
					values
						(:NOM)
					";									
		  
		$result = $this->conn->prepare($query);
			
		$result->bindValue(':NOM', $this->value['NOM'], PDO::PARAM_STR);
			
		$result->execute();

		$this->id_specialites = $this->conn->lastInsertId();

		$this->value['ID_SPECIALITES'] = $this->id_specialites;
			
		return $this->value;
			
	} // Insert()
	
	public function SelectSpecialite()
	{
		$query =   	'
					select 
						ID_SPECIALITES,
						NOM
					from
						SPECIALITES
					where 
						ID_SPECIALITES = ' . $this->id_specialites;
		    
		$result = $this->conn->prepare($query);
		    
		$result->execute();
		    
		return $result->fetch();
		    
	} // SelectSpecialite()
	
	public function Update()
	{
		$NOM = $this->value['NOM'];
			
		$query = 	"
					update 
						SPECIALITES
					set 
						NOM = '$NOM'
					where 
						ID_SPECIALITES = $this->id_specialites
					";
			  
		$result = $this->conn->prepare($query);
	  
		$result->execute();
		
		return;
		
	} // Update()
	
	public function Delete()
	{
		$query = 	'
					delete from 
						SPECIALITES
					where 
						ID_SPECIALITES = :ID_SPECIALITES
					';
  
		$result = $this->conn->prepare($query);

		$result->bindValue(':ID_SPECIALITES', $this->id_specialites, PDO::PARAM_INT);
    
		$result->execute() or die ($this->ErrorSQL($result));
    
		return;
       
	} // Delete()
		
	
}	
?>