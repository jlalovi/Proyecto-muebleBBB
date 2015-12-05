<?php

function encabezadoIndex() {
	$devolver = <<<ENCABEZADO
		<header>
			<div class="left logo">
				<a href="inicio.php"><img alt="logotipo MuebleBBB S.L" src="../imagenes/LogoMuebleBBB.png"></a>
			</div>
			<div class="right cabecera_secundaria">
				<div class="social right">
					<a class="icon facebook" href="#"><span class="fontawesome-facebook-sign"></span></a>
					<a class="icon twitter" href="#"><span class="fontawesome-twitter-sign"></span></a>
				</div>
			</div>
			<div class="clear"></div>
		</header>
ENCABEZADO;

	return $devolver;
}

function encabezadoAdmin() {
	$devolver = <<<ENCABEZADO
		<header>
			<div class="left logo">
				<a href="inicio.php"><img alt="logotipo MuebleBBB S.L" src="../imagenes/LogoMuebleBBB.png"></a>
			</div>
			<h1 class="left titulo_admin">ADMINISTRACIÓN</h1>
			<div class="clear"></div>
		</header>
ENCABEZADO;

	return $devolver;
}

?>