<?php
	// Librer�as
	require_once '../librerias/Html.php';
	require_once '../librerias/MySQLDataBase.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	require_once '../html/formulariosMuebleBBB.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	
	// Inicio sesi�n
	session_start();
	// Compruebo que se est� accediente a la p�gina con los privilegios adecuados
	if (!isset($_SESSION["admin"]) || $_SESSION["admin"]==false) {
		header("location:inicio.php");
	}
	
	//Inicializo la base de datos muebleBBB
	$BBDD = new MySQLDataBase("mueblebbb");
	$MuebleBBB = new BBDDMuebleBBB($BBDD);
		
	//Busco en la BBDD el valor m�ximo del c�digo de todos los productos y lo almaceno en '$codmax'
	$max_producto= $BBDD->Consultar("productos", "max(id_producto)")[0][0] + 1; // Las consultas me devuelven una matriz, de ah� que indico la posici�n [0][0]. Le sumo 1 para que sea el siguiente c�digo.
	$max_categoria= $BBDD->Consultar("categorias", "max(id_categoria)")[0][0] + 1;
	
	$mensaje_newCat="";
	if (isset($_POST["nueva_categoria"])) {
		if ($MuebleBBB->actualizarCategorias($_REQUEST)) {
			$mensaje_newCat="�OK!";
			$max_categoria=$max_categoria+1;
		}
		else {
			$mensaje_newCat="�Error!";
		}
	}
	$mensaje_modCat="";
	if (isset($_POST["nuevo_nombre_categoria"])) {
		if ($MuebleBBB->actualizarCategorias($_REQUEST)) {
			$mensaje_modCat="�OK!";
		}
		else {
			$mensaje_modCat="�Error!";
		}
	}
	if (isset($_POST["borrar"])) {
		if ($MuebleBBB->actualizarCategorias($_REQUEST)) {
			$mensaje_modCat="�Borrado!";
		}
		else {
			$mensaje_modCat="�Productos en categor�a!";
		}
	}
	
	/*************************************
	 GENERO EL HTML DE LA P�GINA ADMIN.PHP
	**************************************/
	echo cabecera("MUEBLEBBB - Administraci�n", "../css/estilos.css", "../js/libreriaAdmin.js");
	echo encabezadoAdmin();
	echo navAdmin();
	echo sesion_carritoAdmin($_SESSION);
		echo Html::div_("formularios_producto");
			contenedorNuevoProducto($max_producto);
			$MuebleBBB->cargarCatalogo();
			$catalogo = $MuebleBBB->getCatalogo();
			contenedorModificarProducto($catalogo);
		echo Html::_div();
		
		echo Html::div_("formularios_categoria");
			$MuebleBBB->cargarCategorias();
			$categorias = $MuebleBBB->getCategorias();
			contenedorNuevaCategoria($max_categoria, $mensaje_newCat);
			contenedorModificarCategoria($categorias, $mensaje_modCat);
		echo Html::_div();
	echo pie();
	
?>