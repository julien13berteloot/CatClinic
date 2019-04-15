/**
 * Fichier Javascript d'initialisation des écouteurs
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXERCICE-MOOC
 */

/**
 * Fonction générique de déclenchement des listeners
 * @param HTMLElement élément à écouter
 * @param array tableau des objets de type événement
 * @param function fonction déclenchée par l'écouteur
 *
 * @return none
 */
function Listener(elem ,event, fnct) 
{
  // Teste si l'élément existe
  if (elem)
  {
    // Associe à  l'événement click la fonction (Non IE)
    elem.addEventListener(event , fnct, false);
		
    // Si l'événement est un click on change le curseur de souris
    if ('click' == event) 
    { 
      elem.style.cursor = 'pointer';
    }
  }
  
  return;
    
} // Listener(elem ,event, fnct)

/**
 * Fonction d'arrêt de la propagation d'un événement dans la phase de bouillonnement
 * @param event événement
 *
 * return none;
 */
function stopEvent(event)
{
  // Stoppe la propagation de l'événement (pas de bouillonnement)
  event.stopPropagation();
  // Remet l'événement à false
  event.preventDefault();
   
  return;

} // stopEvent(event)

/**
 * Fonction générique de supppression des listeners
 * @param HTMLElement élément à ne plus écouter
 * @param array tableau des objets de type événement
 * @param function fonction déclenchée par l'écouteur
 *
 * @return none
 */
function Remove(elem, event, fnct) 
{
  if (elem)
  {
    // Associe à  l'événement click la fonction (Non IE)
    elem.removeEventListener(event, fnct, false);
 		
    // Si l'événement est un click on change le curseur de souris
    if ('click' == event) 
    { 
      elem.style.cursor = 'default';
    }
  }
  
  return;
    
} // Remove(elem, event, fnct)

/************************************************/
/* Initialistion des écouteurs de l'application */
/* au chargement des pages                      */
/************************************************/


var click_spe = document.querySelector('#specialites');

Listener(click_spe, 'click', function(){changeContent('id_sticky_content', '../Php/index.php', 'EX=formulaire_specialite', 'initFormSpe()')});


var click_doc = document.querySelector('#docteur');

Listener(click_doc, 'click', function(){changeContent('id_sticky_content', '../Php/index.php', 'EX=formulaire_docteur', 'initFormDocteur()')});


var click_asv = document.querySelector('#asv');

Listener(click_asv, 'click', function(){changeContent('id_sticky_content', '../Php/index.php', 'EX=formulaire_asv', 'initFormAsv()')});


var click_docteur = document.getElementById('lienboxdocteur');
Listener(click_docteur, 'click', boxDocteur);
var click_box_docteur = document.getElementById('boxdocteur');
Listener(click_box_docteur, 'click', boxDocteur)


var click_ass = document.getElementById('lienboxasv');
Listener(click_ass, 'click', boxAsv);
var click_box_ass = document.getElementById('boxasv');
Listener(click_box_ass, 'click', boxAsv)

