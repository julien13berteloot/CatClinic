
function insertData(event)
{
	var frm = event.target || event.srcElement;

	if (!verifForm(frm))
	{
		stopEvent(event);    
		return false;
	}
} // insertData(event)





