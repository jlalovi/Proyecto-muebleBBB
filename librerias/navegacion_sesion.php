<?php

/**
 * Genera el HTML de la barra de navegación, del inicio de sesión y del carrito en función de los datos enviados
 * (o NO enviados) por $_POST en el formulario de iniciar sesión.
 * 
 * @param array $post -> $_POST
 * @param object $MuebleBBB -> Objeto de tipo 'BBDDMuebleBBB'
 */
function navegacion_sesion($post, $MuebleBBB) {
	$error_usuario =false;
	$error_pass = false;
	$desplegable_invisible = true;
	if (!empty($post) && isset($post["usuario"])) {
		$inicio_sesion = $MuebleBBB->existeUsuario($post["usuario"], $post["password"]);
		if ($inicio_sesion[0]==true && $inicio_sesion[1]==true) {
			$_SESSION["usuario"]="{$post["usuario"]}";
			$_SESSION["admin"]=$inicio_sesion[2];
			$_SESSION["cliente"]=$inicio_sesion[3];
			// var_dump($_SESSION);
		}
		else if ($inicio_sesion[0]==false) {
			$error_usuario = true;
			$desplegable_invisible = false;
		}
		else if ($inicio_sesion[1]==false) {
			$error_pass = true;
			$desplegable_invisible = false;
		}
	}
	
	if (isset($_SESSION["usuario"])) {
		echo navIndex($_SESSION);
		echo sesion_carritoIndex($_SESSION);
	}
	else { // No se ha iniciado sesión con el usuario que se acaba de indicar
		echo navIndex();
		echo sesion_carritoIndex("",$desplegable_invisible, $error_usuario, $error_pass);
	}
}
?>