<?php

class CatalogoProductos {
	
	// DECLARACIÓN VARIABLES.
	/**
	 * @var matrix -> catalogo["categoría"]["cod_producto"][Producto]
	 */
	private $catalogo;
	/**
	 * @var number -> Indica el número de categorías + productos en el catálogo. Esto me será útil en el tamaño del selector.
	 */
	private $size;
	
	//CONSTRUCTOR
	/**
	 * El catálogo de productos almacenará los productos en arrays en función de su categoría y de su código.
	 * El catálogo se iniciliciará como un vector vacío, pero al introducir nuevos productos será una matrziz
	 * con el siguiente formato: 'catalogo["categoría"]["cod_producto"][Producto]'
	 * El obejto 'CatalogoProductos' podrá llamar a métodos que permitan ver sus productos
	 * almacenar nuevos, eliminar y modificar.
	 */
	public function CatalogoProductos() {
		$this->catalogo=array(); // Se inicializa como vector normal
		$this->size=0; // Inicializo el tamaño de '$size' a 0
	}
	
	// MÉTODOS
	
	//Setters y getters
	public function getProductos() {
		return $this->catalogo;
	}
	public function getSize() {
		return $this->size;
	}
	
	//métodos
	/**
	 * Método cutre para asegurarme de que estoy pasando un objeto 'Producto' con las propiedades adecuadas.
	 * No obstante, no se asegura de que sea de la clase 'Producto' ...
	 * @param unknown $producto
	 */
	private function EsProducto($producto) {
		if (property_exists($producto, "codigo") ||
				property_exists($producto, "nombre") ||
				property_exists($producto, "categoria") ||
				property_exists($producto, "precio") ||
				property_exists($producto, "descuento") ||
				property_exists($producto, "nuevo") ||
				property_exists($producto, "caracteristicas") ||
				property_exists($producto, "imagen")) {
			return true;
		}
		else
			return false;
	}
	
	/**
	 * Comprueba si el producto existe o no en el catálogo a partir del código pasado por parámetro.
	 * @param string $CodProducto -> Código del producto para comprobar.
	 * @return true: El producto existe en el catálogo - false: El producto no existe en el catálogo
	 */
	public function ExisteCod($CodProducto) {
		$existe=false;
		foreach ($this->catalogo as $categoria=>$valor) {
			foreach ($valor as $producto) {
				if (!empty($producto)) {
					if ($producto->__get("codigo")==$CodProducto) {
						$existe=true;
						break;
					}
				}
			}
		}
		return $existe;
	}
	
	/**
	 * Comprueba si el producto existe o no en el catálogo.
	 * @param object $producto -> Perteneciente a la Clase 'Producto'
	 * @return true: El producto existe en el catálogo - false: El producto no existe en el catálogo
	 */
	public function Existe($producto) {
		if ($this->EsProducto($producto)) {
			$id_producto = $producto->__get("codigo");
			return $this->ExisteCod($id_producto);
		}
		else
			return false;
	}
	
	/**
	 * Busca un producto en el catálogo.
	 * @param unknown $CodProducto -> Código del producto
	 * @return false: Sino encuentra el producto - Objeto de la clase 'Producto' en caso de encontrarlo.
	 */
	public function Buscar($CodProducto) {
		$existe=false;
		foreach ($this->catalogo as $categoria=>$valor) {
			foreach ($valor as $producto) {
				if ($producto->__get("codigo")==$CodProducto) {
					$existe=true;
					return $producto;
				}
			}
		}
		if (!$existe)
			return false;
	}
		
	/**
	 * Añade un nuevo producto ordenados por su código y a su vez por su categoría en una matriz de tipo catalogo["categoría"]["cod_producto"][Producto]
	 * @param object $producto -> Perteneciente a la Clase 'Producto'
	 * @return true: En caso de añadir el producto con éxito
	 * 	       false: No añadirlo debido a no tener las propiedades de la clase o tener un código existente en el catálogo.
	 */
	public function Nuevo($producto) {	
		
		if ($this->EsProducto($producto) && !$this->Existe($producto)) {

			if (!isset($this->catalogo[$producto->__get("categoria")])) { // Para crear una nueva categoría y añadir un primer producto a dicha categoría
				$this->catalogo = $this->catalogo + [ $producto->__get("categoria") => [$producto->__get("codigo")=>$producto] ];
				$this->size = $this->size + 2; // Incremento el tamaño +1 por categoría y +1 por el producto
			}
			else {// Para NO sobreescribir una categoría existente y añadir un producto nuevo a dicha categoría
				$this->catalogo[$producto->__get("categoria")] = $this->catalogo[$producto->__get("categoria")] + [$producto->__get("codigo")=>$producto];
				$this->size++; // Incremento el tamaño +1 por el producto
			}
			return true;
		}
		else
			return false;		
	}
	
}