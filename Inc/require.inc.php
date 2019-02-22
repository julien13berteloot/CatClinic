<?php
/**
 * Fichier d'inclusion des constantes et des fonctions
 * dont à besoin l'application en particulier l'Autoload
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 */

// Constantes pour la Base de données
define('DEBUG', true);
define('DATABASE', 'mysql:host=localhost;dbname=julien');
define('LOGIN', 'root');
define('PASSWORD', '');

// Récupère le chemin absolu du répertoire Inc
// et le transforme pour le répertoire Upload
$path = str_replace('Inc', 'Upload', realpath('../Inc')) . '/';
define('UPLOAD', $path);

// Récupère le chemin absolu du répertoire Inc
// et le transforme pour le répertoire Img
$path = str_replace('Inc', 'Img', realpath('../Inc')) . '/';
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

/**
 * Mise en forme d'un fichier pour le téléchargement
 * @param array correspondant au nom du fichier téléchargé
 *
 * @return string fichier mis en forme
 */
function upload($file)
{
  // Découpe $file['name'] en tableau avec comme séparateur le point
  $tab = explode('.', $file['name']);

  // Transforme les caractères accentués en entités HTML
  $fichier = htmlentities($tab[0], ENT_NOQUOTES);

  // Remplace les entités HTML pour avoir juste le premier caractères non accentués
  $fichier = preg_replace('#&([A-za-z])(?:acute|grave|circ|uml|tilde|ring|cedil|lig|orn|slash|th|eg);#', '$1', $fichier);

  // Elimination des caractères non alphanumériques
  $fichier = preg_replace('#\W#', '', $fichier);

  // Troncation du nom de fichier à 25 caractères
  $fichier = substr($fichier, 0, 25);

  // Ajout du time devant le fichier pour obtenir un fichier unique
  $fichier = time() . '_' . $fichier . '.pdf';

  return $fichier;

} // upload($file)

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