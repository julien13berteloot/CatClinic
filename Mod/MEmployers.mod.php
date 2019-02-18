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
		
		public function SelectionAllEmployerMetier()
		{	
			$query =	'select E.ID_EMPLOYER, NOM, PRENOM, M.ID_METIER, METIER
						from EMPLOYER E, METIERS M, METIERS_EMPLOYERS ME
						where ME.ID_EMPLOYER = E.ID_EMPLOYER
						and M.ID_METIER = ME.ID_METIER
						order by E.NOM';
	
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
		
		
		
		
		/*
		public function SelectAllEmployer()
		{		
			$query = 	'select ID_EMPLOYER, NOM,
						PRENOM
						from EMPLOYER';
	 
			$result = $this->conn->prepare($query);
	 
			$result->execute();
			
			return $result->fetchAll();
  
		} // SelectAllEmployer()
		*/
		/*
		public function InsertEmployer()
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
		*/

		/*
		public function gg()
		{
			$ID_METIER = $this->value['ID_METIER'];
			
			$query= "insert into metiers_employers
					(ID_METIER, ID_EMPLOYER)
					values('$ID_METIER', $this->id_employer)";
					
			$result = $this->conn->prepare($query);
						  
			$result->execute();
							
			return;
		}			
		*/
		
/*		
		
	insert into metiers_employers
	(ID_METIER, ID_EMPLOYER)
	values('2', '2')


	$ID_PAGE = $this->value['ID_PAGE'];
								
	$query = "insert into PAGES_DOCUMENTS (ID_PAGE, ID_DOCUMENT)
				values('$ID_PAGE', $this->id_document)";
						  
	$result = $this->conn->prepare($query);
						  
	$result->execute();
							
	return;	
		
*/		
		
		
		
		
		
		
		
	  
	} // MEmployers
?>