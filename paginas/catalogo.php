<?php
	// Librer�as
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
	$productos = $catalogo->getProductos();
	$novedades = $catalogo->getNovedades();
	$ofertas = $catalogo->getOfertas();
	
	// Compruebo si existe la variable $_GET y en caso afirmativo almaceno su valor (que ser� un id_producto)
	if (!empty($_GET)) {
		$codigo = $_GET["id_producto"];
	} else	$codigo ="";
	
	// Plantilla HTML y su contenido:
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__Plantilla.html");
	echo Html::div_("contenedor_catalogo");
	
		//$size = $catalogo->getSize(); // Para definir la altura del 'select'
		echo Html::select_("id_modificar_producto", "", "seleccionar_producto", "required='required' size='20'");			
			foreach ($productos as $categoria=>$id_producto) {
				echo Html::optgroup_("$categoria");
				foreach ($id_producto as $producto) {
					if ($codigo==$producto->__get("codigo")) {
						echo Html::option("{$producto->__get("codigo")}", "{$producto->__get("nombre")}", true);					
					}
					else
						echo Html::option("{$producto->__get("codigo")}", "{$producto->__get("nombre")}");
				}
				echo Html::_optgroup();
			}
		echo Html::_select();
		
		foreach ($productos as $categoria=>$id_producto) {
			foreach ($id_producto as $producto) {
				echo
				Html::div_("contendor_producto_detallado invisible", "id_{$producto->__get("codigo")}").
					Html::seccion(1, "{$producto->__get("nombre")}", "nombre_producto").
					Html::div_("imagen").
						Html::img("{$producto->__get("imagen")}", "alt");
						echo Html::div_("especial");
							if ($producto->__get("descuento")!="0") {
								echo Html::span("{$producto->__get("descuento")}%", "oferta");
							}
							else if ($producto->__get("nuevo")) {
								echo Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo");
							}
						echo Html::_div().
					Html::_div().
					Html::div_("clear").Html::_div().
					Html::div_("detalles").
						Html::seccion(2, "Precio:");					
						if ($producto->__get("descuento")!="0") {
							$precio_descuento = $producto->__get("precio") - ( $producto->__get("precio") /100 * $producto->__get("descuento") );
							echo Html::p("$precio_descuento �").Html::span("{$producto->__get("precio")} �", "precio_antes");
						}
						else {
							echo Html::p("{$producto->__get("precio")} �");
						}
						echo
						Html::seccion(2, "Categor�a:").
						Html::p("{$producto->__get("categoria")}").
						Html::seccion(2, "Caracter�sticas:").
						Html::p("{$producto->__get("caracteristicas")}", "caracteristicas").
					Html::_div().
				Html::_div();
			}
		}

	echo Html::_div();
	GestionaPLantilla::Fin_Plantilla();
?>