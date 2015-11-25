<?php
	// Librerías
	require_once '../librerias/GestionaPlantilla.php';
	require_once '../librerias/Html.php';
	
	
	
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__Plantilla.html");

	//Contenido HTML construído a través de métodos estáticos de la clase Html (Ver documentación en caso de duda).
	echo
		// Columna izquierda "Ofertas"
		Html::div_("ofertas columnas_inicio left").
			// Aquí habrá un foreach comprobando las ofertas disponibles para mostrarlas. TODO
			Html::seccion(1,"Ofertas").
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
				Html::img("../imagenes/_ID1-armario.jpg", "armario muy chulo").
				Html::span("25%", "oferta").
				Html::seccion(2, "Armario muy chulo", "nombre_producto").
				Html::div_("detalles").
					Html::p("Dormitorio", "categoria").
					Html::p_('1112€', "precio").Html::br().Html::del("1488€", "precio_antes").Html::_p().
				Html::_div().
			Html::_div().Html::_a("#").
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
				Html::img("../imagenes/_ID2-tumbona.jpg", "tumbona con estilo").
				Html::span("24%", "oferta").
				Html::seccion(2, "Tumbona con estilo", "nombre_producto").
				Html::div_("detalles").
					Html::p("Exterior", "categoria").
					Html::p_('110€', "precio").Html::br().Html::del("144€", "precio_antes").Html::_p().
				Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
				Html::img("../imagenes/_ID3-mesa.jpg", "mesa blanca").
				Html::span("23%", "oferta").
				Html::seccion(2, "Mesa blanca", "nombre_producto").
				Html::div_("detalles").
					Html::p("Salón", "categoria").
					Html::p_('809€', "precio").Html::br().Html::del("1056€", "precio_antes").Html::_p().
				Html::_div().
			Html::_div().Html::_a().
			
			
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID1-armario.jpg", "armario muy chulo").
			Html::span("25%", "oferta").
			Html::seccion(2, "Armario muy chulo", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p_('1112€', "precio").Html::br().Html::del("1488€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID2-tumbona.jpg", "tumbona con estilo").
			Html::span("24%", "oferta").
			Html::seccion(2, "Tumbona con estilo", "nombre_producto").
			Html::div_("detalles").
			Html::p("Exterior", "categoria").
			Html::p_('110€', "precio").Html::br().Html::del("144€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID3-mesa.jpg", "mesa blanca").
			Html::span("23%", "oferta").
			Html::seccion(2, "Mesa blanca", "nombre_producto").
			Html::div_("detalles").
			Html::p("Salón", "categoria").
			Html::p_('809€', "precio").Html::br().Html::del("1056€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID1-armario.jpg", "armario muy chulo").
			Html::span("25%", "oferta").
			Html::seccion(2, "Armario muy chulo", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p_('1112€', "precio").Html::br().Html::del("1488€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID2-tumbona.jpg", "tumbona con estilo").
			Html::span("24%", "oferta").
			Html::seccion(2, "Tumbona con estilo", "nombre_producto").
			Html::div_("detalles").
			Html::p("Exterior", "categoria").
			Html::p_('110€', "precio").Html::br().Html::del("144€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID3-mesa.jpg", "mesa blanca").
			Html::span("23%", "oferta").
			Html::seccion(2, "Mesa blanca", "nombre_producto").
			Html::div_("detalles").
			Html::p("Salón", "categoria").
			Html::p_('809€', "precio").Html::br().Html::del("1056€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID1-armario.jpg", "armario muy chulo").
			Html::span("25%", "oferta").
			Html::seccion(2, "Armario muy chulo", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p_('1112€', "precio").Html::br().Html::del("1488€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID2-tumbona.jpg", "tumbona con estilo").
			Html::span("24%", "oferta").
			Html::seccion(2, "Tumbona con estilo", "nombre_producto").
			Html::div_("detalles").
			Html::p("Exterior", "categoria").
			Html::p_('110€', "precio").Html::br().Html::del("144€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID3-mesa.jpg", "mesa blanca").
			Html::span("23%", "oferta").
			Html::seccion(2, "Mesa blanca", "nombre_producto").
			Html::div_("detalles").
			Html::p("Salón", "categoria").
			Html::p_('809€', "precio").Html::br().Html::del("1056€", "precio_antes").Html::_p().
			Html::_div().
			Html::_div().Html::_a().
			
		Html::_div().
		
		// Columna derecha "Novedades"
		Html::div_("novedades columnas_inicio right").
			// Aquí habrá un foreach comprobando las novedades disponibles para mostrarlas. TODO
			Html::seccion(1,"Novedades").
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
				Html::img("../imagenes/_ID4-mesa_comedor.jpg", "Mesa comedor vintage").
				Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
				Html::seccion(2, "Mesa comedor vintage", "nombre_producto").
				Html::div_("detalles").
					Html::p("Cocina", "categoria").
					Html::p('897€', "precio").
				Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
				Html::img("../imagenes/_ID5-estanteria.jpg", "Estantería molona").
				Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
				Html::seccion(2, "Estantería molona", "nombre_producto").
				Html::div_("detalles").
					Html::p("Dormitorio", "categoria").
					Html::p('832€', "precio").
				Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
				Html::img("../imagenes/_ID6-mesita_noche.jpg", "Mesita dulces sueños").
				Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
				Html::seccion(2, "Mesita dulces sueños", "nombre_producto").
				Html::div_("detalles").
					Html::p("Dormitorio", "categoria").
					Html::p('279€', "precio").
				Html::_div().
			Html::_div().Html::_a().
			
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID4-mesa_comedor.jpg", "Mesa comedor vintage").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Mesa comedor vintage", "nombre_producto").
			Html::div_("detalles").
			Html::p("Cocina", "categoria").
			Html::p('897€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID5-estanteria.jpg", "Estantería molona").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Estantería molona", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p('832€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID6-mesita_noche.jpg", "Mesita dulces sueños").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Mesita dulces sueños", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p('279€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID4-mesa_comedor.jpg", "Mesa comedor vintage").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Mesa comedor vintage", "nombre_producto").
			Html::div_("detalles").
			Html::p("Cocina", "categoria").
			Html::p('897€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID5-estanteria.jpg", "Estantería molona").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Estantería molona", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p('832€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID6-mesita_noche.jpg", "Mesita dulces sueños").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Mesita dulces sueños", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p('279€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 1
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID4-mesa_comedor.jpg", "Mesa comedor vintage").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Mesa comedor vintage", "nombre_producto").
			Html::div_("detalles").
			Html::p("Cocina", "categoria").
			Html::p('897€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 2
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID5-estanteria.jpg", "Estantería molona").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Estantería molona", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p('832€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			//Ejemplo 3
			Html::div_("contenedor_producto").Html::a_("#").
			Html::img("../imagenes/_ID6-mesita_noche.jpg", "Mesita dulces sueños").
			Html::div_("novedad").Html::img("../imagenes/nuevo.png", "etiqueta indicando novedad", "etiqueta_nuevo").Html::_div().
			Html::seccion(2, "Mesita dulces sueños", "nombre_producto").
			Html::div_("detalles").
			Html::p("Dormitorio", "categoria").
			Html::p('279€', "precio").
			Html::_div().
			Html::_div().Html::_a().
			
		Html::_div();

	
	GestionaPLantilla::Fin_Plantilla();
?>