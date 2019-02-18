/**
 * Fonctions utilisées pour les formulaires
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXO-MOOC
 */

// Tableau des éléments obligatoires du formulaire
var elemRequired = new Array();
// Tableau de booleens des éléments obligatoires du formulaire
var boolNoRequired = new Array();
/**
 * Vérification du formulaire 
 * Vérifie que les attributs de type NOT NULL soient renseignés
 * @param element frm élément de type formulaire
 * 
 * return boolean
 */
function verifForm(frm)
{
  // Récupère les éléments <label>
  var tabLabel = frm.getElementsByTagName('label');
  //Récupère le nombre d'éléments <label>
  var nbLabel = tabLabel.length;

  // Boucle sur les éléments <label>
  for (var i = 0, k = 0, message = new Array(), errors = 0; i < nbLabel; ++i)
  {
    // Récupère, dans l'élément <label> d'indice i, le contenu de l'attribut for 
    // correspondant au id de l'élément associé au label (input, select, ...)
    var atFor = tabLabel[i].getAttribute('for');

    // Teste si l'attribut for existe
    if (atFor)
    {
      // Récupère l'élément associé au label ayant pour id la valeur de l'attribut for
      var elemById = document.getElementById(atFor);
 
      // Récupére la valeur de la classe associée à l'id
      var atClass = elemById.getAttribute('class');
      
      // Teste si l'attribut class existe
      if (atClass)
      {
      	// Expression régulière permettant de rechercher le mot required
      	var pattern = /(required)/;
     	// Si la class est required
    	if (pattern.test(atClass))
    	{
          // Eléments du formulaire    	
          elemRequired[k] = elemById;
          // Eléments non requis (initialisation par défaut)
          boolNoRequired[k] = false;
          
          //  Si l'élément est vide alors erreur
    	  if (!elemById.value)
    	  {
    	    // Eléments requis
    		boolNoRequired[k] = true;
    	    // Message d'erreurs en récupérant le texte du label
            message[errors] = '- ' + tabLabel[i].innerHTML;
            // Incrémentation du compteur d'erreurs
    	    ++errors;
    	  }
      	  
      	  // Incrémentation des éléments du formulaire
      	  ++k;
    	}
      }
    }
  }
  
  // Si error est différent de 0 alors alert
  if (errors)
  {
	// Crée un élément paragraphe <p>
    var p = document.createElement('p');
    // Ajoute à l'élément paragraphe <p> le début du message suivant si une ou plusieurs erreurs
    p.innerHTML = (errors > 1) ? 'Vous devez renseigner les champs suivants :' : 'Vous devez renseigner le champ suivant :';
  
    // Récupère l'élément <div id="error">
    var div_error = document.getElementById('error');
    // Ajoute à l'élément <div id="error"> l'élément paragraphe <p>
    div_error.appendChild(p);
    
    // Boucle sur le nombre d'erreurs
    for (var i = 0; i < errors; ++i)
    {
      // Crée un élément paragraphe <p>
      var p = document.createElement('p');
      // Insère dans l'élément paragraphe <p> son message
      p.innerHTML = message[i];
      // Ajoute un attribut class="label"
      p.setAttribute('class', 'label');
      // Ajoute à l'élément <div id="error"> l'élément paragraphe <p>
      div_error.appendChild(p);
    }
    
	// Crée un élément paragraphe <button>
    var button = document.createElement('button');
    // Ajoute à l'élément paragraphe <button> la valeur Ok
    button.innerHTML = 'Ok';
    // Ajoute un attribut événement intrinsèque onclick
    button.setAttribute('onclick', 'closeDivError()');

    // Crée un élément paragraphe <p>
    var p = document.createElement('p');
    // Ajoute un attribut class="center"
    p.setAttribute('class', 'center');
    // Ajoute à l'élément <p> l'élément <button>
    p.appendChild(button);
  
    // Ajoute à l'élément <div id="error"> l'élément paragraphe <p>
    div_error.appendChild(p);
    
    // Visualise l'élément <div id="error">
    div_error.style.display = 'block';
    
    // Récupère la largeur de l'élément <div id="error">
    var div_error_width = div_error.offsetWidth;
    // Récupère la hauteur de l'élément <div id="error">
    var div_error_height = div_error.offsetHeight;
     
    // Déplace l'élément <div id="error"> vers la gauche de la moitié de sa largeur
    div_error.style.marginLeft = '-' + Math.round(div_error_width/2) + 'px';
    // Déplace l'élément <div id="error"> vers le haut de la moitié de sa hauteur
    div_error.style.marginTop = '-' + Math.round(div_error_height/2) + 'px';  

    return false;
  }

  return true;

} // verifForm(frm)

/**
 * Fermeture de la fenêtre d'erreurs 
 * 
 * @return none
 */
function closeDivError()
{
  // Récupère l'élément <div id="error">
  var div_error = document.getElementById('error');
  // Efface le contenu de l'élément <div id="error">
  div_error.innerHTML = '';
  
  // Rends non visible l'élément <div id="error">
  div_error.style.display = 'none';
  
  // Nombre d'éléments du formulaire
  var nbElem = elemRequired.length;
  
  // Boucle sur les éléments du formulaire  
  for (var i = 0; i < nbElem; ++i)
  {
	// Récupération de la valeur de l'attribut class
	var classRequired = elemRequired[i].getAttribute('class');
	// Suppression du mot norequired (remise à zéro)
	classRequired = classRequired.replace(' norequired', '');

	// Test si l'élément est obligatoire et non renseigné
	if (boolNoRequired[i])
	{
	  // Ajout du mot norequired
      classRequired += ' norequired';
	}
	
	// Remplacement du contenu de la class par son nouveau contenu
    elemRequired[i].setAttribute('class', classRequired);
  }
  
  return;
  
} // closeDivError()

/**
 * Convertion d'un événement clavier en chaîne de caractères
 * @param event événement du clavier
 * 
 * @return string le caractère frappé
 */
function key2Char(event)
{
  // Boucle sur les propriétés des événements
  for (var prop in event)
  {
    // Test si l'événement a la propriété charCode, keycode ou which
    switch (prop) 
	{
	  case 'charCode' : return String.fromCharCode(event.charCode);
	  case 'keyCode'  : return String.fromCharCode(event.keyCode);
	  case 'which'    : return String.fromCharCode(event.which);
	}
  }
  
} // key2Char(event)

/**
 * Vérifie que les entrées clavier sont de type entier positif
 * @param event événement du clavier
 *
 * @return boolean true ou false
 */
function isInteger(event)
{
  // Expression régulière pour les entiers 
  var valid = /[0-9]/;
  // Expression régulière pour les caractères spéciaux 
  var speciaux = /[\x00\x0D]/;
	  
  // Récupération du caractère frappé
  var car = key2Char(event);
	  
  // Vérifie si le caractère frappé est un entier ou un caractère spécial
  if ((valid.test(car) || speciaux.test(car)))
  {	
    return true;
  }
  
  // Stoppe l'événement
  stopEvent(event);

  return false;

} // isInteger(event)


function insertData(event)
{
  // Récupère l'élément <form>
  var frm = event.target || event.srcElement;

  // Vérifie le formulaire
  if (!verifForm(frm))
  {
    // Stoppe l'événement
    stopEvent(event);
    
    return false;
  }
} // insertData(event)
