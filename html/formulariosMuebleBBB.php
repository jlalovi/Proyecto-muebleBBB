<?php

	/************************************************************
	 *                 FORMULARIOS DE PRODUCTO
	 ************************************************************/

	/**
	 * Genera el formulario para crear un nuevo producto.
	 * @param number/string $max_producto -> C�digo que va a tener el nuevo producto (depende del c�digo m�ximo + 1 del existente en la BBDD) 
	 */
	function contenedorNuevoProducto($max_producto) {
		echo
		Html::div_("opciones_admin contenedor_nuevo_producto").
			Html::form_("admin_datos_producto.php", "GET").
				Html::seccion(1,"NUEVO PRODUCTO").
				Html::input("text", "codigo", "$max_producto", "codigoNuevoProducto", true, "C�digo: ", "", "readonly='readonly' size='5'").
				Html::input("text", "nuevo_producto", "nuevo_producto", "campoNuevoProducto"). // display=none
				Html::input("submit", "", "Crear").
			Html::_form().
		Html::_div();
	}
	
	/**
	 * Genera el formulario para seleccionar un producto existente para modificarlo.
	 */
	function contenedorModificarProducto($catalogo) {
		echo
		Html::div_("opciones_admin contenedor_modificar_producto").
			Html::form_("admin_datos_producto.php", "GET").
				Html::seccion(1,"MODIFICAR PRODUCTO");
				echo Html::select_("id_modificar_producto", "", "modificar_productos", "required='required' size='15'");
					$productos = $catalogo->getProductos();				
					foreach ($productos as $categoria=>$id_producto) {
						echo Html::optgroup_("$categoria");
						foreach ($id_producto as $producto) {
							echo Html::option("{$producto->__get("codigo")}", "{$producto->__get("nombre")}");
						}
						echo Html::_optgroup();
					}
				echo Html::_select();
				echo Html::input("submit", "", "Modificar", "btnModificarProducto").
				Html::div_("clear").Html::_div().
			Html::_form().
		Html::_div();
	}
	
	function contenedorDatosNuevoProducto($GET, $categorias) {
		echo
		Html::div_("opciones_admin contenedor_datos_producto").
			Html::form_("", "POST", "", "", "enctype='multipart/form-data'"). // La ruta deber�a ser la p�gina del producto creado/modificado.			
				Html::seccion(1,"PRODUCTO").
				
				Html::input("text", "codigo", "{$GET['codigo']}", "codigo", true, "C�digo:", "", "readonly='readonly' size='5'").
				Html::br().
				
				Html::input("text", "nombre", "", "nombre", true, "Nombre:", "", "required='required' size='20' maxlength='20'").
				Html::br().
				
				Html::input("number", "precio", "", "precio", true, "Precio:", "", "required='required' min='1' max='999999'").Html::span("�").
				Html::br().
				
				Html::textarea("", "Material, dimensiones, colores, informaci�n adicional...", "caracteristicas", "caracteristicas", true, "Caracter�sticas: ", "", "required='required' maxlength='200'").
				Html::br().
				
				Html::label("Tipo:", "tipo_producto").
				Html::select(1, ["normal"=>"Normal","nuevo"=>"Novedad","oferta"=>"Oferta"],"tipo_producto", 1, "", "tipo_producto").
				Html::div_("invisible", "bloque_descuento").
					Html::input("number", "descuento", "0", "descuento", true, "Descuento:", "", "required='required' min='0' max='90'").Html::span("%").
				Html::_div().
				Html::br().
				
				Html::label("Categor�a:").
				Html::br();

				foreach ($categorias as $id_categoria=>$categoria) {
					echo
					Html::input("radio", "categoria", "$id_categoria", "id_$id_categoria", false, "", "", "required='required'").Html::label("$categoria", "id_$id_categoria", "etiqueta_categoria").
					Html::br();
				}
		
				echo
				Html::div_("bloque_imagen").
					Html::label("Imagen (360x360 px):", "imagen", "", "", "title='Se deformar� si las dimensiones NO son las especificadas y evidentemente no se cargar� si NO es una imagen.'").
					Html::br().
					Html::input("file", "imagen", "", "imagen").
					Html::br().
				Html::_div().
				
				Html::input("submit", "", "A�adir producto").
				
			Html::_form().
			Html::div_("clear").Html::_div().
		Html::_div();
	}
	
	function contenedorDatosProductoExistente($producto, $categorias) {
		echo
		Html::div_("opciones_admin contenedor_datos_producto").
			Html::form_("", "POST", "", "", "enctype='multipart/form-data'"). // La ruta deber�a ser la p�gina del producto creado/modificado.			
				Html::seccion(1,"PRODUCTO").
				
				Html::input("text", "codigo", "{$producto->__get("codigo")}", "codigo", true, "C�digo:", "", "readonly='readonly' size='5'").
				Html::br().
				
				Html::input("text", "nombre", "{$producto->__get("nombre")}", "nombre", true, "Nombre:", "", "required='required' size='20' maxlength='20'").
				Html::br().
				
				Html::input("number", "precio", "{$producto->__get("precio")}", "precio", true, "Precio:", "", "required='required' min='1' max='999999'").Html::span("�").
				Html::br().
				
				Html::textarea("{$producto->__get("caracteristicas")}", "Material, dimensiones, colores, informaci�n adicional...", "caracteristicas", "caracteristicas", true, "Caracter�sticas: ", "", "required='required' maxlength='200'").
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
				
				Html::label("Categor�a:").
				Html::br();
				
				foreach ($categorias as $id_categoria=>$categoria) {
					if ($producto->__get("id_categoria")==$id_categoria) {
						echo
						Html::input("radio", "categoria", "$id_categoria", "id_$id_categoria", false, "", "", "required='required' checked='checked'").Html::label("$categoria", "id_$id_categoria", "etiqueta_categoria").
						Html::br();
					}
					else {
						echo
						Html::input("radio", "categoria", "$id_categoria", "id_$id_categoria", false, "", "", "required='required'").Html::label("$categoria", "id_$id_categoria", "etiqueta_categoria").
						Html::br();
					}
				}
				
				echo
				Html::div_("bloque_imagen").
					Html::label("Imagen (360x360 px):", "imagen", "", "", "title='Se deformar� si las dimensiones NO son las especificadas y evidentemente no se cargar� si NO es una imagen.'").
					Html::br().
					Html::input("file", "imagen", "", "imagen").
					Html::br().
				Html::_div().
				
				Html::input("checkbox", "borrar", "", "borrarProductoCB", true, "Borrar Producto"). // JS para alert!!!
				Html::br().
				
				Html::input("submit", "", "Guardar cambios").
				Html::div_("clear").Html::_div().
			Html::_form().
		Html::_div();
		Html::div_("clear").Html::_div();
	}
	
	/************************************************************
	 *                 FORMULARIOS DE CATEGOR�A
	 ************************************************************/
	
	/**
	 * Genera el formulario para crear una nueva categor�a.
	 * @param number/string $max_producto -> C�digo que va a tener el nuevo producto (depende del c�digo m�ximo + 1 del existente en la BBDD)
	 * @param string $mensaje -> Mensaje de confirmaci�n/error que aparecer� una vez pulsado el bot�n de crear categor�a.
	 */
	function contenedorNuevaCategoria($max_categoria, $mensaje_newCat) {
		echo
		Html::div_("opciones_admin contenedor_nueva_categoria").
			Html::form_("", "POST").
				Html::seccion(1,"NUEVA CATEGOR�A").
				Html::input("text", "id_categoria", "$max_categoria", "codigoNuevaCategoria", true, "C�digo: ", "", "readonly='readonly' size='5'").
				Html::br().
				Html::input("text", "nueva_categoria", "", "nombreNuevaCategoria", true, "Nombre: ", "", "placeholder='Categoria' required='required'  size='10' maxlength='10'").
				Html::input("submit", "", "Crear").
			Html::_form();
			if ($mensaje_newCat!="") {
				echo Html::div_("mensaje_nueva_categoria");
				if ($mensaje_newCat=="�OK!"){				
					echo Html::span(" ", "fontawesome-ok mensaje_correcto", "", "title='La categor�a ha sido creada con �xito'").Html::p("$mensaje_newCat", "mensaje_correcto visible_inline");
				}
				else if ($mensaje_newCat=="�Error!"){
					echo Html::span(" ", "fontawesome-remove error", "", "title='La categor�a ya existe en la BBDD'").Html::p("$mensaje_newCat", "error visible_inline");
				}
				echo Html::_div();	
			}
		echo Html::_div();
	}
	
	/**
	 * Genera el formulario para crear una nueva categor�a.
	 * @param array asociativo $categorias -> Contiene las categor�as de la BBDD MuebleBBB de esta manera: "id-categoria"=>"nombre-categoria"
	 */
	function contenedorModificarCategoria($categorias, $mensaje_modCat) {
		echo
		Html::div_("opciones_admin contenedor_modificar_categoria").
			Html::form_("", "POST").
				Html::seccion(1,"MODIFICAR CATEGOR�A").
				Html::select(1, $categorias, "categoria_id", 1, "", "modificar_categorias").
				Html::input("text", "nuevo_nombre_categoria", "", "nombreModificarCategoria", false, "", "", "placeholder='Nuevo nombre' required='required'  size='10' maxlength='10'").
				Html::br().
				Html::input("checkbox", "borrar", "", "borrarCategoriaCB", true, "Borrar Categoria"). // JS para alert!!!
				Html::br().
				Html::input("submit", "", "Modificar", "btnModificarCategoria").
			Html::_form().
			Html::div_("clear").Html::_div();
			if ($mensaje_modCat!="") {
				echo Html::div_("mensaje_modificar_categoria");
				if ($mensaje_modCat=="�OK!"){
					echo Html::span(" ", "fontawesome-ok mensaje_correcto", "", "title='La categor�a ha sido modificada con �xito'").Html::p("$mensaje_modCat", "mensaje_correcto visible_inline");
				}
				else if ($mensaje_modCat=="�Error!"){
					echo Html::span(" ", "fontawesome-remove error", "", "title='La categor�a ya existe en la BBDD'").Html::p("$mensaje_modCat", "error visible_inline");
				}
				else if ($mensaje_modCat=="�Borrado!"){
					echo Html::span(" ", "fontawesome-ok mensaje_correcto", "", "title='La categor�a se ha borrado con �xito'").Html::p("$mensaje_modCat", "mensaje_correcto visible_inline");
				}
				else if ($mensaje_modCat=="�Productos en categor�a!"){
					echo Html::span(" ", "fontawesome-remove error", "", "title='La categor�a contiene productos'").Html::p("$mensaje_modCat", "error visible_inline");
				}
				echo Html::_div();
			}
		echo Html::_div();
	}

?>