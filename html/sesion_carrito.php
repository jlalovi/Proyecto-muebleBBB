<?php
function sesion_carritoIndex(){
	$devolver = <<<NAV
		<!-- PHP if privilegio de cliente/admin -->
		<div class="usuario_carrito right">
				<p class="usuario">
					<span class="bienvenido">Bienvenido/a <em>Usuario/a</em>.</span>
					<!-- Sino se ha iniciado sesión ni existe el POST  -->
					<span class="caja_inicia_sesion"><a id="inicia_sesion" class="inicia_sesion" href="#">Iniciar sesión</a></span>
					<a class="cierra_sesion" href="#">Cerrar sesión</a>
				</p>
				<!-- PHP if privilegio de cliente -->
				<a href="#" class="carrito"><span class="cantidad_pedidos">5</span><span class="icon fontawesome-shopping-cart"></span></a>
		</div>
		<div class="clear"></div>
			
		<div id="cuerpo_admin">
NAV;

	return $devolver;
}

function sesion_carritoAdmin(){
	$devolver = <<<NAV
		<div class="usuario_carrito right">
				<p class="usuario">
					<span class="bienvenido">Bienvenido/a <em>Usuario/a</em>.</span>
					<a class="cierra_sesion" href="#">Cerrar sesión</a>
				</p>
		</div>
		<div class="clear"></div>
		
		<div id="cuerpo_admin">
NAV;

	return $devolver;
}
?>