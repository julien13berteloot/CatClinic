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
	
	case 'fiche' 			: fiche(); 	 			break;
	case 'form_fiche' 		: form_fiche(); 		break;
	case 'update_fiche'    	: update_fiche();       break;
	case 'insert_fiche'     : insert_fiche();       break;
	case 'delete_fiche'    	: delete_fiche();       break;
	
	case 'form_document'    : form_document();      break; 
	case 'insert_document'  : insert_document();    break;
    case 'update_document'  : update_document();    break;
	case 'delete_document'  : delete_document();    break;
	
	case 'metier' 			: metier(); 	 		break;
	case 'form_metier' 		: form_metier(); 		break;
	case 'update_metier'    : update_metier();      break;
	case 'delete_metier'    : delete_metier();      break;
	case 'insert_metier'    : insert_metier();      break;
	
	case 'form_employer'    : form_employer();      break;
	case 'insert_employer'  : insert_employer();    break;
	case 'update_employer'  : update_employer();    break;
	case 'delete_employer'  : delete_employer();    break;
	
		

	
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
	

	// Les Fiches
	//$mfiches = new MFiches();
	//$data['FICHES_TITRES'] = $mfiches->SelectAllFiches();
	// Les Documents
	$mdocuments = new MDocuments();
	//$data['DOCUMENTS'] = $mdocuments->SelectAllDocument();
	$data['DOCUMENTS_FICHE'] = $mdocuments->SelectAllFicheDocument();
	// Les Employers
	$memployers = new MEmployers();
	//$data['EMPLOYER'] = $memployers->SelectionAllEmployerMetier();
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


function connect()
{
	$_SESSION['ID_USER'] = true;
		
	$musers = new MUsers();
	$value = $musers->VerifUser($_POST);
  
	global $ID_USER;
	$ID_USER = $value['ID_USER'];
  
	home();
  
	return;

} // connect()

function admin()
{  
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

function fiche($id_fiche = null)
{
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_fiche;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];

	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];
	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAllDocuments();

	global $content;

	$content['title'] = 'Liste des Documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDocuments';
	$content['arg'] = $data;

	return;

} // fiche()

function form_fiche()
{
  $data = isset($_GET['ID_FICHE']) ? $_GET : '';
	
  global $content;

  $content['title'] = 'Nouveau fiche';
  $content['class'] = 'VDocuments';
  $content['method'] = 'formFiche';
  $content['arg'] = $data;

  return;

} // form_fiche()

function update_fiche()
{
	$mcontacts = new MFiches($_GET['ID_FICHE']);
	$mcontacts->SetValue($_POST);
	$mcontacts->UpdateFiche();

	home();

	return;

} // update_fiche()

function insert_fiche()
{
  $mcontacts = new MFiches();
  $mcontacts->SetValue($_POST);
  $mcontacts->Insertfiche();

  home();

  return;

} // insert_fiche()

function delete_fiche()
{
	$mcontacts = new MFiches($_GET['ID_FICHE']);
	$mcontacts->DeleteFiche();

	home();

	return;

} // delete_fiche()

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

} // form_document()

function insert_document()
{
  
  $value['TITRE'] = $_POST['TITRE'];
  $value['DOCUMENT'] = $_POST['DOCUMENT'];
  	 
  $mdocuments = new MDocuments();
  $mdocuments->SetValue($value);
  $id_doc = $mdocuments->Insert();
  
  $val['ID_DOC'] = $id_doc;
  
  foreach ($_POST['ID_FICHE'] as $v)
  {
  	$val['ID_FICHE'] = $v;  	 
    
    $mdocuments->SetValue($val);
    $mdocuments->InsertFichesDocuments();
  }
  
  fiche($_SESSION['ID_FICHE']);

  return;

} // insert_document()

function update_document()
{
  $value['TITRE'] = $_POST['TITRE'];
  $value['DOCUMENT'] = $_POST['DOCUMENT'];
  
  $mdocuments = new MDocuments($_GET['ID_DOC']);
  $mdocuments->SetValue($value);
  $mdocuments->UpdateDocument();
  $mdocuments->DeleteFichesDocuments();
  
  foreach ($_POST['ID_FICHE'] as $v)
  {
  	$val['ID_FICHE'] = $v;
  
  	$mdocuments->SetValue($val);
  	$mdocuments->InsertFichesDocuments();
  }
  
  fiche($_SESSION['ID_FICHE']);
  
  return;

} // update_document()

