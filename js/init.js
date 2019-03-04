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

// Récupère l'élément <p id="contacts">
var click_spe = document.querySelector('#specialites');
// Pour l'élément <p id="contacts">
// on associe un événement click
// avec comme fonction associée une fonction anonyme
// déclenchant la fonction changeContent
Listener(click_spe, 'click', function(){changeContent('content', '../Php/index.php', 'EX=formulaire_specialite', 'initFormSpe()')});

