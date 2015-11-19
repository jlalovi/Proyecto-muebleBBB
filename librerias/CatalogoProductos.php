<?php

class CatalogoProductos {
	
	// DECLARACIÓN VARIABLES.
	private $dormitorio;
	private $salon;
	private $cocina;
	private $baño;
	private $exterior;
	private $todo;
	
	//CONSTRUCTOR
	/**
	 * El catálogo de productos almacenará los productos en arrays en función de su categoría.
	 * Dicho catálogo empezará con cada una de sus categorías (arrays), vacías.
	 * El obejto 'CatalogoProductos' podrá llamar a métodos que permitan ver sus productos
	 * almacenar nuevos, eliminar y modificar.
	 */
	public function CatalogoProductos() {
		$this->__set("dormitorio", []);
		$this->__set("salon", []);
		$this->__set("cocina", []);
		$this->__set("baño", []);
		$this->__set("exterior", []);
		$this->__set("todo", []);
	}
	
	// MÉTODOS
	
	//Setters y getters
	public function __get($propiedad) {
		if (property_exists($this, $propiedad)) {
			return $this->$propiedad;
		}
	}
	public function __set($propiedad, $valor) {
		if (property_exists($this, $propiedad)) {
			$this->$propiedad = $valor;
		}
		return $this;
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
		foreach ($this->todo as $p) {
			if ($p->__get("codigo")==$CodProducto) {
				$existe=true;
				break;
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
		if ($this->esProducto($producto)) {
			$id_producto = $producto->__get("codigo");
			return $this->existeCod($id_producto);
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
		foreach ($this->todo as $p) {
			if ($p->__get("codigo")==$CodProducto) {
				$existe=true;
				return $p;
			}
		}
		if (!$existe)
			return false;
	}
		
	/**
	 * Añade un producto al catálogo, en su correspondiente array categoría y en el array 'todo'
	 * @param object $producto -> Perteneciente a la Clase 'Producto'
	 * @return true: En caso de añadir el producto con éxito
	 * 	       false: No añadirlo debido a no tener las propiedades de la clase o tener un código existente en el catálogo.
	 */
	public function Nuevo($producto) {
		if ($this->esProducto($producto) && !$this->existe($producto)) {
			$this->todo[]=$producto; // Todos los productos los almaceno en el array $todo
			switch ($producto->__get("categoria")) {
			    case 1:
			    	$this->dormitorio[]=$producto;
			        break;
		        case 2:
		        	$this->salon[]=$producto;
		        	break;
	        	case 3:
	        		$this->cocina[]=$producto;
	        		break;
        		case 4:
        			$this->baño[]=$producto;
        			break;
        		case 5:
        			$this->exterior[]=$producto;
        			break;
			    default:
			        return false; // En caso de haber una categoría diferente, la rechazo
			}
			return true;
		}
		else
			return false;		
	}
	
}