<?php
	// Librerías
	require_once '../librerias/GestionaPlantilla.php';
	require_once '../librerias/Html.php';
	require_once '../librerias/BBDDMuebleBBB.php';
	
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
	
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__PlantillaAdmin.html");

	//Contenido HTML construído a través de métodos estáticos de la clase Html (Ver documentación en caso de duda).
	if (!empty($_POST)) { // Si $_POST no está vacío es que se ha realizado una solicitud de 'Añadir producto' o 'Guardar cambios'
		// TESTEO
		echo Html::seccion(1,"Cambios realizados:");
		$BBDD = new MySQLDataBase("mueblebbb");
		$MuebleBBB = new BBDDMuebleBBB($BBDD);
		if (!empty($_POST))
			$MuebleBBB->actualizarBBDD($_REQUEST, $_FILES);
		$MuebleBBB->cargarCatalogo();
		$catalogo = $MuebleBBB->getCatalogo();
		var_dump($catalogo);
		// FIN TESTEO
	} // En caso de estar vacío el '$_POST', se comprueba si se debe generar un formulario de tipo 'Nuevo producto' o 'Buscar producto'
	else if (isset($_GET["nuevo_producto"])) { // Si existe este campo, es que se ha creado un nuevo producto.
		echo
		Html::div_("opciones_admin contenedor_datos_producto").
			Html::form_("", "POST", "", "", "enctype='multipart/form-data'"). // La ruta debería ser la página del producto creado/modificado.			
				Html::seccion(1,"PRODUCTO").
				
				Html::input("text", "codigo", "{$_GET['codigo']}", "codigo", true, "Código:", "", "readonly='readonly' size='5'").
				Html::br().
				
				Html::input("text", "nombre", "", "nombre", true, "Nombre:", "", "required='required' size='20' maxlength='20'").
				Html::br().
				
				Html::input("number", "precio", "", "precio", true, "Precio:", "", "required='required' min='1' max='999999'").Html::span("€").
				Html::br().
				
				Html::textarea("", "Material, dimensiones, colores, información adicional...", "caracteristicas", "caracteristicas", true, "Características: ", "", "required='required' maxlength='200'").
				Html::br().
				
				Html::label("Tipo:", "tipo_producto").
				Html::select(1, ["normal"=>"Normal","nuevo"=>"Novedad","oferta"=>"Oferta"],"tipo_producto", 1, "", "tipo_producto").
				Html::div_("invisible", "bloque_descuento").
					Html::input("number", "descuento", "0", "descuento", true, "Descuento:", "", "required='required' min='0' max='90'").Html::span("%").
				Html::_div().
				Html::br().
				
				Html::label("Categoría:").
				Html::br().
				
				Html::input("radio", "categoria", "1", "dormitorio", false, "", "", "required='required'").Html::label("Dormitorio", "dormitorio", "etiqueta_categoria").
				Html::br().
				
				Html::input("radio", "categoria", "2", "salon").Html::label("Salón", "salon", "etiqueta_categoria").
				Html::br().
				
				Html::input("radio", "categoria", "3", "cocina").Html::label("Cocina", "cocina", "etiqueta_categoria").
				Html::br().
				
				Html::input("radio", "categoria", "4", "banyo").Html::label("Baño", "banyo", "etiqueta_categoria").
				Html::br().
				
				Html::input("radio", "categoria", "5", "exterior").Html::label("Exterior", "exterior", "etiqueta_categoria").
				Html::br().
				
				Html::div_("bloque_imagen").
					Html::label("Imagen (360x360 px):", "imagen", "", "", "title='Se deformará si las dimensiones NO son las especificadas y evidentemente no se cargará si NO es una imagen.'").
					Html::br().
					Html::input("file", "imagen", "", "imagen").
					Html::br().
				Html::_div().
				
				Html::input("submit", "", "Añadir producto").
			
			Html::_form().
		Html::_div();
		Html::div_("clear").Html::_div();
	} else if ($catalogo->ExisteCod($_GET['buscar_producto'])) { // Compruebo si el código introducido existe.
		$producto = $catalogo->Buscar($_GET['buscar_producto']); // Busco el producto en el catálogo
		echo
		Html::div_("opciones_admin contenedor_datos_producto").
			Html::form_("", "POST", "", "", "enctype='multipart/form-data'"). // La ruta debería ser la página del producto creado/modificado.			
				Html::seccion(1,"PRODUCTO").
				
				Html::input("text", "codigo", "{$producto->__get("codigo")}", "codigo", true, "Código:", "", "readonly='readonly' size='5'").
				Html::br().
				
				Html::input("text", "nombre", "{$producto->__get("nombre")}", "nombre", true, "Nombre:", "", "required='required' size='20' maxlength='20'").
				Html::br().
				
				Html::input("number", "precio", "{$producto->__get("precio")}", "precio", true, "Precio:", "", "required='required' min='1' max='999999'").Html::span("€").
				Html::br().
				
				Html::textarea("{$producto->__get("caracteristicas")}", "Material, dimensiones, colores, información adicional...", "caracteristicas", "caracteristicas", true, "Características: ", "", "required='required' maxlength='200'").
				Html::br().
				
				Html::label("Tipo:", "tipo_producto");
				if ($producto->__get("nuevo"))
					echo Html::select(1, ["normal"=>"Normal","nuevo"=>"Novedad","oferta"=>"Oferta"],"tipo_producto", 2, "", "tipo_producto");
				else if ($producto->__get("descuento")>0)
					echo Html::select(1, ["normal"=>"Normal","nuevo"=>"Novedad","oferta"=>"Oferta"],"tipo_producto", 3, "", "tipo_producto");
				else
					echo Html::select(1, ["normal"=>"Normal","nuevo"=>"Novedad","oferta"=>"Oferta"],"tipo_producto", 1, "", "tipo_producto");
				
				echo 
				Html::div_("invisible", "bloque_descuento").
					Html::input("number", "descuento", "0", "descuento", true, "Descuento:", "", "required='required' min='0' max='90'").Html::span("%").
				Html::_div().
				Html::br().
				
				Html::label("Categoría:").
				Html::br();
				if ($producto->__get("categoria")==1)
					echo Html::input("radio", "categoria", "1", "dormitorio", false, "", "", "required='required' checked='checked'").Html::label("Dormitorio", "dormitorio", "etiqueta_categoria");
				else 
					echo Html::input("radio", "categoria", "1", "dormitorio", false, "", "", "required='required'").Html::label("Dormitorio", "dormitorio", "etiqueta_categoria");
				echo Html::br();
				
				if ($producto->__get("categoria")==2)
					echo Html::input("radio", "categoria", "2", "salon", false, "", "", "checked='checked'").Html::label("Salón", "salon", "etiqueta_categoria");
				else
					echo Html::input("radio", "categoria", "2", "salon").Html::label("Salón", "salon", "etiqueta_categoria");
				echo Html::br();
				
				if ($producto->__get("categoria")==3)
					echo Html::input("radio", "categoria", "3", "cocina", false, "", "", "checked='checked'").Html::label("Cocina", "cocina", "etiqueta_categoria");
				else
					echo Html::input("radio", "categoria", "3", "cocina").Html::label("Cocina", "cocina", "etiqueta_categoria");
				echo Html::br();
				
				if ($producto->__get("categoria")==4)
					echo Html::input("radio", "categoria", "4", "banyo", false, "", "", "checked='checked'").Html::label("Baño", "banyo", "etiqueta_categoria");
				else
					echo Html::input("radio", "categoria", "4", "banyo").Html::label("Baño", "banyo", "etiqueta_categoria");
				echo Html::br();
				
				if ($producto->__get("categoria")==5)
					echo Html::input("radio", "categoria", "5", "exterior", false, "", "", "checked='checked'").Html::label("Exterior", "exterior", "etiqueta_categoria");
				else
					echo Html::input("radio", "categoria", "5", "exterior").Html::label("Exterior", "exterior", "etiqueta_categoria");
				echo Html::br().
				
				Html::div_("bloque_imagen").
					Html::label("Imagen (360x360 px):", "imagen", "", "", "title='Se deformará si las dimensiones NO son las especificadas y evidentemente no se cargará si NO es una imagen.'").
					Html::br().
					Html::input("file", "imagen", "", "imagen").
					Html::br().
				Html::_div().
				
				Html::input("checkbox", "borrar", "", "borrarProductoCB", true, "Borrar Producto"). // JS para alert!!!
				Html::br().
				
				Html::input("submit", "", "Guardar cambios").
			
			Html::_form().
		Html::_div();
		Html::div_("clear").Html::_div();
	} else { // En caso de haber introducido un código NO existente en la BBDD al buscar un producto, devuelvo este error.
		echo Html::p("El código del producto introducido NO existe.", "error");
	}
		
	/*TESTEO*/
	echo 'DATOS $_POST, $_GET Y $_FILES:';
	var_dump($_POST);
	var_dump($_GET);
	var_dump($_FILES);
	/*FIN TESTEO*/
	
	GestionaPLantilla::Fin_Plantilla();
	
?>