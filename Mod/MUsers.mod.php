<?php
/**
 * Class de type Modèle gérant la table USERS
 * 
 * @author Christian Bonhomme
 * @version 1.0
 * @package Sécurité
 */
class MUsers
{
  /**
   * Connexion à la Base de Données
   * @var object $conn
   */
  private $conn;

  /**
   * Constructeur de la class MUsers
   * @access public
   *        
   * @return none
   */
  public function __construct()
  {
    // Connexion à la Base de Données
    $this->conn = new PDO(DATABASE, LOGIN, PASSWORD);
    
    return;
 
  } // __construct()
  
  /**
   * Destructeur de la class MUsers
   * @access public
   *        
   * @return none
   */
  public function __destruct(){}
  
  /**
   * Récupère un tuple de la table USERS
   * @access public
   *        
   * @return array un tuple
   */
  public function VerifUser($_value)
  {
    $login = $_value['LOGIN'];  
    $password = $_value['PASSWORD'];
    
    $query = "select ID_USER,
                     NOM, 
                     PRENOM
	          from USERS
              where LOGIN = '$login'
              and PASSWORD = '$password'";
 
    $result = $this->conn->prepare($query);
 
    $result->execute();
        
    return $result->fetch();  
  
  } // VerifUser($_value)
  
} // MUsers
?>