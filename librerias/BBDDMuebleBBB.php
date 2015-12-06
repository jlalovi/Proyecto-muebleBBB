<?php
	// Librerías
	require_once 'Producto.php';
	require_once 'CatalogoProductos.php';
	require_once 'MySQLDataBase.php';
	require_once 'validacionesMuebleBBB.php';

	class BBDDMuebleBBB {
		
		private $catalogo; // Objeto de la clase 'CatalogoProductos'
		private $categorias; // Array por índice con el código de la categoría y su nombre.
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
			$productos= $this->BBDD->Consultar("productos", "*", "JOIN categorias ON categorias.id_categoria = productos.id_categoria ORDER BY categorias.categoria, productos.nombre", true);
			
			foreach ($productos as $producto) {
				// Las propiedades la BBDD las traduzco a propiedades de la clase 'Producto'
				$codigo=$producto["id_producto"];
				$categoria=$producto["categoria"];
				$id_categoria=$producto["id_categoria"];
				$nombre=$producto["nombre"];
				$imagen=$producto["imagen"];
				$precio=$producto["precio"];
				$descuento=$producto["descuento"];
				$nuevo=$producto["nuevo"];
				$caracteristicas=$producto["caracteristicas"];
			
				// A partir de dichas propiedades creo y almaceno dichos productos en la clase 'Catálogo'
				$this->catalogo->Nuevo(new Producto($codigo, $nombre, $id_categoria, $categoria, $precio, $descuento, $nuevo, $caracteristicas, $imagen));

			}
		}
		
		/**
		 * Getter del catálogo de la BBDD muebleBBB
		 */
		public function getCatalogo() {
			return $this->catalogo;
		}
		
		/**
		 * Comprueba si el usuario existe y si su contraseña es válida. También conprueba los privilegios del usuario en caso de tener su nombre y contraseña correctos.
		 * @return array -> [true, true, bool, bool]: en caso de se usuario y contraseñas válidos (Los siguientes dos booleanos corresponden a los privilegios de Admin y Cliente respectivamente)
		 * 					[false, false]: en caso de ser el nombre de usuario incorrecto (en este caso NO se comprueban contraseñas)
		 * 					[true, false]: en caso de ser el nombre de usuario correcto, pero su contraseña incorrecta.
		 */
		public function existeUsuario($usuario, $pass) {
			$bools = array();
			$users= $this->BBDD->Consultar("perfil_usuario pu", "*", "JOIN perfiles p ON pu.id_perfil=p.id_perfil JOIN usuarios u ON pu.id_usuario=u.id_usuario", true);
			
			foreach ($users as $user) {
				if ($user["usuario"]===$usuario) {
					if ($user["passwd"]===$pass){
						$filtro = $this->BBDD->Consultar("perfil_usuario pu", "*", "JOIN perfiles p ON pu.id_perfil=p.id_perfil JOIN usuarios u ON pu.id_usuario=u.id_usuario WHERE u.usuario='{$user["usuario"]}'", true);
						if (count($filtro)==2) {
							return [true,true, true, true];
						}
						else if ($user["perfil"]=="admin") {
							return [true,true, true, false];
						}
						else {
							return [true,true, false, true];
						}
					}		
					else
						return [true,false];
				}
				else {
					$bools = [false,false];
				}
			}
			return $bools;
		}
		
		/**
		 * Generador de las categorías de muebleBBB a partir de su BBDD
		 */
		public function cargarCategorias() {
			$this->categorias=array();
			$cats = $this->BBDD->Consultar("categorias", "*", "ORDER BY categoria", true);
			
			foreach ($cats as $c) {
				$codigo=$c["id_categoria"];
				$categoria=$c["categoria"];
				
				$nueva_categoria = array("$codigo"=>"$categoria");
				$this->categorias = $this->categorias + $nueva_categoria;
			}
		}
				
		/**
		 * Getter las categorías de la BBDD muebleBBB
		 */
		public function getCategorias() {
			return $this->categorias;
		}
		
		public function existeCategoria($categoria) {
			$this->cargarCategorias();
			foreach ($this->categorias as $valor=>$cat) {
				$esCategoria=false;
				if ($categoria==$cat) {
					$esCategoria = true;
					break;
				}
			}
			return $esCategoria;
		}
		
		public function existeIdCategoria($id_categoria) {
			$this->cargarCategorias();
			foreach ($this->categorias as $valor=>$cat) {
				$esCategoria=false;
				if ($id_categoria==$valor) {
					$esCategoria = true;
					break;
				}
			}
			return $esCategoria;
		}
		
		public function getCategoria($id_categoria) {
			$this->cargarCategorias();
			foreach ($this->categorias as $valor=>$cat) {
				if ($id_categoria==$valor) {
					return $cat;
				}
			}
			return false;
		}
	
		public function actualizarCategorias($request) {
			// BORRAR
			if (isset($request["borrar"])) {
				$this->cargarCatalogo();
				$catalogo = $this->getCatalogo();
				$productos = $catalogo->getProductos();
				$cat = $this->getCategoria($request["categoria_id"]);
				
				$productos_en_categoria = isset($productos["$cat"]);
				
				if (!$productos_en_categoria) { // Borraré la categoría de la BBDD, si esta NO contiene productos.
					$this->BBDD->DeleteFrom("categorias", "id_categoria={$request["categoria_id"]}");
					return true;
				}
				else return false;
			}
			
			// CREAR
			else if (isset($request["nueva_categoria"])) {
				// VALIDACIONES
				$valida_nombre = validarNumCar($request["nueva_categoria"], 10);
				
				if ($valida_nombre && !$this->existeCategoria($request["nueva_categoria"])) {
					$this->BBDD->InsertInto("categorias", "id_categoria, categoria", "{$request["id_categoria"]}, '{$request["nueva_categoria"]}'");
					return true;
				}
				else return false;
			}		
			
			// MODIFICAR
			else if (isset($request["nuevo_nombre_categoria"])) {
				// VALIDACIONES
				$valida_nombre = validarNumCar($request["nuevo_nombre_categoria"], 10);
			
				if ($valida_nombre && !$this->existeCategoria($request["nuevo_nombre_categoria"])) {
					$this->BBDD->Update("categorias", "categoria", "'{$request["nuevo_nombre_categoria"]}'", "id_categoria='{$request["categoria_id"]}'");
					return true;
				}
				else return false;
			}
		}
		
		/**
		 * Actualiza un producto de la BBDD de MySQL en función de los datos enviados por parámetro al Guardar cambios.
		 * Esta actualización puede consistir en borrar el producto de la BBDD o en modificar sus datos.
		 * @param object $request -> Datos provenientes del $_GET de 'Nuevo producto' y 'Buscar producto' y del $_POST de 'Producto'
		 * @param object $imagen -> Archivo que se ha almacenado en la varible $_FILES en el formulario.
		 */
		public function actualizarProductos($request, $imagen) {
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
			else if (isset($request["id_modificar_producto"])) {
				
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