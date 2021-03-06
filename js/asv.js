function boxAsv()
{
	var boxAsv = document.getElementById('boxasv'); 
	//boxAsv.style.display = (boxAsv.style.display == 'block') ? 'none' : 'block';
	boxAsv.style.display = (boxAsv.style.display == 'none') ? 'block' : 'none';
	return;
}


function initFormAsv()
{
  // Récupère l'élément <form id="form_employer">
  var submit_form_employer = document.querySelector('#form_asv');

  // Pour l'élément <form id="form_employer">
  // on associe un événement submit
  // avec comme fonction associée insertEmployer
  Listener(submit_form_employer, 'submit', submitAsv);
   
  return;
  
} // initFormDocteur()

/** 
 * Soumet le formulaire
 *  
 * @return none
 */ 
function submitAsv(event)
{
  // Arrête la propagation de l'événement
  stopEvent(event);

  // Soumission du formulaire et
  // Récupération de l'objet généré par JSON.parse()
  var rep = actionForm('../Php/index.php?EX=insert_asv', this);

  // Remplace le contenu de <div id="content" par l'affichage des employés
  changeContent('id_sticky_content', '../Php/index.php?EX=asv', '', 'initContactsAsv()');

  return;
	
} // submitEmployer(event)

/** 
 * Initialise un écouteur sur l'élément <button>
 *  
 * @return none
 */ 
function initContactsAsv()
{
  // Récupère l'élément <button id="admin">
  var click_button_admin = document.querySelector('#admin_asv');  
  // Pour l'élément <button id="admin">
  // on associe un événement click
  // avec comme fonction associée adminContactsDocteur
  Listener(click_button_admin, 'click', adminContactsAsv);
  
  // Récupère l'élément <button id="return">
  var click_button_return = document.querySelector('#return_asv');
  // Pour l'élément <button id="return">
  // on associe un événement click
  // avec comme fonction une fonction anonyme
  // qui affiche la page d'accueil
  Listener(click_button_return, 'click', function(){location.replace('../Php/index.php')});
  
  return;
  
} // initContactsDocteur()

/** 
 * Remplace le contenu de <div id="content" par l'affichage des contacts
 * en mode administration
 * puis déclenche la callback initAdmin()
 *  
 * @return none
 */ 
function adminContactsAsv()
{
  changeContent('id_sticky_content', '../Php/index.php?EX=adminAsv', '', 'initAdminAsv()');
  
  return;
  
} // adminContactsDocteur()
 
/** 
 * Initialise l'affichage des contacts en mode administration
 * en changeant la graisse de la police ainsi que sa couleur
 *  
 * @return none
 */ 
function initAdminAsv()
{
  // Récupère les éléments <span>
  var click_span = document.querySelectorAll('span');
  // Nombre d'éléments <span>
  var nb_click_span = click_span.length;

  // Boucle sur les éléments <span>
  for(var i = 0; i < nb_click_span; ++i)
  {
	// Change la couleur de la police en rouge
	click_span[i].style.color = 'red';
	// Change la graisse de la police en gras
	click_span[i].style.fontWeight = 'bold';
	  
    // Pour l'élément <span>
    // on associe un événement click
    // avec comme fonction associée textInput
	Listener(click_span[i], 'click', textInput);
  }
  
  // Récupère l'élément <button id="update">
  var click_button_update = document.querySelector('#update_asv');
  // Pour l'élément <button id="update">
  // on associe un événement click
  // avec comme fonction associée updateContactsDocteur
  Listener(click_button_update, 'click', updateContactsAsv);
  
			// Récupère l'élément <button id="update">
			var click_button_delete = document.querySelector('#delete_asv');
			// Pour l'élément <button id="update">
			// on associe un événement click
			// avec comme fonction associée updateContactsDocteur
			Listener(click_button_delete, 'click', deleteContactsAsv);
  
  // Récupère l'élément <button id="normal">
  var click_button_normal = document.querySelector('#normal_asv');
  // Pour l'élément <button id="normal">
  // on associe un événement click
  // avec comme fonction associée une fonction anonyme
  // qui affiche les contacts
  Listener(click_button_normal, 'click', function(){changeContent('id_sticky_content', '../Php/index.php?EX=Asv', '', 'initContactsAsv()')});
    
  return;
  
} // initAdminDocteur()

