<?php
	// Librerías
	require_once '../librerias/GestionaPlantilla.php';
	require_once '../librerias/Html.php';
	require_once '../librerias/MySQLDataBase.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	require_once '../librerias/formulariosMuebleBBB.php';
	
	//Inicializo la base de datos muebleBBB y obtengo los productos catalogados como 'novedades' y 'ofertas'
	$BBDD = new MySQLDataBase("mueblebbb");
	$MuebleBBB = new BBDDMuebleBBB($BBDD);
	$MuebleBBB->cargarCatalogo();
	$catalogo = $MuebleBBB->getCatalogo();
	
	if (!empty($_POST)) {
		$productos = $catalogo->BuscarProductos($_POST["busca"]);
	} else	$productos =[];
	
	// Plantilla HTML y su contenido:
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__Plantilla.html");

	echo Html::div_("contenedor_inicio");
		echo Html::seccion(1,"Resultado de búsqueda");
		
		if (!empty($productos)) {
			foreach ($productos as $producto) {
				if ($producto->__get("descuento")>0) {
					$precio_descuento = $producto->__get("precio") - ( $producto->__get("precio") /100 * $producto->__get("descuento") );
					echo
					Html::div_("contenedor_producto").Html::a_("catalogo.php?id_producto={$producto->__get("codigo")}").
						Html::img("{$producto->__get("imagen")}", "{$producto->__get("nombre")}").
						Html::span("{$producto->__get("descuento")}%", "oferta").
						Html::seccion(2, "{$producto->__get("nombre")}", "nombre_producto").
						Html::div_("detalles").
							Html::p("{$producto->__get("categoria")}", "categoria").
							Html::p_("$precio_descuento €", "precio").Html::br().Html::del("{$producto->__get("precio")}€", "precio_antes").Html::_p().
						Html::_div().
					Html::_a().Html::_div();
				}
				else if ($producto->__get("nuevo")) {
					echo
					Html::div_("contenedor_producto").Html::a_("catalogo.php?id_producto={$producto->__get("codigo")}").
						Html::img("{$producto->__get("imagen")}", "{$producto->__get("nombre")}").
						Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
						Html::seccion(2, "{$producto->__get("nombre")}", "nombre_producto").
						Html::div_("detalles").
							Html::p("{$producto->__get("categoria")}", "categoria").
							Html::p("{$producto->__get("precio")}€", "precio").
						Html::_div().
					Html::_div().Html::_a();
				}
				else {
					echo
					Html::div_("contenedor_producto").Html::a_("catalogo.php?id_producto={$producto->__get("codigo")}").
						Html::img("{$producto->__get("imagen")}", "{$producto->__get("nombre")}").
						Html::seccion(2, "{$producto->__get("nombre")}", "nombre_producto").
						Html::div_("detalles").
							Html::p("{$producto->__get("categoria")}", "categoria").
							Html::p("{$producto->__get("precio")}€", "precio").
						Html::_div().
					Html::_div().Html::_a();
				}
			}
		}
		else {
			echo Html::p("No se ha encontrado ninguna coincidencia.", "error");
		}		
	echo Html::_div();
	
	GestionaPLantilla::Fin_Plantilla();
?>