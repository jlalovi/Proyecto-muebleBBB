<?php
	// Librerías
	require_once 'Producto.php';
	require_once 'CatalogoProductos.php';
	require_once 'MySQLDataBase.php';
	require_once 'validacionesMuebleBBB.php';

	class BBDDMuebleBBB {
		
		private $catalogo; // Objeto de la clase 'CatalogoProductos'
		private $BBDD;
		
		/**
		 * Constructor de la clase 'BBDDMuebleBBB'
		 * @param object $BBDD -> Objeto de la clase 'MySQLDataBase' que ha cargado específicamente la BBDD de mueblebbb
		 */
		public function BBDDMuebleBBB($BBDD) {
			$this->catalogo = new CatalogoProductos();
			$this->BBDD = $BBDD;
		}

		/**
		 * Generador del contenido del catálogo de muebleBBB a partir de su BBDD
		 */
		public function cargarCatalogo() {
			
			//Almaceno datos de BBDD en array de productos con las propiedades de la BBDD
			$productos= $this->BBDD->Consultar("productos", "*", "", true);
			
			foreach ($productos as $producto) {
				// Las propiedades la BBDD las traduzco a propiedades de la clase 'Producto'
				$codigo=$producto["id_producto"];
				$categoria=$producto["id_categoria"];
				$nombre=$producto["nombre"];
				$imagen=$producto["imagen"];
				$precio=$producto["precio"];
				$descuento=$producto["descuento"];
				$nuevo=$producto["nuevo"];
				$caracteristicas=$producto["caracteristicas"];
			
				// A partir de dichas propiedades creo y almaceno dichos productos en la clase 'Catálogo'
				$this->catalogo->nuevo(new Producto($codigo, $nombre, $categoria, $precio, $descuento, $nuevo, $caracteristicas, $imagen));
			}
		}
		
		/**
		 * Getter del catálogo de la BBDD muebleBBB
		 */
		public function getCatalogo() {
			return $this->catalogo;
		}
	
		/**
		 * Actualiza un producto de la BBDD de MySQL en función de los datos enviados por parámetro al Guardar cambios.
		 * Esta actualización puede consistir en borrar el producto de la BBDD o en modificar sus datos.
		 * @param object $request -> Datos provenientes del $_GET de 'Nuevo producto' y 'Buscar producto' y del $_POST de 'Producto'
		 * @param object $imagen -> Archivo que se ha almacenado en la varible $_FILES en el formulario.
		 */
		public function actualizarBBDD($request, $imagen) {
			// BORRAR
			if (isset($request["borrar"])) {
				echo Html::p("Se ha BORRADO el producto con ID {$request["codigo"]} con éxito.", "mensaje_correcto");				
				$this->BBDD->DeleteFrom("productos", "id_producto={$request["codigo"]}");
			}
			// CREAR
			else if (isset($request["nuevo_producto"])) {

				// VALIDACIONES
				$valida_nombre = validarNumCar($request["nombre"], 20);
				$valida_precio = validarRango($request["precio"], 1, 999999);
				$valida_descuento = validarRango($request["descuento"], 0, 90);
				$valida_caracteristicas = validarNumCar($request["caracteristicas"], 200);
				
				$todo_correcto = ($valida_nombre && $valida_precio && $valida_descuento && $valida_caracteristicas)?true:false;
				
				// Valida imagen, pero no es necesaria en '$todo_correcto'
				$crear_producto = true;
				$img = cargarImagen($imagen, $request["codigo"], $crear_producto);
				
				if ($todo_correcto) {
					echo Html::p("Se ha CREADO el producto con ID {$request["codigo"]} con éxito.", "mensaje_correcto");
					$nuevo = (($request["tipo_producto"])=="nuevo")?"true":"false";
					// OJO!!! Asegurarse del tipo de dato que se está insertando en la BBDD. Tipo string deben estar cerrados entre comillas simples '';
					$this->BBDD->InsertInto("productos", "id_producto, id_categoria, nombre, imagen, precio, descuento, nuevo, caracteristicas", 
							"{$request["codigo"]}, {$request["categoria"]}, '{$request["nombre"]}', '$img', {$request["precio"]}, {$request["descuento"]}, $nuevo, '{$request["caracteristicas"]}'");
				}
				else {
					echo Html::p("Debido al error o errores anteriores NO se ha creado el producto con ID {$request["codigo"]} con éxito.", "error");
				}
			}
			
			// MODIFICAR
			else if (isset($request["buscar_producto"])) {
				
				// VALIDACIONES
				$valida_nombre = validarNumCar($request["nombre"], 20);
				$valida_precio = validarRango($request["precio"], 1, 999999);
				$valida_descuento = validarRango($request["descuento"], 0, 90);
				$valida_caracteristicas = validarNumCar($request["caracteristicas"], 200);	
				
				$todo_correcto = ($valida_nombre && $valida_precio && $valida_descuento && $valida_caracteristicas)?true:false;
				
				// Valida imagen, pero no es necesaria en '$todo_correcto'
				$img = cargarImagen($imagen, $request["codigo"]);
				
				if ($todo_correcto) {
					echo Html::p("Se ha MODIFIFICADO el producto con ID {$request["codigo"]} con éxito.", "mensaje_correcto");
					
					// Indico si el producto es una novedad o no.
					$nuevo = (($request["tipo_producto"])=="nuevo")?"true":"false";
					
					// Modificaciones:
					// OJO!!! Asegurarse del tipo de dato que se está insertando en la BBDD. Tipo string deben estar cerrados entre comillas simples '';
					$this->BBDD->Update("productos", "id_categoria", "{$request["categoria"]}", "id_producto='{$request["codigo"]}'");
					$this->BBDD->Update("productos", "nombre", "'{$request["nombre"]}'", "id_producto='{$request["codigo"]}'");
					if ($img!=false)
						$this->BBDD->Update("productos", "imagen", "'$img'", "id_producto='{$request["codigo"]}'");
					$this->BBDD->Update("productos", "precio", "{$request["precio"]}", "id_producto='{$request["codigo"]}'");
					$this->BBDD->Update("productos", "descuento", "{$request["descuento"]}", "id_producto='{$request["codigo"]}'");
					$this->BBDD->Update("productos", "nuevo", "$nuevo", "id_producto='{$request["codigo"]}'");
					$this->BBDD->Update("productos", "caracteristicas", "'{$request["caracteristicas"]}'", "id_producto='{$request["codigo"]}'");
				}
				else {
					echo Html::p("Debido al error o errores anteriores NO se ha modificado el producto con ID {$request["codigo"]} con éxito.", "error");
				}
			}
			// ERROR
			else {
				echo Html::p("Ha habido algún error de algún tipo, por lo que NO se ha podido actualizar la BBDD.", "error");
			}
		}
				
	}
?>