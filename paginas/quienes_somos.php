<?php
	// Librerías
	require_once '../librerias/Html.php';
	require_once '../librerias/navegacion_sesion.php';
	require_once '../librerias/MySQLDataBase.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	
	// Inicio sesión
	session_start();
	//Inicializo la base de datos muebleBBB
	$BBDD = new MySQLDataBase("mueblebbb");
	$MuebleBBB = new BBDDMuebleBBB($BBDD);
	
	/****************************************
	 GENERO EL HTML DE LA PÁGINA QUIENES_SOMOS.PHP
	 ****************************************/
	echo cabecera("MUEBLEBBB - Quienes somos", "../css/estilos.css", "../js/libreria.js");
	echo encabezadoIndex();
	
	navegacion_sesion($_POST, $MuebleBBB);
	
	echo Html::p("Aquí va el cuerpo de la página");
	echo pie();
?>