<?php
	// Librerías
	require_once '../librerias/GestionaPlantilla.php';
	require_once '../librerias/Html.php';
	
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__Plantilla.html");

	//Contenido HTML construído a través de métodos estáticos de la clase Html (Ver documentación en caso de duda).
	echo		
		Html::p("Aquí va el cuerpo de la página");

	
	GestionaPLantilla::Fin_Plantilla();
?>