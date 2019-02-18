<?php
/**
 * Contrôleur
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXAM-CNAM
 */
 
// Inclusion des constantes et des fonctions de l'application
// en particulier l'Autoload
require('../Inc/require.inc.php');

// Crée une session nommée
session_name('EXAMEN');
session_start();

// variable de contrôle
$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';

// Contrôleur
switch($EX)
{
  case 'home'         	: home();         	break;
  //case 'document'     	: document();     	break;
 // case 'doc'     		: doc();     		break;
 // case 'admin' 			: admin(); 			break;
  //case 'deconnect'    	: deconnect();    	break;
 // case 'fiche'    		: fiche();    		break;
 // case 'page' 			: page();			exit;
}

// Mise en page
require('../View/layout.view.php');

/**
 * Affichage de la page d'accueil
 *
 * @return none
 */
function home()
{
	//debug($_SESSION);
/*	
	$_SESSION['HOME'] = true;
	
	$mfiches = new MFiches();
	$data['FICHES_TITRES'] = $mfiches->SelectAll();
	$data['TEST'] = $mfiches->Test();
	
	$mdocuments = new MDocuments();
	$data['DOCUMENTS_TITRE'] = $mdocuments->SelectAllSimple();
	$data['DOCUMENTS'] = $mdocuments->SelectAllDocument();
	$data['DOCUMENTS_FICHE'] = $mdocuments->SelectAllFicheDocument();
	
	$mspecialites = new MSpecialites();
	$data['SPECIALITES'] = $mspecialites->SelectAll();
	
	$memployers = new MEmployers();
	$data['EMPLOYER'] = $memployers->SelectionAllEmployerMetier();
*/
	// Les Fiches
	$mfiches = new MFiches();
	$data['FICHES_TITRES'] = $mfiches->SelectAllFiches();
	// Les Documents
	$mdocuments = new MDocuments();
	$data['DOCUMENTS'] = $mdocuments->SelectAllDocument();
	$data['DOCUMENTS_FICHE'] = $mdocuments->SelectAllFicheDocument();
	// Les Employers
	$memployers = new MEmployers();
	//$data['EMPLOYER'] = $memployers->SelectionAllEmployerMetier();
	$data['EMPLOYER_DOCTEUR'] = $memployers->SelectionEmployerDocteur();
	$data['EMPLOYER_AVS'] = $memployers->SelectionEmployerAvs();
	
	//debug($data);
	//exit;
	
	global $content;
	
	$content['title'] = 'CatClinick-CSS-HTML';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDocAccueil';
	$content['arg'] = $data;
  
	return;

} // home()

/**
 * Affichage de la page d'accueil 
 * en mode administration
 *
 * @return none
 */
function admin()
{
/*	
	unset($_SESSION['HOME']);
  
	$_SESSION['ADMIN'] = true;

	home();

	return;
*/
} // admin()

/**
 * Déconnexion
 *
 * @return none
 */
function deconnect()
{
/*	
	session_unset();

	home();

	return;
*/
} // deconnect()

/**
 * Affichage de la liste de documents par thème
 * @param int identifiant du thème
 *
 * @return none
 */
function document($id_fiche = null)
{
/*	
	debug($_GET);
	debug($_POST);
	echo 'gg';
	//debug($_SESSION['ID_FICHE']);
	//debug($_SESSION['FICHE_TITRE']);
	
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_fiche;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];	

	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAll();

	//debug($data);
	//exit;
	
	global $content;

	$content['title'] = 'Liste des documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDocuments';
	$content['arg'] = $data;

	return;
*/	
} // document()

function doc()
{
/*	
	debug($_GET);
	debug($_POST);
	echo 'gg';
	//debug($_SESSION['ID_FICHE']);
	//debug($_SESSION['FICHE_TITRE']);
	

	$mdocuments = new MDocuments($_GET['ID_DOC']);
	$data = $mdocuments->Select();
	
	//debug($data);
	//exit;

	global $content;

	$content['title'] = 'doc';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDoc';
	$content['arg'] = $data;

	return;
*/	
}

function fiche($id_fiche = null)
{
/*	
	debug($_GET);
	debug($_POST);
	echo 'gg';
	//debug($_SESSION['ID_FICHE']);
	//debug($_SESSION['FICHE_TITRE']);
	
	//$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_fiche;
	//$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
	//$value['ID_FICHE'] = $_SESSION['ID_FICHE'];

	$mfiches = new MFiches();
	$data['FICHES'] = $mfiches->selectAll();

	$mdocuments = new MDocuments();
	$data['DOC'] = $mdocuments->Tout();

	//debug($data);
	//exit;
	
	global $content;

	$content['title'] = 'fiches conseil';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showFiche';
	$content['arg'] = $data;

	return;
*/	
}

/**
 *  Affichage des pages
 *  
 *  @return none
 */
function page()
{
/*	
  // Aiguille suivant le numéro de page
  switch($_POST['ID_PAGE'])
  {
  	case 1 : $html = '../Html/entreprise.html';
  	         break;
  	case 2 : $html = '../Html/contact.html';
  	         break;
  }
	
  // Affiche la page
  $vhtml = new VHtml();
  $vhtml->showHtml($html);
  
  return;
*/  
} // page()

?>