function delete_document()
{
  $mdocuments = new MDocuments($_GET['ID_DOC']);
  $mdocuments->DeleteDocument();
  $mdocuments->DeleteFichesDocuments();

  fiche($_SESSION['ID_FICHE']);
  
  return;

} // delete_document()

function metier($id_metier = null)
{
	$_SESSION['ID_METIER'] = isset($_GET['ID_METIER']) ? $_GET['ID_METIER'] : $id_metier;
	$_SESSION['METIER'] = isset($_GET['METIER']) ? $_GET['METIER'] : $_SESSION['METIER'];

	$value['ID_METIER'] = $_SESSION['ID_METIER'];
	$mdocuments = new MEmployers();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAllEmployers();

	global $content;

	$content['title'] = 'Liste des metiers';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showMetiers';
	$content['arg'] = $data;

	return;

} // document()

function form_metier()
{
  $data = isset($_GET['ID_METIER']) ? $_GET : '';
	
  global $content;

  $content['title'] = 'Nouveau metier';
  $content['class'] = 'VDocuments';
  $content['method'] = 'formMetier';
  $content['arg'] = $data;

  return;

} // form_metier()

function update_metier()
{
	$mcontacts = new MMetiers($_GET['ID_METIER']);
	$mcontacts->SetValue($_POST);
	$mcontacts->UpdateMetier();

	home();

	return;

} // update_metier()

function delete_metier()
{
	$mcontacts = new MMetiers($_GET['ID_METIER']);
	$mcontacts->DeleteMetier();

	home();

	return;

} // delete_metier()

function insert_metier()
{
  $mcontacts = new MMetiers();
  $mcontacts->SetValue($_POST);
  $mcontacts->InsertMetier();

  home();

  return;

} // insert_metier()

function form_employer()
{	
  if (isset($_GET['ID_EMPLOYER']))
  { 
	$memployers = new MEmployers($_GET['ID_EMPLOYER']);

	$data['EMPLOYER'] = $memployers->SelectEmployer();
    
    $data['METIERS'] = $memployers->SelectMetierEmployers();
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

} // form()

function insert_employer()
{
  $value['PRENOM'] = $_POST['PRENOM'];
  $value['NOM'] = $_POST['NOM'];
  
  $memployers = new MEmployers();
  $memployers->SetValue($value);
  $id_doc = $memployers->InsertEmployer();
  
  $val['ID_EMPLOYER'] = $id_doc;
  
  foreach ($_POST['ID_METIER'] as $v)
  {
  	$val['ID_METIER'] = $v;  	 
    
    $memployers->SetValue($val);
    $memployers->InsertMetierEmployers();
  }
  
  metier($_SESSION['ID_METIER']);

  return;

} // insert()

function update_employer()
{	
  $value['PRENOM'] = $_POST['PRENOM'];
  $value['NOM'] = $_POST['NOM'];
  
  $memployers = new MEmployers($_GET['ID_EMPLOYER']);
  $memployers->SetValue($value);
  $memployers->UpdateEmployer();
  $memployers->DeleteMetierEmployers();
  
  foreach ($_POST['ID_METIER'] as $v)
  {
  	$val['ID_METIER'] = $v;
  
  	$memployers->SetValue($val);
  	$memployers->InsertMetierEmployers();
  }
  
  metier($_SESSION['ID_METIER']);
  
  return;

} // update()

function delete_employer()
{
  $memployers = new MEmployers($_GET['ID_EMPLOYER']);
  $memployers->Delete();
  $memployers->DeleteMetierEmployers();
  
  metier($_SESSION['ID_METIER']);
  
  return;

} // delete()

function doc()
{
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

function document($id_fiche = null)
{	
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_fiche;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];	

	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAllDocuments();
	
	global $content;

	$content['title'] = 'Liste des documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDocuments';
	$content['arg'] = $data;

	return;
	
} // document()

?>