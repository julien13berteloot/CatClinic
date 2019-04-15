<?php
// Constantes pour la Base de données
define('DEBUG', true);
define('DATABASE', 'mysql:host=localhost;dbname=julien;charset=utf8');
define('LOGIN', 'root');
define('PASSWORD', '');

// Récupère le chemin absolu du répertoire Inc
// et le transforme pour le répertoire Upload
$path = str_replace('Inc', 'Upload', realpath('../Inc')) . '/';
define('UPLOAD', $path);

// Récupère le chemin absolu du répertoire Inc
$realpath = realpath('../Inc') . '/';

// Transforme le chemin absolu du répertoire Inc pour le répertoire Img
$path = str_replace('Inc', 'Img', $realpath);
define('IMG', $path);

/**
 * Chargement automatique des class
 * @param string class appelée
 *
 * @return none
 */
function __autoload($class)
{
  switch ($class[0])
  {
    // Inclusion des class de type View
    case 'V' : require_once('../View/'.$class.'.view.php');
				break;
    // Inclusion des class de type Mod
	case 'M' : require_once('../Mod/'.$class.'.mod.php');
				break;
  }
	
  return;

} // __autoload($class)

function strip_xss(&$val)
{
  // Teste si $val est un tableau
  if (is_array($val))
  {
    // Si $val est un tableau, on réapplique la fonction strip_xss()
    array_walk($val, 'strip_xss');
  }
  else if (is_string($val))
  {
    // Si $val est une string, on filtre avec strip_tags()
    $val = strip_tags($val, '<strong>');
  }

} // strip_xss(&$val)

// Visualisation des erreurs
if (DEBUG)
{
  // Retourne toutes les erreurs
  error_reporting(E_ALL);
  // Autorise l'affichage des erreurs
  ini_set('display_errors', 1);

  /**
   * Fonction de debug pour les tableaux
   * @param array tableau à débugguer
   *
   * @return none
  */
  function debug($Tab)
  {
    echo '<pre>Tab';
    print_r($Tab);
    echo '</pre>';
    
    return;
         
  } // debug($Tab)
}
?>