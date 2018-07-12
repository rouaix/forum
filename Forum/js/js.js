function setFocusSaisie(){
    document.getElementById("lemessage").focus();
}

function toggleEditeur()
{
	node = document.getElementById("editeur");
	if (node.style.visibility=="hidden")
	{
		// Contenu caché, le montrer
		node.style.visibility = "visible";
		node.style.height = "100%";			// Optionnel rétablir la hauteur
	}
	else
	{
		// Contenu visible, le cacher
		node.style.visibility = "hidden";
		node.style.height = "0";			// Optionnel libérer l'espace
	}
}