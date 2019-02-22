<?php
class MMetiers
{	
	private $conn;

	private $id_metier;
 
	private $value;
  
 
	public function __construct($_id_metier = null)
	{
		// Connexion à la Base de Données
		$this->conn = new PDO(DATABASE, LOGIN, PASSWORD);

		// Instanciation du membre $id_theme
		$this->id_fiche = $_id_metier;
    
		return;
 
	} // __construct()
  
	public function __destruct() {}

	public function SetValue($_value)
	{
		$this->value = $_value;
    
		return;
  
	} // SetValue($_value)
	
	public function SelectAllMetier()
	{
		$query = 	'select ID_METIER, METIER
					from METIERS
					order by METIER';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAllMetier()
  
	public function UpdateMetier()
	{  
		$query = 	'update METIERS
					set METIER = :METIER
					where ID_METIER = :ID_METIER';
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_METIER', $this->id_metier, PDO::PARAM_INT);
		$result->bindValue(':METIER', $this->value['METIER'], PDO::PARAM_STR);
  
		$result->execute() or die ($this->Error($result));
  	
		return;
  
	} // UpdateMetier()
  
	public function DeleteMetier()
	{	  
		$query = 'delete from METIERS
              where ID_METIER = :ID_METIER';
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_METIER', $this->id_metier, PDO::PARAM_INT);
  
		$result->execute() or die ($this->Error($result));
  	
		return;
  	 
	} // DeleteMetier()
  
	public function InsertMetier()
	{
		$query = 'insert into METIERS (METIER)
              values(:METIER)';
 
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':METIER', $this->value['METIER'], PDO::PARAM_STR);
  
		$result->execute() or die ($this->Error($result));
  	
		return;
  
	} // InsertMetier()
	
	
	
	
	
	
/*  
	public function SelectAll()
	{
		$query = 'select ID_METIER, METIER
              from METIERS
   		      order by METIER';

		$result = $this->conn->prepare($query);

		$result->execute() or die ($this->Error($result));
  
		return $result->fetchAll();
   
	} // SelectAll()
	
	public function InsertMetier()
	{
	
  	$query = 'insert into METIERS (METIER)
              values(:METIER)';
 
  	$result = $this->conn->prepare($query);
  
  	$result->bindValue(':METIER', $this->value['METIER'], PDO::PARAM_STR);
  
  	$result->execute() or die ($this->Error($result));
  	
  	return;
  
	} // Insert()
	
	public function Delete()
  { 	  
  	$query = 'delete from METIERS
              where ID_METIER = :ID_METIER';
  
  	$result = $this->conn->prepare($query);
  
  	$result->bindValue(':ID_METIER', $this->id_fiche, PDO::PARAM_INT);
  
  	$result->execute() or die ($this->Error($result));
  	
  	return;
  	 
  } // Delete()
  
  public function Update()
  {

	  
  	$query = 'update METIERS
    		  set METIER = :METIER
    		  where ID_METIER = :ID_METIER';
  
  	$result = $this->conn->prepare($query);
  
  	$result->bindValue(':ID_METIER', $this->id_fiche, PDO::PARAM_INT);
  	$result->bindValue(':METIER', $this->value['METIER'], PDO::PARAM_STR);
  
  	$result->execute() or die ($this->Error($result));
  	
  	return;
  
  } // Update()

  
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
  
} // MFiches
?>