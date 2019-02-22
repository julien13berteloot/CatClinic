<?php
	class MEmployers
	{	
	
		private $conn;
  
  		private $id_employer;
  
  		private $value;
  
		public function __construct($_id_employer = null)
		{
			$this->conn = new PDO(DATABASE, LOGIN, PASSWORD);
			
			//debug($this->conn);

			$this->id_employer = $_id_employer;
    
		} // __construct($_id_employer = null)
  
		public function __destruct() {}
		
		public function SetValue($_value)
		{
			$this->value = $_value;
	  
		} // SetValue($_value)
		
		
		public function SelectAllEmployer()
		{	
			$query = 'select ID_EMPLOYER, PRENOM, NOM
					  from EMPLOYER 
					  order by PRENOM';

			$result = $this->conn->prepare($query);

			$result->bindValue(':ID_METIER', $this->value['ID_METIER'], PDO::PARAM_INT);
			 
			$result->execute() or die ($this->ErrorSQL($result));
			
			return $result->fetchAll();
   
		} // SelectAll()
		
		
		public function Select()
		{ 
			$query = 'select ID_EMPLOYER, NOM, PRENOM
						from EMPLOYER
						where ID_EMPLOYER = :ID_EMPLOYER';
  
			$result = $this->conn->prepare($query);

			$result->bindValue(':ID_EMPLOYER', $this->id_employer, PDO::PARAM_INT);
    
			$result->execute() or die ($this->ErrorSQL($result));
    
			return $result->fetch();
  
		} // Select()
		
		public function SelectAll()
		{	  
			$query = 'select E.ID_EMPLOYER, PRENOM, NOM
					  from EMPLOYER E, METIERS_EMPLOYERS ME
					  where ME.ID_EMPLOYER = E.ID_EMPLOYER
					  and ME.ID_METIER = :ID_METIER
					  order by PRENOM';

			$result = $this->conn->prepare($query);

			$result->bindValue(':ID_METIER', $this->value['ID_METIER'], PDO::PARAM_INT);
			 
			$result->execute() or die ($this->ErrorSQL($result));
			
			return $result->fetchAll();
   
		} // SelectAll()
		
		public function SelectMetierEmployer()
		{
			$query = 'select ID_METIER
              from METIERS_EMPLOYERS
  			  where ID_EMPLOYER = :ID_EMPLOYER';
  
			$result = $this->conn->prepare($query);

			$result->bindValue(':ID_EMPLOYER',$this->id_employer, PDO::PARAM_INT);
   	 
			$result->execute() or die ($this->ErrorSQL($result));
  	
			return $result->fetchAll();
  
		} // SelectThemesDocuments()
		
		
		
		
		
		public function SelectionAllEmployerMetier()
		{	
			$query =	'select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER
						from EMPLOYER E, METIERS M, METIERS_EMPLOYERS ME
						where ME.ID_EMPLOYER = E.ID_EMPLOYER
						and M.ID_METIER = ME.ID_METIER
						order by M.METIER';
	
			$result = $this->conn->prepare($query);
  	 
			$result->execute() or die ($this->ErrorSQL($result));
  	
			return $result->fetchAll();
		} // SelectionAllEmployerMetier()
		
		public function SelectionEmployerDocteur()
		{
			$query =	'select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER
						from EMPLOYER E, METIERS M, METIERS_EMPLOYERS ME
						where ME.ID_EMPLOYER = E.ID_EMPLOYER
						and M.ID_METIER = ME.ID_METIER
                        and ME.ID_METIER = 1
						order by E.NOM';
			
			$result = $this->conn->prepare($query);
  	 
			$result->execute() or die ($this->ErrorSQL($result));
  	
			return $result->fetchAll();
		} // SelectionEmployerDocteur()
		
		public function SelectionEmployerAvs()
		{
			$query =	'select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER
						from EMPLOYER E, METIERS M, METIERS_EMPLOYERS ME
						where ME.ID_EMPLOYER = E.ID_EMPLOYER
						and M.ID_METIER = ME.ID_METIER
                        and ME.ID_METIER = 2
						order by E.NOM';
			
			$result = $this->conn->prepare($query);
  	 
			$result->execute() or die ($this->ErrorSQL($result));
  	
			return $result->fetchAll();
		} // SelectionEmployerAvs(
		
		public function Insert()
		{				
			$query = 	"insert into EMPLOYER (NOM, PRENOM)
						values(:NOM, :PRENOM)";									
		  
			$result = $this->conn->prepare($query);
			
			$result->bindValue(':NOM', $this->value['NOM'], PDO::PARAM_STR);
			$result->bindValue(':PRENOM', $this->value['PRENOM'], PDO::PARAM_STR);
			
			$result->execute();

			$this->id_employer = $this->conn->lastInsertId();

			$this->value['ID_EMPLOYER'] = $this->id_employer;
			
			return $this->value;
			
		} // InsertEmployer()
		
		public function InsertMetiersEmployers()
		{

		$query = 'insert into METIERS_EMPLOYERS (ID_EMPLOYER, ID_METIER)
              values(:ID_EMPLOYER, :ID_METIER)';
  
  
		$result = $this->conn->prepare($query);
  
		$result->bindValue(':ID_EMPLOYER',$this->id_employer, PDO::PARAM_INT);
		$result->bindValue(':ID_METIER',$this->value['ID_METIER'], PDO::PARAM_INT);
   	 
		$result->execute() or die ($this->ErrorSQL($result));
		
		}
		

		
		
		
		
		
		
	
		
		
		
		
		
		
		
	  
	} // MEmployers
?>