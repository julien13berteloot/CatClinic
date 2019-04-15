
var elemRequired = new Array();
var boolNoRequired = new Array();

function verifForm(frm)
{
  var tabLabel = frm.getElementsByTagName('label');
  var nbLabel = tabLabel.length;

  for (var i = 0, k = 0, message = new Array(), errors = 0; i < nbLabel; ++i)
  {
    var atFor = tabLabel[i].getAttribute('for');

    if (atFor)
    {
      var elemById = document.getElementById(atFor);

      var atClass = elemById.getAttribute('class');

      if (atClass)
      {
      	var pattern = /(required)/;
    	if (pattern.test(atClass))
    	{   	
          elemRequired[k] = elemById;

          boolNoRequired[k] = false;

    	  if (!elemById.value)
    	  {
    		boolNoRequired[k] = true;
            message[errors] = '- ' + tabLabel[i].innerHTML;
    	    ++errors;
    	  }

      	  ++k;
    	}
      }
    }
  }
  
  if (errors)
  {
    var p = document.createElement('p');

    p.innerHTML = (errors > 1) ? 'Vous devez renseigner les champs suivants :' : 'Vous devez renseigner le champ suivant :';

    var div_error = document.getElementById('error');

    div_error.appendChild(p);

    for (var i = 0; i < errors; ++i)
    {
      var p = document.createElement('p');

      p.innerHTML = message[i];

      p.setAttribute('class', 'monlabel');

      div_error.appendChild(p);
    }
    

    var button = document.createElement('button');

    button.innerHTML = 'Ok';

    button.setAttribute('onclick', 'closeDivError()');

    var p = document.createElement('p');

    p.setAttribute('class', 'center');

    p.appendChild(button);

    div_error.appendChild(p);

    div_error.style.display = 'block';

    var div_error_width = div_error.offsetWidth;

    var div_error_height = div_error.offsetHeight;

    div_error.style.marginLeft = '-' + Math.round(div_error_width/2) + 'px';

    div_error.style.marginTop = '-' + Math.round(div_error_height/2) + 'px';  

    return false;
  }

  return true;

} // verifForm(frm)


function closeDivError()
{
  var div_error = document.getElementById('error');

  div_error.innerHTML = '';

  div_error.style.display = 'none';

  var nbElem = elemRequired.length;
 
  for (var i = 0; i < nbElem; ++i)
  {
	var classRequired = elemRequired[i].getAttribute('class');

	classRequired = classRequired.replace(' norequired', '');

	if (boolNoRequired[i])
	{
      classRequired += ' norequired';
	}

    elemRequired[i].setAttribute('class', classRequired);
  }
  
  return;
  
} // closeDivError()
