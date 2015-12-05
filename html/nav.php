<?php
function navIndex(){ 
	$devolver = <<<NAV
		<nav class="nav">
			<a id="desplegable" href="#"><span class="fontawesome-reorder "></span></a>
			<ul id="menu" class="menu_invisible">
				<li><a href='inicio.php'>Inicio</a></li>
				<li><a href='catalogo.php'>Catálogo</a></li>
				<li><a href='quienes_somos.php'>Quiénes somos</a></li>
				<li><a href='contacto.php'>Contacto</a></li>
				<!-- PHP if privilegio de admin -->
				<li><a href='admin.php'>Administración</a></li>
			</ul>
			<form class="buscador right" action="resultados_busqueda.php" method="post">
				<input class="texto_busqueda" type="text" id="busca" name="busca" value="" size="15"/>
				<input class="invisible" type="submit" value="enviar">
				<span class="lupa fontawesome-search"></span>
			</form>
			<div class="clear"></div>
		</nav>
NAV;

	return $devolver;
}
	
function navAdmin(){
	$devolver = <<<NAV
		<nav class="nav">
			<ul>
				<li><a href='inicio.php'>Inicio</a></li>
				<li><a href='admin.php'>Administración</a></li>
			</ul>
			<div class="clear"></div>
		</nav>
NAV;
	
	return $devolver;
}
?>