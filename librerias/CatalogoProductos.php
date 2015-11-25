<?php

class CatalogoProductos {
	
	// DECLARACI�N VARIABLES.
	/**
	 * @var matrix -> catalogo["categor�a"]["cod_producto"][Producto]
	 */
	private $catalogo;
	/**
	 * @var number -> Indica el n�mero de categor�as + productos en el cat�logo. Esto me ser� �til en el tama�o del selector.
	 */
	private $size;
	
	//CONSTRUCTOR
	/**
	 * El cat�logo de productos almacenar� los productos en arrays en funci�n de su categor�a y de su c�digo.
	 * El cat�logo se iniciliciar� como un vector vac�o, pero al introducir nuevos productos ser� una matrziz
	 * con el siguiente formato: 'catalogo["categor�a"]["cod_producto"][Producto]'
	 * El obejto 'CatalogoProductos' podr� llamar a m�todos que permitan ver sus productos
	 * almacenar nuevos, eliminar y modificar.
	 */
	public function CatalogoProductos() {
		$this->catalogo=array(); // Se inicializa como vector normal
		$this->size=0; // Inicializo el tama�o de '$size' a 0
	}
	
	// M�TODOS
	
	//Setters y getters
	public function getProductos() {
		return $this->catalogo;
	}
	public function getSize() {
		return $this->size;
	}
	
	//m�todos
	/**
	 * M�todo cutre para asegurarme de que estoy pasando un objeto 'Producto' con las propiedades adecuadas.
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
	 * Comprueba si el producto existe o no en el cat�logo a partir del c�digo pasado por par�metro.
	 * @param string $CodProducto -> C�digo del producto para comprobar.
	 * @return true: El producto existe en el cat�logo - false: El producto no existe en el cat�logo
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
	 * Comprueba si el producto existe o no en el cat�logo.
	 * @param object $producto -> Perteneciente a la Clase 'Producto'
	 * @return true: El producto existe en el cat�logo - false: El producto no existe en el cat�logo
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
	 * Busca un producto en el cat�logo.
	 * @param unknown $CodProducto -> C�digo del producto
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
	 * A�ade un nuevo producto ordenados por su c�digo y a su vez por su categor�a en una matriz de tipo catalogo["categor�a"]["cod_producto"][Producto]
	 * @param object $producto -> Perteneciente a la Clase 'Producto'
	 * @return true: En caso de a�adir el producto con �xito
	 * 	       false: No a�adirlo debido a no tener las propiedades de la clase o tener un c�digo existente en el cat�logo.
	 */
	public function Nuevo($producto) {	
		
		if ($this->EsProducto($producto) && !$this->Existe($producto)) {

			if (!isset($this->catalogo[$producto->__get("categoria")])) { // Para crear una nueva categor�a y a�adir un primer producto a dicha categor�a
				$this->catalogo = $this->catalogo + [ $producto->__get("categoria") => [$producto->__get("codigo")=>$producto] ];
				$this->size = $this->size + 2; // Incremento el tama�o +1 por categor�a y +1 por el producto
			}
			else {// Para NO sobreescribir una categor�a existente y a�adir un producto nuevo a dicha categor�a
				$this->catalogo[$producto->__get("categoria")] = $this->catalogo[$producto->__get("categoria")] + [$producto->__get("codigo")=>$producto];
				$this->size++; // Incremento el tama�o +1 por el producto
			}
			return true;
		}
		else
			return false;		
	}
	
}