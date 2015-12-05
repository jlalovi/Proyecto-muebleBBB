<?php
/**
 * Página de inicio de muebleBBB
 * @param array $ofertas -> Array de Productos en oferta
 * @param array $novedades -> Array de Productos novedad
 */
function ofertas_novedades($ofertas, $novedades){
	echo Html::div_("contenedor_inicio");
		// Columna izquierda "Ofertas"
		echo Html::div_("ofertas columnas_inicio left").
			Html::seccion(1,"Ofertas");
			foreach ($ofertas as $oferta) {
				$precio_descuento = $oferta->__get("precio") - ( $oferta->__get("precio") /100 * $oferta->__get("descuento") );
				echo
					Html::div_("contenedor_producto").Html::a_("catalogo.php?id_producto={$oferta->__get("codigo")}").
						Html::img("{$oferta->__get("imagen")}", "{$oferta->__get("nombre")}").
						Html::span("{$oferta->__get("descuento")}%", "oferta").
						Html::seccion(2, "{$oferta->__get("nombre")}", "nombre_producto").
						Html::div_("detalles").
							Html::p("{$oferta->__get("categoria")}", "categoria").
							Html::p_("$precio_descuento €", "precio").Html::br().Html::del("{$oferta->__get("precio")}€", "precio_antes").Html::_p().
						Html::_div().
					Html::_a().Html::_div();
			}				
		echo Html::_div(); // Fin columna izquierda "Ofertas"
			
		// Columna derecha "Novedades"
		echo Html::div_("novedades columnas_inicio right").
		Html::seccion(1,"Novedades");
			foreach ($novedades as $novedad) {
				echo
					Html::div_("contenedor_producto").Html::a_("catalogo.php?id_producto={$novedad->__get("codigo")}").
						Html::img("{$novedad->__get("imagen")}", "{$novedad->__get("nombre")}").
						Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
						Html::seccion(2, "{$novedad->__get("nombre")}", "nombre_producto").
						Html::div_("detalles").
							Html::p("{$novedad->__get("categoria")}", "categoria").
							Html::p("{$novedad->__get("precio")}€", "precio").
						Html::_div().
					Html::_div().Html::_a();
			}				
		echo Html::_div();
	echo Html::_div();
}
?>