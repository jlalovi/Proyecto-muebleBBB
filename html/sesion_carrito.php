<?php
 
/**
 * Contenido relativo a la sesión y al carrito de compra.
 * @param string $sesion -> Variable $SESION
 * @param bool $invisible -> Indica si no se ven o se ven los campos de inicio de sesión al refrescar la página.
 * @param string $error_usuario -> Muestra el error de 'Nombre de usuario incorrecto'
 * @param string $error_password -> Muestra el error de 'Contraseña incorrecta'
 */
function sesion_carritoIndex($sesion="", $invisible=true, $error_usuario=false, $error_password=false) {
	
	if ($sesion=="") {
		$clase_mostrar = $invisible?"invisible":"";
		$fondo_iniciar = $invisible?"":"fondo_onclick";
		$clase_mostrar_error_usuario = $error_usuario?"":"hidden";
		$clase_mostrar_error_pass = $error_password?"":"hidden";
		
		$devolver = <<<NAV
			<div class="usuario_carrito right">
					<div class="usuario">
						<div class="caja_inicia_sesion">
							<a id="inicia_sesion" class="inicia_sesion $fondo_iniciar" href="#">Iniciar sesión</a>
							<div id="desplegable_inicia_sesion" class="desplegable_inicia_sesion $clase_mostrar">
								<form action="" method="POST">
									<input type="text" name="usuario" id="inicio_usuario" placeholder="Usuario" required="required" />
									<span class="error_usuario $clase_mostrar_error_usuario">* Nombre de usuario incorrecto.</span>
									<input type="password" name="password" id="inicio_password" placeholder="Contraseña" required="required" />
									<span class="error_password $clase_mostrar_error_pass">* Contraseña incorrecta.</span>
									<input type="submit" value="Aceptar" id="comprobar_inicio_sesion" />
								</form>
							</div>
						</div>
					</div>
			</div>
			<div class="clear"></div>
			<div id="cuerpo">
NAV;
	}
	
	else {
		
		if (isset($sesion["cliente"]) && $sesion["cliente"]==true)
			$cliente='<a href="carrito.php" class="carrito"><span class="cantidad_pedidos">5</span><span class="icon fontawesome-shopping-cart"></span></a>';
		else
			$cliente="";
		
		$devolver = <<<NAV
			<div class="usuario_carrito right">
					<p class="usuario">
						<span class="bienvenido">¡Bienvenido/a, <em>{$sesion["usuario"]}</em>!</span>
						<a class="cierra_sesion" href="cerrarsesion.php">Cerrar sesión</a>
					</p>
					$cliente					
			</div>
			<div class="clear"></div>
				
			<div id="cuerpo">
NAV;
	}

	return $devolver;
}

function sesion_carritoAdmin($sesion){
	$devolver = <<<NAV
		<div class="usuario_carrito right">
				<p class="usuario">
					<span class="bienvenido">¡Bienvenido/a <em>{$sesion["usuario"]}</em>!</span>
					<a class="cierra_sesion" href="cerrarsesion.php">Cerrar sesión</a>
				</p>
		</div>
		<div class="clear"></div>
		
		<div id="cuerpo_admin">
NAV;

	return $devolver;
}
?>