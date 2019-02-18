// Récupère l'élément <form id="peintre">
var form_peintre = document.getElementById('peintre');
//Teste si l'élément form_peintre existe
if (form_peintre)
{  
  // Teste si la méthode addEventListener existe (Non IE)
  if (form_peintre.addEventListener)
  {
    // Associe à l'événement submit la fonction saveForm (Non IE)
    form_peintre.addEventListener('submit', insertData, false);
  } 
  else
  {
    // Associe à l'événement onsubmit la fonction saveForm (IE)
    form_peintre.attachEvent('onsubmit', insertData);
  }
}

function stopEvent(event)
{
  // Teste si la méthode stopPropagation existe (Non IE)
  if (event.stopPropagation)
  {
    // Stoppe la propagation de l'événement (pas de bouillonnement)
    event.stopPropagation();
    // Remet l'événement à false
    event.preventDefault();
  }
  else
  {
    // Stoppe la propagation de l'événement (pas de bouillonnement)
    event.cancelBubble = true;
    // Remet l'événement à false
    event.returnValue = false;
  }
  
  return;

} // stopEvent(event)