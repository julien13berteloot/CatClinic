/**
 * Fichier Javascript d'initialisation des �couteurs
 * @author Christian Bonhomme
 * @version 1.0
 * @package EXERCICE-MOOC
 */

/**
 * Fonction g�n�rique de d�clenchement des listeners
 * @param HTMLElement �l�ment � �couter
 * @param array tableau des objets de type �v�nement
 * @param function fonction d�clench�e par l'�couteur
 *
 * @return none
 */
function Listener(elem ,event, fnct) 
{
  // Teste si l'�l�ment existe
  if (elem)
  {
    // Associe � l'�v�nement click la fonction (Non IE)
    elem.addEventListener(event , fnct, false);
		
    // Si l'�v�nement est un click on change le curseur de souris
    if ('click' == event) 
    { 
      elem.style.cursor = 'pointer';
    }
  }
  
  return;
    
} // Listener(elem ,event, fnct)

/**
 * Fonction d'arr�t de la propagation d'un �v�nement dans la phase de bouillonnement
 * @param event �v�nement
 *
 * return none;
 */
function stopEvent(event)
{
  // Stoppe la propagation de l'�v�nement (pas de bouillonnement)
  event.stopPropagation();
  // Remet l'�v�nement � false
  event.preventDefault();
   
  return;

} // stopEvent(event)

/**
 * Fonction g�n�rique de supppression des listeners
 * @param HTMLElement �l�ment � ne plus �couter
 * @param array tableau des objets de type �v�nement
 * @param function fonction d�clench�e par l'�couteur
 *
 * @return none
 */
function Remove(elem, event, fnct) 
{
  if (elem)
  {
    // Associe � l'�v�nement click la fonction (Non IE)
    elem.removeEventListener(event, fnct, false);
 		
    // Si l'�v�nement est un click on change le curseur de souris
    if ('click' == event) 
    { 
      elem.style.cursor = 'default';
    }
  }
  
  return;
    
} // Remove(elem, event, fnct)

/************************************************/
/* Initialistion des �couteurs de l'application */
/* au chargement des pages                      */
/************************************************/

// R�cup�re l'�l�ment <p id="contacts">
var click_spe = document.querySelector('#specialites');
// Pour l'�l�ment <p id="contacts">
// on associe un �v�nement click
// avec comme fonction associ�e une fonction anonyme
// d�clenchant la fonction changeContent
Listener(click_spe, 'click', function(){changeContent('content', '../Php/index.php', 'EX=formulaire_specialite', 'initFormSpe()')});

