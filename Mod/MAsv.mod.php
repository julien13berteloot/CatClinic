<?php
	class MAsv
	{	
	
		private $conn;
  
  		private $id_asv;
  
  		private $value;
  
		public function __construct($_id_asv = null)
		{
			$this->conn = new PDO(DATABASE, LOGIN, PASSWORD);
			
			//debug($this->conn);

			$this->id_asv = $_id_asv;
    
		} // __construct($_id_doc = null)
  
		public function __destruct() {}
		
		public function SetValue($_value)
		{
			$this->value = $_value;
	  
		} // SetValue($_value)
			
		public function InsertAsv()
		{				
			$query = 	"insert into ASV (NOM, PRENOM)
						values(:NOM, :PRENOM)";									
		  
			$result = $this->conn->prepare($query);
			
			$result->bindValue(':NOM', $this->value['NOM'], PDO::PARAM_STR);
			$result->bindValue(':PRENOM', $this->value['PRENOM'], PDO::PARAM_STR);
			
			$result->execute();

			$this->id_asv = $this->conn->lastInsertId();

			$this->value['ID_ASV'] = $this->id_asv;
			
			return $this->value;
			
		} // InsertAsv()	
		
		public function SelectAsv()
		{
		    $query =   'select ID_ASV, NOM, PRENOM
						from ASV
						where ID_ASV = ' . $this->id_asv;
		    
		    $result = $this->conn->prepare($query);
		    
		    $result->execute();
		    
		    return $result->fetch();
		    
		} // SelectAsv()
		
		public function SelectAllAsv()
		{		
			$query = 'select ID_ASV, NOM, PRENOM
					  from ASV';
	 
			$result = $this->conn->prepare($query);
	 
			$result->execute();
			
			return $result->fetchAll();
  
		} // SelectAllAsv()
		
		public function Update()
		{
			$NOM = $this->value['NOM'];
			$PRENOM = $this->value['PRENOM'];
					
			$query = "update ASV
						  set NOM = '$NOM',
								PRENOM = '$PRENOM'
						  where ID_ASV = $this->id_asv";

						  
			$result = $this->conn->prepare($query);
			  
			$result->execute();
				
			return;
				
		} // Update()		

		public function Delete()
		{
			$query = 	'
						delete from 
							ASV
						where 
							ID_ASV = :ID_ASV
						';
  
			$result = $this->conn->prepare($query);
  
			$result->bindValue(':ID_ASV',$this->id_asv, PDO::PARAM_INT);
  	  	
			$result->execute() or die ($this->ErrorSQL($result));
  	
			return;
  
		} // Delete()
		
	} // MDocteurs
?>