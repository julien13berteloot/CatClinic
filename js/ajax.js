/**
 * Fonctions javascript utilisant les appels aux serveur http
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXERCICE-MOOC
 */
var DEBUG_AJAX = false;

/**
 * Modification du contenu d'un �l�ment en mode asynchrone
 * @param string identifiant de l'�l�ment � modifier
 * @param string programme de modification
 * @param string param�tres de modification
 * @param string programme d'appel apr�s la modification
 *  
 * @return none
 */
function changeContent(id, url, param, callback)
{

  // R�cup�re l'�l�ment cible dont l'identifiant vaut id
  var c = document.getElementById(id);
  
  // Met une image anim�e afin de montrer le chargement en cours du contenu
  c.innerHTML = '<img src="../Img/loading.gif" alt="Chargement" />';

  //R�cup�re la connexion au serveur http
  var xhr = new XMLHttpRequest();

  // Ouvre la connexion en mode asynchrone avec le serveur http avec comme adresse url
  xhr.open('POST', url, true);

  // Envoie des ent�tes pour l'encodage
  xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

  //Envoie les param�tres param (m�me vide)
  xhr.send(param);
  
  // Ex�cution en mode asynchrone de la fonction anonyme d�s que l'on obtient une r�ponse du serveur http
  xhr.onreadystatechange = function() 
  {
    // Debuggage
	if (DEBUG_AJAX) alert(xhr.responseText);
	
    // Test si le serveur a tout re�u (200) et que le serveur ait fini (4)
    if (xhr.status == 200 && xhr.readyState == 4)
    {
      // Modifie l'�l�ment ayant pour identificateur id suivant le programme url
      c.innerHTML = xhr.responseText;

      //Test s'il y a une callback 
      if (callback != null)
      {
    	// Ex�cution du script contenu dans la callback
        window.eval(callback);
      }

      // Si on a du javascript dans le nouveau contenu on identifie les scripts et on force l'�x�cution avec eval()
      var allscript = c.getElementsByTagName('script');
      for (var i = 0; i < allscript.length; ++i)
      {
    	// Ex�cution du script
        window.eval(allscript[i].text);
      }
    }
  };
  
  return;

} // changeContent(id, url, param, callback)

/**
 * R�cup�ration d'une action (d'un formulaire) en mode synchrone au format json
 * @param string programme de modification
 * @param string param�tres de modification
 *  
 * @return string json
 */
function actionForm(url, frm)
{
  // R�cup�re la connexion au serveur http
  var xhr = new XMLHttpRequest();

  //Ouvre la connexion en mode synchrone avec le serveur http � l'adresse url
  xhr.open('POST', url, false);

  //R�cup�re les donn�es du formulaire sous la forme clef/valeur
  var data = new FormData(frm);

  // Envoie les donn�es du formulaire
  xhr.send(data)
  
  // Debuggage
  if (DEBUG_AJAX) alert(xhr.responseText);

  // La r�ponse  au format json devient un objet javascript
  return JSON.parse(xhr.responseText);

} // actionForm(url, frm)


function actionFormSpecialite(url, frm, name, value)
{
  // R�cup�re la connexion au serveur http
  var xhr = new XMLHttpRequest();

  //Ouvre la connexion en mode synchrone avec le serveur http � l'adresse url
  xhr.open('POST', url, false);

  //R�cup�re les donn�es du formulaire sous la forme clef/valeur
  var data = new FormData(frm);
  
  // R�cup�re le nom d'identifiant (nombre de ligne modifi�e)
  var nb_id_employer = name['ID_SPECIALITES'].length;
  
  // Boucle sur le tableau des identifants
  for (var i = 0; i < nb_id_employer; ++i)
  {
	// Ajoute l'identifiant et sa valeur
	data.append(name['ID_SPECIALITES'][i], value['ID_SPECIALITES'][i]);	  
	
	// Teste si le nom a �t� modifi�
	if (name['NOM'][i])
	{
		// Ajoute du NOM et sa valeur
		data.append(name['NOM'][i], value['NOM'][i]);
	}
  }

  // Envoie les donn�es du formulaire
  xhr.send(data);
  
  // Debuggage
  if (DEBUG_AJAX) alert(xhr.responseText);

  // La r�ponse  au format json devient un objet javascript
  return JSON.parse(xhr.responseText);

} // actionForm2(url, frm, name, value)


function actionFormDocteur(url, frm, name, value)
{
  // R�cup�re la connexion au serveur http
  var xhr = new XMLHttpRequest();

  //Ouvre la connexion en mode synchrone avec le serveur http � l'adresse url
  xhr.open('POST', url, false);

  //R�cup�re les donn�es du formulaire sous la forme clef/valeur
  var data = new FormData(frm);
  
  // R�cup�re le nom d'identifiant (nombre de ligne modifi�e)
  var nb_id_employer = name['ID_DOCTEUR'].length;

  // Boucle sur le tableau des identifants
  for (var i = 0; i < nb_id_employer; ++i)
  {
	// Ajoute l'identifiant et sa valeur
	data.append(name['ID_DOCTEUR'][i], value['ID_DOCTEUR'][i]);	  
	
	// Teste si le nom a �t� modifi�
	if (name['NOM'][i])
	{
		// Ajoute du NOM et sa valeur
		data.append(name['NOM'][i], value['NOM'][i]);
	}
	
	// Teste si le pr�nom a �t� modifi�
	if (name['PRENOM'][i])
	{
		// Ajoute du PRENOM et sa valeur
		data.append(name['PRENOM'][i], value['PRENOM'][i]);
	}
  }

  // Envoie les donn�es du formulaire
  xhr.send(data);
  
  // Debuggage
  if (DEBUG_AJAX) alert(xhr.responseText);

  // La r�ponse  au format json devient un objet javascript
  return JSON.parse(xhr.responseText);

} // actionFormDocteur(url, frm, name, value)


 function actionFormAsv(url, frm, name, value)
{
  // R�cup�re la connexion au serveur http
  var xhr = new XMLHttpRequest();

  //Ouvre la connexion en mode synchrone avec le serveur http � l'adresse url
  xhr.open('POST', url, false);

  //R�cup�re les donn�es du formulaire sous la forme clef/valeur
  var data = new FormData(frm);
  
  // R�cup�re le nom d'identifiant (nombre de ligne modifi�e)
  var nb_id_employer = name['ID_ASV'].length;

  // Boucle sur le tableau des identifants
  for (var i = 0; i < nb_id_employer; ++i)
  {
	// Ajoute l'identifiant et sa valeur
	data.append(name['ID_ASV'][i], value['ID_ASV'][i]);	  
	
	// Teste si le nom a �t� modifi�
	if (name['NOM'][i])
	{
		// Ajoute du NOM et sa valeur
		data.append(name['NOM'][i], value['NOM'][i]);
	}
	
	// Teste si le pr�nom a �t� modifi�
	if (name['PRENOM'][i])
	{
		// Ajoute du PRENOM et sa valeur
		data.append(name['PRENOM'][i], value['PRENOM'][i]);
	}
  }

  // Envoie les donn�es du formulaire
  xhr.send(data);
  
  // Debuggage
  if (DEBUG_AJAX) alert(xhr.responseText);

  // La r�ponse  au format json devient un objet javascript
  return JSON.parse(xhr.responseText);

} // actionFormDocteur(url, frm, name, value)











