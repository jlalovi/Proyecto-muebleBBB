<?php

/**
 * Clase Producto de muebleBBB
 * 
 * @author Javier
 */
class Producto {
	
	// DECLARACIÓN VARIABLES.
	private $codigo;
	private $nombre;
	private $categoria;
	private $precio;
	private $descuento;
	private $nuevo;
	private $caracteristicas;
	private $imagen;
	
	//CONSTRUCTOR
	
	/**
	 * Objeto producto para la página muebleBBB
	 * @param string $codigo -> ID del producto 
	 * @param string $nombre -> Nombre del producto VARCHAR(20)
	 * @param string $categoria -> 1=Dormitorio | 2=Salón | 3=Cocina | 4=Baño | 5=Exterior
	 * @param string $precio -> DECIMAL(6, 2)
	 * @param string $descuento -> DECIMAL(2, 2)
	 * @param string $nuevo -> 1: Novedad - 0: No novedad
	 * @param string $caracteristicas -> VARCHAR(200)
	 * @param string $imagen -> string de la ruta
	 */
	public function Producto($codigo="", $nombre="", $categoria="", $precio="", $descuento="", $nuevo="", $caracteristicas="", $imagen="../imagenes/image_placeholder.png" ) {
		$this->__set("codigo", $codigo);
		$this->__set("nombre", $nombre);
		$this->__set("categoria", $categoria);
		$this->__set("precio", $precio);
		$this->__set("descuento", $descuento);
		$this->__set("nuevo", $nuevo);
		$this->__set("caracteristicas", $caracteristicas);
		$this->__set("imagen", $imagen);
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
	public function toString() {
		return "";
	}

}


?>