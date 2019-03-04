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
	case 'home'         		: home();         			break;
	case 'connect' 				: connect(); 				break;
	case 'admin' 				: admin(); 					break; 
	case 'deconnect'    		: deconnect();    			break;
	case 'admin_fiche'    		: admin_fiche();    		break;
	case 'admin_doc'    		: admin_doc();    			break;
	
	case 'form_fiche'			: form_fiche();				break;
	case 'insert_fiche'			: insert_fiche();			break;
	case 'delete_fiche'			: delete_fiche();			break;
	case 'update_fiche'    		: update_fiche();       	break;
	
	case 'document'    			: document();       		break;
	case 'form_document'		: form_document();			break;
	case 'insert_document'  	: insert_document();    	break;
	case 'delete_document'		: delete_document();		break;
	case 'update_document'  	: update_document();    	break;
	
	case 'admin_spe'    		: admin_spe();    			break;	
	
	case 'formulaire_specialite': formulaire_specialite();	exit();
	//case 'insert_Specialites'   : insert_Specialites();		exit();
								
								
	
	//case 'fiche'			: fiche();				break;
	
		
	
	
	
	
	
	
	
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
	$mfiches = new MFiches();
	$data['FICHES'] = $mfiches-> SelectAllFicheDocuement();
	
	// Les Specialites
	$mspecialites = new MSpecialites();
	$data['SPECIALITES'] = $mspecialites-> SelectAllSpecialites();  
	
	//debug($data);
	//exit;
	
	global $content;
	
	$content['title'] = 'CatClinick-Projet';
	$content['class'] = 'VPages';
	$content['method'] = 'showPage';
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

function deconnect()
{	
	session_unset();

	header('Location: ../Php');

	return;
	
} // deconnect()

function admin_fiche()
{
	unset($_SESSION['ADMIN_DOC']);
	
	$_SESSION['ADMIN_FICHE'] = true;
	
	global $content;
	
	$content['title'] = 'Gestion des fiches';
	$content['class'] = 'VFiches';
	$content['method'] = 'showGestionFiche';
	$content['arg'] = '';
  
	return;
	
} // admin_fiche()

function admin_doc()
{
	debug($_GET);
	debug($_SESSION);
	unset($_SESSION['ADMIN_FICHE']);
	
	$_SESSION['ADMIN_DOC'] = true;
	
	global $content;
	
	$content['title'] = 'Gestion des documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showGestionDoc';
	$content['arg'] = '';
  
	return;
	
} // admin_doc()

function form_fiche ()
{
	debug($_GET);
	$data = isset($_GET['ID_FICHE']) ? $_GET : '';
	
	global $content;

	$content['title'] = 'Nouvelle fiche';
	$content['class'] = 'VFiches';
	$content['method'] = 'formFiche';
	$content['arg'] = $data;

  return;
  
} // form_fiche()

function insert_fiche ()
{
	debug($_GET);
	
	$mcontacts = new MFiches();
	$mcontacts->SetValue($_POST);
	$mcontacts->InsertFiche();

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

function update_fiche()
{
	$mcontacts = new MFiches($_GET['ID_FICHE']);
	$mcontacts->SetValue($_POST);
	$mcontacts->UpdateFiche();

	home();

	return;

} // update_fiche()

function document($id_docu = null)
{
	debug($_GET);
	debug($_SESSION);
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_docu;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];

	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];
	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAllDocuments();

	global $content;

	$content['title'] = 'documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDocument';
	$content['arg'] = $data;

	return;
	
} // document()

function form_document()
{
	debug($_GET);
	debug($_SESSION);
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
	$id_doc = $mdocuments->InsertDocument();
  
	$val['ID_DOC'] = $id_doc;
  
	foreach ($_POST['ID_FICHE'] as $v)
	{
		$val['ID_FICHE'] = $v;  	 
    
		$mdocuments->SetValue($val);
		$mdocuments->InsertFichesDocuments();
	}
  
	home($_SESSION['ID_FICHE']);

	return;
	
} // insert_document()

function delete_document()
{
	$mdocuments = new MDocuments($_GET['ID_DOC']);
	$mdocuments->DeleteDocument();
	$mdocuments->DeleteFichesDocuments();
   
	home($_SESSION['ID_FICHE']);
  
	return;

} // delete_document()

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
  
	home($_SESSION['ID_FICHE']);
  
	return;
	
} // update_document()

function admin_spe()
{
/*
	global $content;

	$content['title'] = 'Gestion des Specialites';
	$content['class'] = 'VHtml';
	$content['method'] = 'showHtml';
	$content['arg'] = '../Html/specialites.html';

	return;
*/
}

function formulaire_specialite()
{	
	$vhtml = new VHtml();
	$vhtml->showHtml('../Html/formulaire.html');
  
	return;
  
} // formulaire_specialite()
/*
function insert_Specialites()
{
	$mspe = new MSpecialites();
	$mspe->SetValue($_POST);
	$value = $mspe->Insert();

	// Envoie au fomat JSON du tableau $value
	echo json_encode($value);

	return;

} // insert_Specialites()
*/







/*
function fiche($id_fiche = null)
{
	debug($_GET);
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_fiche;
	$_SESSION['TITRE'] = isset($_GET['TITRE']) ? $_GET['TITRE'] : $_SESSION['TITRE'];
	
	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];
	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAllDocuments();
	
	//debug($data);
	//exit;
	
	global $content;
	
	$content['title'] = 'Fiche';
	$content['class'] = 'VFiches';
	$content['method'] = 'showFiche';
	$content['arg'] = $data;
  
	return;
	
} // fiche()
*/

?>