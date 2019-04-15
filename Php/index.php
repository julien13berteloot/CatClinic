<?php
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
	case 'form_fiche'			: form_fiche();				break;
	case 'insert_fiche'			: insert_fiche();			break;
	case 'delete_fiche'			: delete_fiche();			break;
	case 'update_fiche'    		: update_fiche();       	break;
	
	case 'admin_doc'    		: admin_doc();    			break;	
	case 'document'    			: document();       		break;
	case 'form_document'		: form_document();			break;
	case 'insert_document'  	: insert_document();    	break;
	case 'delete_document'		: delete_document();		break;
	case 'update_document'  	: update_document();    	break;
	
	case 'lesfiches'			: lesfiches();				break;
	case 'la_fiche'				: la_fiche();				break;
	
	case 'lesdocuments'			: lesdocuments();			break;	
	case 'fiche'				: fiche();					break;	// Aside
	
	case 'formulaire_specialite': formulaire_specialite();	exit();
	case 'insert_Specialites'   : insert_Specialites();		exit();
	case 'specialites'   		: specialites();			exit();
	case 'admin_Specialites'    : admin_Specialites();		exit();
	case 'update_Specialites'   : update_Specialites();		exit();
	case 'delete_Specialites'   : delete_Specialites();		exit();
	
	case 'formulaire_docteur' 	: formulaire_docteur();		exit();
	case 'insert_docteur'     	: insert_docteur();			exit();
	case 'docteur'   			: docteur();				exit();	
	case 'adminDocteur'      	: adminDocteur();			exit();
	case 'updateDocteur'     	: updateDocteur();			exit();
	case 'delete_Docteur'		: delete_Docteur();			exit();
	
	case 'formulaire_asv' 		: formulaire_asv();			exit();									
	case 'insert_asv'     		: insert_asv();				exit();								
	case 'asv'   				: asv();					exit();
	case 'adminAsv'      		: adminAsv();				exit();	
	case 'updateAsv'     		: updateAsv();				exit();
	case 'delete_Asv'			: delete_Asv();				exit();
								
	case 'contact'				: contact();				break;
	
	default           			: home();

}

// Mise en page
require('../View/layout.view.php');

function home()
{
	// Section Fiches
	$mfiches = new MFiches();
	$data['FICHESDERNIERE'] = $mfiches-> SelectDerniereFiche();
array_walk($data['FICHESDERNIERE'], 'strip_xss');
	$data['FICHESLASTDERNIERE'] = $mfiches-> SelectAvantDerniereFiche();
array_walk($data['FICHESLASTDERNIERE'], 'strip_xss');
	// Les Docteurs
	$mdocteurs = new MDocteurs();
	$data['DOCTEURS'] = $mdocteurs->SelectAllDocteur();
array_walk($data['DOCTEURS'], 'strip_xss');
	// Les Asv
	$masv = new MAsv();
	$data['ASV'] = $masv->SelectAllAsv();
array_walk($data['ASV'], 'strip_xss');
	// Les Specialites
	$mspecialites = new MSpecialites();
	$data['SPECIALITES'] = $mspecialites-> SelectAllSpecialites();
array_walk($data['SPECIALITES'], 'strip_xss');
	
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
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------PAGE CONTACT---------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function contact()
{
	global $content;
	
	$content['title'] = 'Formulaire de contact';
	$content['class'] = 'VHtml';
	$content['method'] = 'showHtml';
	$content['arg'] = '../Html/contact.html';
	
	return;
	
} // contact
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------ADMIN FICHE----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
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

function form_fiche ()
{
	//debug($_GET);
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
	$destination = IMG . $_FILES['IMAGE']['name'];
     
	move_uploaded_file($_FILES['IMAGE']['tmp_name'], $destination);
	
	if ($_FILES['IMAGE']['name'])
	{	  	
		$value['IMAGE'] = $_FILES['IMAGE']['name'];
	}
	else
	{
		$value['IMAGE'] = '';
	}
	
	$value['FICHE_TITRE'] = $_POST['FICHE_TITRE'];

	$mcontacts = new MFiches();
	$mcontacts->SetValue($value);
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
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------ADMIN DOCU-----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function admin_doc($id_docu = null)
{
	//debug($_GET);
	//debug($_SESSION);
	unset($_SESSION['ADMIN_FICHE']);
	
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_docu;
	//$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
	$_SESSION['ADMIN_DOC'] = true;
	
	global $content;
	
	$content['title'] = 'Gestion des documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showGestionDoc';
	$content['arg'] = '';
  
	return;
	
} // admin_doc()

function document($id_docu = null)
{
	//debug($_GET);
	//debug($_SESSION);
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_docu;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];

	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];
	$mdocuments = new MDocuments();
	$mdocuments->SetValue($value);
	$data = $mdocuments->SelectAllDocuments();
array_walk($data, 'strip_xss');

	global $content;

	$content['title'] = 'documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showDocument';
	$content['arg'] = $data;

	return;
	
} // document()

