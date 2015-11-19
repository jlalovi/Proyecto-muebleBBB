<?php
	// Librerías
	require_once '../librerias/GestionaPlantilla.php';
	require_once '../librerias/Html.php';
	require_once '../librerias/MySQLDataBase.php';
	
	//Inicializo la base de datos muebleBBB para hacer una consulta en el siguiente paso
	$BBDD = new MySQLDataBase("mueblebbb");
		
	//Busco en la BBDD el valor máximo del código de todos los productos y lo almaceno en '$codmax'
	$codmax= $BBDD->Consultar("productos", "max(id_producto)")[0][0] + 1; // Las consultas me devuelven una matriz, de ahí que indico la posición [0][0]. Le sumo 1 para que sea el siguiente código.

	/*************************************
	 GENERO EL HTML DE LA PÁGINA ADMIN.PHP
	**************************************/
	
	GestionaPLantilla::Inicio_Plantilla("../plantilla/__PlantillaAdmin.html");

	//Contenido HTML construído a través de métodos estáticos de la clase Html (Ver documentación en caso de duda).
	echo
		Html::div_("opciones_admin contenedor_nuevo_producto").
			Html::form_("admin_datos_producto.php", "GET").
				Html::seccion(1,"NUEVO PRODUCTO").
				Html::input("text", "codigo", "$codmax", "codigoNuevoProducto", true, "Código: ", "", "readonly='readonly' size='5'").
				Html::input("text", "nuevo_producto", "nuevo_producto", "campoNuevoProducto"). // display=none
				Html::input("submit", "", "Nuevo").		
			Html::_form().
		Html::_div().
		Html::div_("opciones_admin contenedor_buscar_producto").
			Html::form_("admin_datos_producto.php", "GET").		
			Html::seccion(1,"BUSCAR PRODUCTO").
				Html::input("number", "buscar_producto", "", "buscar_producto", false, "", "", "placeholder='Código' required='required'"). // TODO autorrellenar campos (PHP) si el ID coincide con alguno de los productos de la BBDD. En caso contrario mostrar mensaje de error de NO coincidencia
				Html::input("submit", "", "Buscar").		
			Html::_form().
		Html::_div();
	
	GestionaPLantilla::Fin_Plantilla();
	
?>