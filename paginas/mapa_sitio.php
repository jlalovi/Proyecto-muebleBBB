<?php
	// Librerías
	require_once '../librerias/Html.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	
	/******************************************
	 GENERO EL HTML DE LA PÁGINA MAPA_SITIO.PHP
	 ******************************************/
	echo cabecera("MUEBLEBBB - Mapa del sitio", "../css/estilos.css", "../js/libreria.js");
	echo encabezadoIndex();
	echo navIndex();
	echo sesion_carritoIndex();
	echo Html::p("Aquí va el cuerpo de la página");
	echo pie();
?>