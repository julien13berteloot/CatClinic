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

// Récupération de l'identifiant de l'utilisateur
$ID_USER = isset($_REQUEST['ID_USER']) ?  $_REQUEST['ID_USER'] : '';

// Crée une session nommée
session_name('EXAMEN');
session_start();

// variable de contrôle
$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';

// Contrôleur
switch($EX)
{
	case 'home'         	: home();         		break;
	case 'document'     	: document();     		break;
	case 'doc'     			: doc();     			break;
	case 'connect' 			: connect(); 			break;
	case 'admin' 			: admin(); 				break; 
	case 'deconnect'    	: deconnect();    		break;
	case 'form_fiche'    	: form_fiche();    		break;	
	case 'insert_fiche'    	: insert_fiche();   	break;
	case 'delete_fiche'    	: delete_fiche();   	break;
	case 'update_fiche'    	: update_fiche();   	break;
	case 'form_document'    : form_document();  	break;
	
	case 'employers'		: employers();			break;
	case 'form_metier'		: form_metier();		break;
	case 'insert_metier'	: insert_metier();		break;
	case 'delete_metier'	: delete_metier();		break;
	case 'update_metier'	: update_metier();		break;
	
	
	case 'form_employer'	: form_employer();	break; 
	
	case 'insert_employer'  : insert_employer();break;
	
	case 'insert_document'  : insert_document();   break;
	case 'update_document'  : update_document();   break;
	case 'delete_document'  : delete_document();   break;
	

	
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
	
	$_SESSION['HOME'] = true;

	// Les Fiches
	$mfiches = new MFiches();
	$data['FICHES_TITRES'] = $mfiches->SelectAllFiches();
	// Les Documents
	$mdocuments = new MDocuments();
	$data['DOCUMENTS'] = $mdocuments->SelectAllDocument();
	$data['DOCUMENTS_FICHE'] = $mdocuments->SelectAllFicheDocument();
	// Les Employers
	$memployers = new MEmployers();
	$data['EMPLOYER'] = $memployers->SelectionAllEmployerMetier();
	$data['EMPLOYER_DOCTEUR'] = $memployers->SelectionEmployerDocteur();
	$data['EMPLOYER_AVS'] = $memployers->SelectionEmployerAvs();
	// Les Specialites
	$mspecialites = new MSpecialites();
	$data['SPECIALITES'] = $mspecialites->SelectAllSpecialites();
	
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
 * Vérification de la connexion
 *
 * @return none
 */
function connect()
{
	$musers = new MUsers();
	$value = $musers->VerifUser($_POST);
  
	global $ID_USER;
	$ID_USER = $value['ID_USER'];
  
	home();
  
	return;

} // connect()

/**
 * Affichage de la page d'accueil 
 * en mode administration
 *
 * @return none
 */
function admin()
{

	//debug($_SESSION);

	unset($_SESSION['HOME']);
  
	$_SESSION['ADMIN'] = true;

	global $content;
	$content['title'] = 'Connexion';
	$content['class'] = 'VHtml';
	$content['method'] = 'showHtml';
	$content['arg'] = '../Html/form_connect.html';
  
	return;
} // admin()

/**
 * Déconnexion
 *
 * @return none
 */
function deconnect()
{
	//debug($_SESSION);
	
	session_unset();

	header('Location: ../Php');

	return;
} // deconnect()

/**
 * Affichage de la liste de documents par thème
 * @param int identifiant du thème
 *
 * @return none
 */
function document($id_fiche = null)
{
	/*debug($_GET);
	debug($_POST);
	echo 'gg';
	debug($_SESSION['ID_FICHE']);
	debug($_SESSION['FICHE_TITRE']);*/
	
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
	
} // document()

function doc()
{
	
	//debug($_GET);
	//debug($_POST);
	//echo 'gg';
	//debug($_SESSION['ID_FICHE']);
	//debug($_SESSION['FICHE_TITRE']);
	

	$mdocuments = new MDocuments($_GET['ID_DOC']);
	$data = $mdocuments->SelectDocument();
	
	//debug($data);
	//exit;

	global $content;

	$content['title'] = 'doc';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDoc';
	$content['arg'] = $data;

	return;
	
}

function form_fiche()
{
	$data = isset($_GET['ID_FICHE']) ? $_GET : '';
	
	global $content;

	$content['title'] = 'Nouvelle fiche';
	$content['class'] = 'VAside';
	$content['method'] = 'formFiche';
	$content['arg'] = $data;

	return;
	
} // form_fiche()

function insert_fiche()
{
	$mfiches = new MFiches();
	$mfiches->SetValue($_POST);
	$mfiches->InsertFiche();
	
	home();

	return;

} // insert_fiche()

function delete_fiche()
{
	$mfiches = new MFiches($_GET['ID_FICHE']);
	$mfiches->Delete();

	home();

	return;

} // delete_fiche()

function update_fiche()
{
	$mfiches = new MFiches($_GET['ID_FICHE']);
	$mfiches->SetValue($_POST);
	$mfiches->Update();

	home();

	return;
} // update_fiche

function form_document()
{
	if (isset($_GET['ID_DOC']))
	{
		$mdocuments = new MDocuments($_GET['ID_DOC']);
		$data['DOCUMENTS'] = $mdocuments->SelectDocument();
	
		$data['FICHES'] = $mdocuments->SelectFichesDocuments();
	}
	else
	{
		$data['FICHES'][0]['ID_FICHE'] = $_SESSION['ID_FICHE'];
	}

	global $content;
	
	$content['title'] = 'Nouveau document';
	$content['class'] = 'VDocuments';
	$content['method'] = 'formDocument';
	$content['arg'] = $data;
	
	return;
	
}

function insert_document()
{
	//$value['AUTEUR'] = $_POST['AUTEUR'];
	$value['DOCUMENTS'] = $_POST['DOCUMENTS'];
	$value['TITRE'] = $_POST['TITRE'];
  	 
	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$id_doc = $mdocuments->InsertDocument();
  
	$val['ID_DOC'] = $id_doc;
  
	foreach ($_POST['ID_FICHE'] as $fiche)
	{
		$val['ID_FICHE'] = $fiche;  	 
    
		$mdocuments->SetValue($val);
		$mdocuments->InsertFichesDocuments();
	}
  
	document($_SESSION['ID_FICHE']);

	return;
}

function update_document()
{
	$value['TITRE'] = $_POST['TITRE'];
	//$value['AUTEUR'] = $_POST['AUTEUR'];
	$value['DOCUMENTS'] = $_POST['DOCUMENTS'];
  
	$mdocuments = new MDocuments($_GET['ID_DOC']);
	$mdocuments->SetValue($value);
	$mdocuments->Update();
	$mdocuments->DeleteFichesDocuments();
  
	foreach ($_POST['ID_FICHE'] as $v)
	{
		$val['ID_FICHE'] = $v;
  
		$mdocuments->SetValue($val);
		$mdocuments->InsertThemesDocuments();
	}
  
	document($_SESSION['ID_FICHE']);
  
	return;
}

function delete_document()
{
	$mdocuments = new MDocuments($_GET['ID_DOC']);
	$mdocuments->Delete();
	$mdocuments->DeleteFichesDocuments();
  
	document($_SESSION['ID_FICHE']);
  
	return;

} // delete()



function employers()
{

	$_SESSION['ID_METIER'] = isset($_GET['ID_METIER']) ? $_GET['ID_METIER'] : $id_fiche;
	$_SESSION['METIER'] = isset($_GET['METIER']) ? $_GET['METIER'] : $_SESSION['METIER'];

	$value['ID_METIER'] = $_SESSION['ID_METIER'];
	$mdocuments = new MEmployers();
	$mdocuments->SetValue($value);
	$data['EMPLOYER'] = $mdocuments->SelectAll();

	global $content;

	$content['title'] = 'Liste des EMPLOYER';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showEmployer';
	$content['arg'] = $data;

	return;
	
}

function form_metier()
{
	$data = isset($_GET['ID_METIER']) ? $_GET : '';
	
	global $content;

	$content['title'] = 'Nouveau Metiers';
	$content['class'] = 'VDocuments';
	$content['method'] = 'formMetier';
	$content['arg'] = $data;

  return;
}
function insert_metier()
{
  $metiers = new MMetiers();
  $metiers->SetValue($_POST);
  $data = $metiers->InsertMetier();
  
  //debug($data);
  //exit;

  home();

  return;

} // insert_theme()
function delete_metier()
{
	$metiers = new MMetiers($_GET['ID_METIER']);
	$data = $metiers->Delete();

	//debug($data);
	//exit;
	
	home();

	return;

} // delete_theme()
function update_metier()
{
	$metiers = new MMetiers($_GET['ID_METIER']);
	$metiers->SetValue($_POST);
	$metiers->Update();

	home();

	return;

} // update_theme()



function form_employer($id_metier = null)
{
if (isset($_GET['ID_EMPLOYER']))
  {
    $memployers = new MEmployers($_GET['ID_EMPLOYER']);
    $data['EMPLOYER'] = $memployers->Select();
    
    $data['METIERS'] = $memployers->SelectMetierEmployer();
  }
  else
  {
  	$data['METIERS'][0]['ID_METIER'] = $_SESSION['ID_METIER'];
  }
  

  global $content;
	
  $content['title'] = 'Nouveau EMPLOYER';
  $content['class'] = 'VDocuments';
  $content['method'] = 'formEmployer';
  $content['arg'] = $data;
  
  return;
 
}


function insert_employer()
{

  $value['PRENOM'] = $_POST['PRENOM'];
  $value['NOM'] = $_POST['NOM'];
  	 
  $memployers = new MEmployers();
  $memployers->SetValue($value);
  $id_m = $memployers->Insert();
  
  $val['ID_EMPLOYER'] = $id_m;
  
  foreach ($_POST['ID_METIER'] as $v)
  {
  	$val['ID_METIER'] = $v;  	 
    
    $memployers->SetValue($val);
    $memployers->InsertMetiersEmployers();
  }
  
  employers($_SESSION['ID_METIER']);

  return;

} // insert()





















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