function form_document()
{
	//debug($_GET);
	//debug($_SESSION);
	if (isset($_GET['ID_DOC']))
	{
		$mdocuments = new MDocuments($_GET['ID_DOC']);
		$data['DOCUMENTS'] = $mdocuments->SelectDocument();
array_walk($data['DOCUMENTS'], 'strip_xss');
		$data['FICHES'] = $mdocuments->SelectFichesDocuments();
array_walk($data['FICHES'], 'strip_xss');
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

function update_document($id_docu=null)
{
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_docu;
	//$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
	$value['TITRE'] = $_POST['TITRE'];
	$value['DOCUMENT'] = $_POST['DOCUMENT'];
  
	//$mdocuments = new MDocuments($_GET['ID_DOC']);
	//$mdocuments->SetValue($value);
	$value['ID_FICHE'] = $_SESSION['ID_FICHE'];
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
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------ADMIN SPECIALITES----------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function formulaire_specialite()
{	
	$vhtml = new VHtml();
	$vhtml->showHtml('../Html/form_specialites.html');
  
	return;
  
} // formulaire_specialite()

function insert_Specialites()
{
	$mspe = new MSpecialites();
	$mspe->SetValue($_POST);
	$value = $mspe->Insert();

	echo json_encode($value);

	return;

} // insert_Specialites()

function specialites()
{
	$mspe = new MSpecialites();
	$value = $mspe->SelectAllSpecialites();		
	$mspe = new VSpecialites();
	$mspe->showSpecialites($value);
	
	return;

} // specialites()

function admin_Specialites()
{
	$mspe = new MSpecialites();
	$value = $mspe->SelectAllSpecialites();
	$vcontacts = new VSpecialites();
	$vcontacts->showAdminSpecialites($value);

	return;
  
} // admin_Specialites()

function update_Specialites()
{
	$nb_id = count($_POST['ID_SPECIALITES']);
   
	for($i = 0;  $i < $nb_id; ++$i)
	{
		$mspe = new MSpecialites($_POST['ID_SPECIALITES'][$i]);
		$value = $mspe->SelectSpecialite();
		$val['NOM'] = ($_POST['NOM'][$i]) ? $_POST['NOM'][$i] : $value['NOM'];
		$mspe->SetValue($val);
		$mspe->Update();
	}
 
	echo json_encode($_POST);
	
	return;

} // update_Specialites()

function delete_Specialites()
{
	$nb_id = count($_POST['ID_SPECIALITES']);
   
	for($i = 0;  $i < $nb_id; ++$i)
	{
		$mspe = new MSpecialites($_POST['ID_SPECIALITES'][$i]);
		$value = $mspe->SelectSpecialite();
		$val['NOM'] = ($_POST['NOM'][$i]) ? $_POST['NOM'][$i] : $value['NOM'];
		$mspe->SetValue($val);
		$mspe->Delete();
	}
 
	echo json_encode($_POST);
	
	return;

} // delete_Specialites
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------ADMIN DOCTEURS-------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function formulaire_docteur()
{
	$vhtml = new VHtml();
	$vhtml->showHtml('../Html/formulaire_docteur.html');
  
	return;
  
} // formulaire_docteur()

function insert_docteur()
{		
	$mdocteurs = new MDocteurs();
	$mdocteurs->SetValue($_POST);
	$value = $mdocteurs->InsertDocteur();

	echo json_encode($value);

	return;

} // insert_docteur()

function docteur()
{
	$mdocteurs = new MDocteurs();
	$value = $mdocteurs->SelectAllDocteur();	
	
	$vdocteurs = new VDocteurs();
	$vdocteurs->showDocteur($value);

	return;

} // docteur()

function adminDocteur()
{
	$mdocteurs = new MDocteurs();
	$value = $mdocteurs->SelectAllDocteur();

	$vcontacts = new VDocteurs();
	$vcontacts->showAdminDoc($value);

	return;

} // adminDocteur()

function updateDocteur()
{
   $nb_id = count($_POST['ID_DOCTEUR']);
   
   for($i = 0;  $i < $nb_id; ++$i)
   {
     $mdocteurs = new MDocteurs($_POST['ID_DOCTEUR'][$i]);
     $value = $mdocteurs->SelectDocteur();
     $val['NOM'] = ($_POST['NOM'][$i]) ? $_POST['NOM'][$i] : $value['NOM'];
     $val['PRENOM'] = ($_POST['PRENOM'][$i]) ? $_POST['PRENOM'][$i] : $value['PRENOM'];
     $mdocteurs->SetValue($val);
     $mdocteurs->Update();
   }
 
  echo json_encode($_POST);
	
  return;

} // updateDocteur()

function delete_Docteur()
{
	$nb_id = count($_POST['ID_DOCTEUR']);
   
   for($i = 0;  $i < $nb_id; ++$i)
   {
     $mdocteurs = new MDocteurs($_POST['ID_DOCTEUR'][$i]);
     $value = $mdocteurs->SelectDocteur();
     $val['NOM'] = ($_POST['NOM'][$i]) ? $_POST['NOM'][$i] : $value['NOM'];
     $val['PRENOM'] = ($_POST['PRENOM'][$i]) ? $_POST['PRENOM'][$i] : $value['PRENOM'];
     $mdocteurs->SetValue($val);
     $mdocteurs->delete();
   }
 
  echo json_encode($_POST);
	
  return;
  
} // delete_Docteur()
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------ADMIN ASV-------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function formulaire_asv()
{
	$vhtml = new VHtml();
	$vhtml->showHtml('../Html/formulaire_asv.html');
  
	return;
} // formulaire_asv()

function insert_asv()
{		
	$masv = new MAsv();
	$masv->SetValue($_POST);
	$value = $masv->InsertAsv();

	echo json_encode($value);

	return;

} // insert_asv()

function asv()
{
	$masv = new MAsv();
	$value = $masv->SelectAllAsv();	
	
	$vasv = new VAsv();
	$vasv->showAsv($value);

	return;

} // asv()

function adminAsv()
{
	$masv = new MAsv();
	$value = $masv->SelectAllAsv();

	$vasv = new VAsv();
	$vasv->showAdminAsv($value);

	return;

} // adminAsv()

function updateAsv()
{
	$nb_id = count($_POST['ID_ASV']);
   
	for($i = 0;  $i < $nb_id; ++$i)
	{
		$masv = new MAsv($_POST['ID_ASV'][$i]);
		$value = $masv->SelectAsv();
		$val['NOM'] = ($_POST['NOM'][$i]) ? $_POST['NOM'][$i] : $value['NOM'];
		$val['PRENOM'] = ($_POST['PRENOM'][$i]) ? $_POST['PRENOM'][$i] : $value['PRENOM'];
		$masv->SetValue($val);
		$masv->Update();
	}
 
	echo json_encode($_POST);
	
	return;

} // updateAsv()

function delete_Asv()
{
	$nb_id = count($_POST['ID_ASV']);
   
	for($i = 0;  $i < $nb_id; ++$i)
	{
		$masv = new MAsv($_POST['ID_ASV'][$i]);
		$value = $masv->SelectAsv();
		$val['NOM'] = ($_POST['NOM'][$i]) ? $_POST['NOM'][$i] : $value['NOM'];
		$val['PRENOM'] = ($_POST['PRENOM'][$i]) ? $_POST['PRENOM'][$i] : $value['PRENOM'];
		$masv->SetValue($val);
		$masv->delete();
	}
 
	echo json_encode($_POST);
	
	return;

} // delete_Asv
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------PAGE FICHE-----------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function lesfiches()
{	
	global $content;
	
	$content['title'] = 'Les Fiches';
	$content['class'] = 'VFiches';
	$content['method'] = 'showPageFiches';
	$content['arg'] = '';
	
	return;
} // lesfiches()

function la_fiche($id_docu = null)
{
	//debug($_GET);
	//debug($_SESSION);
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_docu;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
	$mdocuments = new MDocuments($_GET['ID_DOC']);
	$data['DOCUMENTS'] = $mdocuments->SelectDocument();		
	$data['FICHES'] = $mdocuments->SelectFichesDocuments();
	
	global $content;
	
	$content['title'] = 'La Fiches';
	$content['class'] = 'VFiches';
	$content['method'] = 'showLaFiches';
	$content['arg'] = $data;
  
	return;

} // la_fiche()
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------PAGE DOCUMENTS-------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function lesdocuments()
{
	global $content;
	
	$content['title'] = 'Les Documents';
	$content['class'] = 'VDocuments';
	$content['method'] = 'showLesDocuments';
	$content['arg'] = '';
	
	return;
} // lesdocuments()
/*-------------------------------------------------------------------------------------------------------------------
------------------------------------------ASIDE----------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------*/
function fiche($id_fiche = null)
{
	//debug($_GET);
	$_SESSION['ID_FICHE'] = isset($_GET['ID_FICHE']) ? $_GET['ID_FICHE'] : $id_fiche;
	$_SESSION['FICHE_TITRE'] = isset($_GET['FICHE_TITRE']) ? $_GET['FICHE_TITRE'] : $_SESSION['FICHE_TITRE'];
	
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

?>