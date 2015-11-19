<?php

	/**
	 * Comprueba si se ha cargado alguna imagen en el formulario guardándola en caso afirmativo en el servidor
	 * y devolviendo la ruta de donde está almacenada y en caso negativo, devuelve una ruta con la imagen establecida
	 * por defecto (la llamada imagen X).
	 *
	 * @param object $imagen -> Objeto de tipo $_FILES, que se espera ser una imagen
	 * @param string $codigo -> Código del producto de la imagen en cuestión
	 * @param bool $crear_producto -> false: si no es un nuevo producto - true: En caso de ser un producto nuevo
	 */
	function cargarImagen($imagen, $codigo, $crear_producto=false) {
		// Si la imagen no se ha subido y...
		if ($imagen["imagen"]["name"]=="") {
			if ($crear_producto) { // ... en caso de ser un producto nuevo, le añado una ruta por defecto a la imagen X.
				$img = "../imagenes/image_placeholder.png";
			}
			else return false;
	
		}
		// En caso de que sí se haya subido, compruebo si es de formato .jpg o .png, la guardo en el servidor y creo una variable $img con su ruta.
		else if (preg_match("/\w+[.](jpg|png)$/", $imagen['imagen']['name'])) {
	
			$temporal=$imagen['imagen']['tmp_name'];
	
			// Todas mis imágenes de muebles quiero que empiecen por '_ID', seguido de su código, un '-' y el nombre de la imagen.
			$img="../imagenes/_ID".$codigo."-".$imagen['imagen']['name'];
	
			if(move_uploaded_file($temporal, $img)) { // En caso de que se haya subido la imagen correctamente:
				echo Html::p("Y la imagen nueva se ha guardado con éxito en $img.");
			}
			else { // Sino se ha subido la imagen correctamente al servidor
				$img = "../imagenes/image_placeholder.png";
				echo Html::p("Pero la imagen NO se ha cargado con éxito, por lo que se utilizará la imagen X por defecto en $img.", "error");
			}
		}
			
		else { // En caso de no ser un archivo de extensión .jpg o .png
			$img = "../imagenes/image_placeholder.png";
			echo Html::p("Pero la imagen NO es de formato .jpg o .png, por lo que se utilizará una imagen vacía por defecto.", "error");
			echo Html::p("Asegúrate de modificar la imagen de este producto a una válida.", "error");
		}			
		return $img;
	}
	
	/**
	 * Comprueba que el valor introducido se encuentra entre el rango de $min y $max
	 * @param unknown $valor
	 * @param unknown $min
	 * @param unknown $max
	 * @return boolean
	 */
	function validarRango($valor, $min, $max) {
		if(!is_numeric($valor) || $valor>$max || $valor<$min) {
			echo Html::p("El valor '$valor' no comprende entre entre el rango de $min y $max.", "error");
			return false;
		}
		return true;
	}
	
	/**
	 * Comprueba que el texto introducido tiene un número de caracteres entre $min y $max
	 * @param string $texto
	 * @param unknown $max
	 * @param number $min
	 * @return boolean
	 */
	function validarNumCar($texto, $max, $min=1) {
		if(!is_string($texto) || strlen($texto)>$max || strlen($texto)<$min) {
			echo Html::p("El contenido '$texto' no contiene entre $min y $max caracteres.", "error");
			return false;
		}
		return true;
	}
	
?>