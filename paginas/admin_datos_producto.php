<?php
	// Librerías
	require_once '../librerias/Html.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	require_once '../html/formulariosMuebleBBB.php';
	require_once '../html/cabecera.php';
	require_once '../html/encabezado.php';
	require_once '../html/nav.php';
	require_once '../html/pie.php';
	require_once '../html/sesion_carrito.php';
	
	//Inicializo la BBDD de MuebleBBB, cargo el catálogo y lo recojo en una variable.
	if (empty($_POST)) {
		$BBDD = new MySQLDataBase("mueblebbb");
		$MuebleBBB = new BBDDMuebleBBB($BBDD);
		$MuebleBBB->cargarCatalogo();
		$catalogo = $MuebleBBB->getCatalogo();
	}
	
	/****************************************************
	 GENERO EL HTML DE LA PÁGINA ADMIN_DATOS_PRODUCTO.PHP
	 ****************************************************/	
	echo cabecera("MUEBLEBBB - Administración", "../css/estilos.css", "../js/libreriaAdmin.js");
	echo encabezadoAdmin();
	echo navAdmin();
	echo sesion_carritoAdmin();

	// Si $_POST no está vacío es que se ha realizado una solicitud de 'Añadir producto' o 'Modificar producto' en admin.php
	if (!empty($_POST)) {
		
		echo Html::seccion(1,"Cambios realizados:");
		$BBDD = new MySQLDataBase("mueblebbb");
		$MuebleBBB = new BBDDMuebleBBB($BBDD);
		if (!empty($_POST))
			$MuebleBBB->actualizarProductos($_REQUEST, $_FILES);
		echo Html::a_("../paginas/admin.php", "enlace_volver").Html::span("<< ").Html::span("Volver a Administración", "estilo").Html::_a();
		
		// TESTEO *****************************************///*
		echo Html::details_().                              //*
			Html::summary("Detalles productos:");           //*
				$MuebleBBB->cargarCatalogo();               //*
				$catalogo = $MuebleBBB->getCatalogo();      //*
				$productos = $catalogo->getProductos();     //*
				var_dump($productos);                       //*
															//*
		echo Html::_details();								//*
		// FIN TESTEO *************************************///*
	} 
	
	// En caso de estar vacío el '$_POST', se comprueba si se debe generar un formulario de tipo 'Nuevo producto' o 'Buscar producto'
	else if (isset($_GET["nuevo_producto"])) { // Si existe este campo, es que se ha creado un nuevo producto.		
		$MuebleBBB->cargarCategorias();
		$categorias = $MuebleBBB->getCategorias();
		contenedorDatosNuevoProducto($_GET, $categorias);
	}
	
	// Compruebo si el código introducido existe.
	else if ($catalogo->ExisteCod($_GET['id_modificar_producto'])) {
		$producto = $catalogo->Buscar($_GET['id_modificar_producto']); // Busco el producto en el catálogo y lo recojo.
		$MuebleBBB->cargarCategorias();
		$categorias = $MuebleBBB->getCategorias();
		contenedorDatosProductoExistente($producto, $categorias);
		
	} else { // En caso de haber introducido un código NO existente en la BBDD al buscar un producto, devuelvo este error.
		echo Html::p("El código del producto introducido NO existe.", "error");
	}
		
	/* TESTEO *****************************************///*
	echo Html::details_().  							//*
		Html::summary("Detalles POST:");				//*
			var_dump($_POST);							//*
	echo Html::_details();								//*
														//*
	echo Html::details_(). 								//*
		Html::summary("Detalles GET:");					//*
			var_dump($_GET);							//*
	echo Html::_details();								//*
														//*
	echo Html::details_().                              //*
		Html::summary("Detalles FILES:");               //*
			var_dump($_FILES);							//*
	echo Html::_details();								//*
	/* FIN TESTEO *************************************///*
	
	echo pie();
	
?>