/** 
 * Remplace le contenu texte par élément input
 * dont l'attribut value contient le texte
 *  
 * @return none
 */ 
function textInput(event)
{
  // Supprime l'écouteur sur l'élément cliqué
  Remove(this, 'click', textInput);

  var elem_class = this.getAttribute('class');
 	  
  // Récupère le texte de l'élément cliqué
  var text = this.innerHTML;
	 
  // Récupère la largeur approximative du texte
  var width_text = text.length*10 + 'px';
	  
  // Crée un élément <input>
  var input = document.createElement('input');
  
  input.setAttribute('name', elem_class);
  input.setAttribute('value', text);
	  
  // Met le contenu de l'attribut value 
  // avec le texte de l'élément cliqué
  input.value = text;  
	  
  // Modifie la largeur de l'élément <input>
  // suivant celle du texte
  input.style.width = width_text;
	 
  // Vide le contenu de l'élément cliqué
  this.innerHTML = '';
	  
  // Ajoute à l'élément cliqué
  // l'élément <input>
  this.appendChild(input);

  return;
  
} // textInput()

/** 
 * Initialise d(un écouteur sur l'élément <form>
 *  
 * @return none
 */ 

 
 function updateContactsAsv(event)
{
  // Arrête la propagation de l'événement
  stopEvent(event);

  var frm = document.querySelector('form');
 
  var p_all = document.querySelectorAll('p');
  var nb_p_all = p_all.length;
  
  // Définition des différents tableaux
  var name = new Array();
  var value = new Array();
  name['ID_ASV'] = new Array();
  value['ID_ASV'] = new Array();
  name['NOM'] = new Array();
  value['NOM'] = new Array();
  name['PRENOM'] = new Array();
  value['PRENOM'] = new Array();
  
  // Récupération des éléments paragraphe
  var p_all = document.querySelectorAll('p');
  var nb_p_all = p_all.length;

  // Boucle sur les éléments paragraphe
  for (var i = 0, k = 0; i < nb_p_all; ++i)
  {
	  // Récupération des éléments input dans un paragraphe
	  var input_all = p_all[i].querySelectorAll('input');

	  // Vérifie s'il y a au moins un élément input
	  if (input_all.length)
	  {
		// Récupère l'identifiant du paragraphe (correspondant au ID_EMPLOYER)
	    var id_doc = p_all[i].id;

	    // Instanciation des clefs ID_EMPLOYER
	    name['ID_ASV'][k] = 'ID_ASV[]';
	    value['ID_ASV'][k] = id_doc;

	    // Instanciation des clefs NOM et PRENOM
	    name['NOM'][k] = 'NOM[]';
	    name['PRENOM'][k] = 'PRENOM[]';
	    // SI le name de l'élément input est nom
	    // on récupère sa valeur (value)
	    // et on test s'il n'y a pas un autre élément input qui correspond au prenom 
	    if (input_all[0].name == 'nom')
	    {
	      value['NOM'][k] =  input_all[0].value;
	      // S'il y a un autre élément input on rédupère la valeur (value)
	      // sinon valeur ''
	      value['PRENOM'][k] =  (input_all[1]) ? input_all[1].value : '';
	    }
	    else
	    {
	      // Valeur '' pour l'index NOM
	      value['NOM'][k] =  '';
	      // on récupère la valeur (value) pour le PRENOM
	      value['PRENOM'][k] = input_all[0].value;
	    }
	    
        ++k;
	  }
  }  
  
  var span = document.querySelectorAll('span');
  var nb_span = span.length;

  // Boucle sur les éléments <span>
  for(var i = 0; i < nb_span; ++i)
  {
	// Teste si l'élément <span> contient un élément <input>
	if (span[i].querySelector('input'))
	{
	  // Remplace le contenu de l'élément <span> par la valeur modifiée
	  span[i].innerHTML = '';
	  // Pour l'élément <span>
	  // on associe un événement click
	  // avec comme fonction associée textInput
	  Listener(span[i], 'click', textInput);
	}
  }

  
  // Soumission du formulaire de modification des contacts
  // avec passage des tableaux name et value correspondant 
  // à l'ajout dans l'objet FormData d'une clé (name) avec sa valeur (value)
  // Récupération de l'objet généré par JSON.parse()
  // On appelle la fonction actionForm2
  var rep = actionFormAsv('../Php/index.php?EX=updateAsv', frm, name, value);
  
  changeContent('id_sticky_content', '../Php/index.php', 'EX=adminAsv');
  
   return;
  
} // updateContactsDocteur(event)

 function deleteContactsAsv(event)
{
  // Arrête la propagation de l'événement
  stopEvent(event);

  var frm = document.querySelector('form');
 
  var p_all = document.querySelectorAll('p');
  var nb_p_all = p_all.length;
  
  // Définition des différents tableaux
  var name = new Array();
  var value = new Array();
  name['ID_ASV'] = new Array();
  value['ID_ASV'] = new Array();
  name['NOM'] = new Array();
  value['NOM'] = new Array();
  name['PRENOM'] = new Array();
  value['PRENOM'] = new Array();
  
  // Récupération des éléments paragraphe
  var p_all = document.querySelectorAll('p');
  var nb_p_all = p_all.length;

  // Boucle sur les éléments paragraphe
  for (var i = 0, k = 0; i < nb_p_all; ++i)
  {
	  // Récupération des éléments input dans un paragraphe
	  var input_all = p_all[i].querySelectorAll('input');

	  // Vérifie s'il y a au moins un élément input
	  if (input_all.length)
	  {
		// Récupère l'identifiant du paragraphe (correspondant au ID_EMPLOYER)
	    var id_doc = p_all[i].id;

	    // Instanciation des clefs ID_EMPLOYER
	    name['ID_ASV'][k] = 'ID_ASV[]';
	    value['ID_ASV'][k] = id_doc;

	    // Instanciation des clefs NOM et PRENOM
	    name['NOM'][k] = 'NOM[]';
	    name['PRENOM'][k] = 'PRENOM[]';
	    // SI le name de l'élément input est nom
	    // on récupère sa valeur (value)
	    // et on test s'il n'y a pas un autre élément input qui correspond au prenom 
	    if (input_all[0].name == 'nom')
	    {
	      value['NOM'][k] =  input_all[0].value;
	      // S'il y a un autre élément input on rédupère la valeur (value)
	      // sinon valeur ''
	     // value['PRENOM'][k] =  (input_all[1]) ? input_all[1].value : '';
	    }
	    else
	    {
	      // Valeur '' pour l'index NOM
	      value['NOM'][k] =  '';
	      // on récupère la valeur (value) pour le PRENOM
	      //value['PRENOM'][k] = input_all[0].value;
	    }
	    
        ++k;
	  }
  }  
  
  var span = document.querySelectorAll('span');
  var nb_span = span.length;

  // Boucle sur les éléments <span>
  for(var i = 0; i < nb_span; ++i)
  {
	// Teste si l'élément <span> contient un élément <input>
	if (span[i].querySelector('input'))
	{
	  // Remplace le contenu de l'élément <span> par la valeur modifiée
	  span[i].innerHTML = '';
	  // Pour l'élément <span>
	  // on associe un événement click
	  // avec comme fonction associée textInput
	  Listener(span[i], 'click', textInput);
	}
  }

  
  // Soumission du formulaire de modification des contacts
  // avec passage des tableaux name et value correspondant 
  // à l'ajout dans l'objet FormData d'une clé (name) avec sa valeur (value)
  // Récupération de l'objet généré par JSON.parse()
  // On appelle la fonction actionForm2
  var rep = actionFormAsv('../Php/index.php?EX=delete_Asv', frm, name, value);
  
  changeContent('id_sticky_content', '../Php/index.php', 'EX=adminAsv');
  
   return;
  
} // updateContactsDocteur(event)