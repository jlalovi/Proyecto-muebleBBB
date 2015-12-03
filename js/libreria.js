/* Una vez se cargue todo el DOM, llamar a función 'ejecuta' */
window.onload=ejecuta;

/* FUNCIÓN EJECUTA */
	function ejecuta() {
		
		// Botón de despliegue del menú en pantallas estrechas.
		var botonDespliegue = document.getElementById("desplegable");
		if (botonDespliegue!=null) {
			botonDespliegue.onclick= function() {
				var menu = document.getElementById("menu");
				menu.classList.toggle("menu_invisible");					
			}
		}
		
		// Selector de productos en catálogo.php
		var selectorProductos = document.getElementById("seleccionar_producto");
		if (selectorProductos!=null) {
			selectorProductos.onchange= function() {
				var id_producto = selectorProductos.selectedOptions[0].value;
				var producto = document.getElementById("id_"+id_producto);
				if (document.getElementsByClassName("contendor_producto_detallado visible_inline")[0])
					document.getElementsByClassName("contendor_producto_detallado visible_inline")[0].className="contendor_producto_detallado invisible";	
				producto.className="contendor_producto_detallado visible_inline";					
			}
		}
		// En caso de $_GET en catálogo.php
		if (selectorProductos!=null) {
			if (selectorProductos.selectedIndex!=-1) {
				var id_producto = selectorProductos.selectedOptions[0].value;
				var producto = document.getElementById("id_"+id_producto);
				producto.className="contendor_producto_detallado visible_inline";
				history.pushState("", "mueblesBBB", "catalogo.php");
			}
		}
	}