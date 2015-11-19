<?php

class CatalogoProductos {
	
	// DECLARACI�N VARIABLES.
	private $dormitorio;
	private $salon;
	private $cocina;
	private $ba�o;
	private $exterior;
	private $todo;
	
	//CONSTRUCTOR
	/**
	 * El cat�logo de productos almacenar� los productos en arrays en funci�n de su categor�a.
	 * Dicho cat�logo empezar� con cada una de sus categor�as (arrays), vac�as.
	 * El obejto 'CatalogoProductos' podr� llamar a m�todos que permitan ver sus productos
	 * almacenar nuevos, eliminar y modificar.
	 */
	public function CatalogoProductos() {
		$this->__set("dormitorio", []);
		$this->__set("salon", []);
		$this->__set("cocina", []);
		$this->__set("ba�o", []);
		$this->__set("exterior", []);
		$this->__set("todo", []);
	}
	
	// M�TODOS
	
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
		foreach ($this->todo as $p) {
			if ($p->__get("codigo")==$CodProducto) {
				$existe=true;
				break;
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
		if ($this->esProducto($producto)) {
			$id_producto = $producto->__get("codigo");
			return $this->existeCod($id_producto);
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
	 * A�ade un producto al cat�logo, en su correspondiente array categor�a y en el array 'todo'
	 * @param object $producto -> Perteneciente a la Clase 'Producto'
	 * @return true: En caso de a�adir el producto con �xito
	 * 	       false: No a�adirlo debido a no tener las propiedades de la clase o tener un c�digo existente en el cat�logo.
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
        			$this->ba�o[]=$producto;
        			break;
        		case 5:
        			$this->exterior[]=$producto;
        			break;
			    default:
			        return false; // En caso de haber una categor�a diferente, la rechazo
			}
			return true;
		}
		else
			return false;		
	}
	
}