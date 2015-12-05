<?php
	// Librerías
	require_once '../librerias/Html.php';
	require_once '../librerias/MySQLDataBase.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	require_once '../html/formulariosMuebleBBB.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	
	//Inicializo la base de datos muebleBBB
	$BBDD = new MySQLDataBase("mueblebbb");
	$MuebleBBB = new BBDDMuebleBBB($BBDD);
		
	//Busco en la BBDD el valor máximo del código de todos los productos y lo almaceno en '$codmax'
	$max_producto= $BBDD->Consultar("productos", "max(id_producto)")[0][0] + 1; // Las consultas me devuelven una matriz, de ahí que indico la posición [0][0]. Le sumo 1 para que sea el siguiente código.
	$max_categoria= $BBDD->Consultar("categorias", "max(id_categoria)")[0][0] + 1;
	
	$mensaje_newCat="";
	if (isset($_POST["nueva_categoria"])) {
		if ($MuebleBBB->actualizarCategorias($_REQUEST)) {
			$mensaje_newCat="¡OK!";
			$max_categoria=$max_categoria+1;
		}
		else {
			$mensaje_newCat="¡Error!";
		}
	}
	$mensaje_modCat="";
	if (isset($_POST["nuevo_nombre_categoria"])) {
		if ($MuebleBBB->actualizarCategorias($_REQUEST)) {
			$mensaje_modCat="¡OK!";
		}
		else {
			$mensaje_modCat="¡Error!";
		}
	}
	if (isset($_POST["borrar"])) {
		if ($MuebleBBB->actualizarCategorias($_REQUEST)) {
			$mensaje_modCat="¡Borrado!";
		}
		else {
			$mensaje_modCat="¡Productos en categoría!";
		}
	}
	
	/*************************************
	 GENERO EL HTML DE LA PÁGINA ADMIN.PHP
	**************************************/
	echo cabecera("MUEBLEBBB - Administración", "../css/estilos.css", "../js/libreriaAdmin.js");
	echo encabezadoAdmin();
	echo navAdmin();
	echo sesion_carritoAdmin();
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