<?php
	// Librer�as
	require_once '../librerias/Html.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	
	/****************************************
	 GENERO EL HTML DE LA P�GINA CONTACTO.PHP
	 ****************************************/
	echo cabecera("MUEBLEBBB - Contacto", "../css/estilos.css", "../js/libreria.js");
	echo encabezadoIndex();
	echo navIndex();
	echo sesion_carritoIndex();
	echo Html::p("Aqu� va el cuerpo de la p�gina");
	echo pie();
?>