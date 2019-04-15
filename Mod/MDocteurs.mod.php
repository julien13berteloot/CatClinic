<?php
	class MDocteurs
	{	
	
		private $conn;
  
  		private $id_doc;
  
  		private $value;
  
		public function __construct($_id_doc = null)
		{
			$this->conn = new PDO(DATABASE, LOGIN, PASSWORD);
			
			//debug($this->conn);

			$this->id_doc = $_id_doc;
    
		} // __construct($_id_doc = null)
  
		public function __destruct() {}
		
		public function SetValue($_value)
		{
			$this->value = $_value;
	  
		} // SetValue($_value)

		public function InsertDocteur()
		{				
			$query = 	"
						insert into 
							DOCTEURS (NOM, PRENOM)
						values
							(:NOM, :PRENOM)
						";									
		  
			$result = $this->conn->prepare($query);
			
			$result->bindValue(':NOM', $this->value['NOM'], PDO::PARAM_STR);
			$result->bindValue(':PRENOM', $this->value['PRENOM'], PDO::PARAM_STR);
			
			$result->execute();

			$this->id_doc = $this->conn->lastInsertId();

			$this->value['ID_DOCTEUR'] = $this->id_doc;
			
			return $this->value;
			
		} // InsertDocteur()	
		
		public function SelectDocteur()
		{
		    $query =   '
						select 
							ID_DOCTEUR, 
							NOM, 
							PRENOM
						from 
							DOCTEURS
						where 
							ID_DOCTEUR = ' . $this->id_doc;
		    
		    $result = $this->conn->prepare($query);
		    
		    $result->execute();
		    
		    return $result->fetch();
		    
		} // SelectDocteur()
		
		public function SelectAllDocteur()
		{		
			$query = 	'
						select 
							ID_DOCTEUR, 
							NOM, 
							PRENOM
						from 
							DOCTEURS
						';
	 
			$result = $this->conn->prepare($query);
	 
			$result->execute();
			
			return $result->fetchAll();
  
		} // SelectAllDocteur()
		
		public function Update()
		{
			$NOM = $this->value['NOM'];
			$PRENOM = $this->value['PRENOM'];
			
			$query = 	"
						update 
							DOCTEURS
						set 
							NOM = '$NOM',
							PRENOM = '$PRENOM'
						where 
							ID_DOCTEUR = $this->id_doc
						";
				  
			$result = $this->conn->prepare($query);
	  
			$result->execute();
		
			return;
		
		}
		
		public function Delete()
		{
			$query = 	'
						delete from 
							DOCTEURS
						where 
							ID_DOCTEUR = :ID_DOCTEUR
						';
  
			$result = $this->conn->prepare($query);
  
			$result->bindValue(':ID_DOCTEUR',$this->id_doc, PDO::PARAM_INT);
  	  	
			$result->execute() or die ($this->ErrorSQL($result));
  	
			return;
  
		} // Delete()

	} // MDocteurs
?>