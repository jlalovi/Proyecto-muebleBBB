<?php
function pie(){
	$devolver = <<<PIE
	</div>
	<div class="clear"></div>
	
	<footer>
		<p class="left elementos_pie">Copyright © MuebleBBB S.L. Desarrollado por <a href="http://codepen.io/jlalovi/" target="_blank">jlalovi</a></p>
		<p class="right elementos_pie"><a href="mapa_sitio.php">Mapa del sitio</a></p>
		<p class="right elementos_pie"><a href="aviso_legal.php">Aviso legal</a>, <a href="politica_privacidad.php">Política de privacidad</a> y de <a href="cookies.php">Cookies</a></p>
	</footer>
PIE;

	return $devolver;
}
?>