<?php
	// Librer�as
	require_once '../librerias/GestionaPlantilla.php';
	require_once '../librerias/Html.php';
	
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__Plantilla.html");

	//Contenido HTML constru�do a trav�s de m�todos est�ticos de la clase Html (Ver documentaci�n en caso de duda).
	echo		
		Html::p("Aqu� va el cuerpo de la p�gina");

	
	GestionaPLantilla::Fin_Plantilla();
?>