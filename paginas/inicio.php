<?php
	// Librerías
	require_once '../librerias/Html.php';
	require_once '../librerias/MySQLDataBase.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	require_once '../html/ofertas_novedades.php';
	
	
	//Inicializo la base de datos muebleBBB y obtengo los productos catalogados como 'novedades' y 'ofertas'
	$BBDD = new MySQLDataBase("mueblebbb");
	$MuebleBBB = new BBDDMuebleBBB($BBDD);
	$MuebleBBB->cargarCatalogo();
	$catalogo = $MuebleBBB->getCatalogo();
	$novedades = $catalogo->getNovedades();
	$ofertas = $catalogo->getOfertas();
		
	/*************************************
	 GENERO EL HTML DE LA PÁGINA INDEX.PHP
	**************************************/
	echo cabecera("MUEBLEBBB - Inicio", "../css/estilos.css", "../js/libreria.js");
	echo encabezadoIndex();
	echo navIndex();
	echo sesion_carritoIndex();
		ofertas_novedades($ofertas, $novedades);
	echo pie();
?>