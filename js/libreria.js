/* Una vez se cargue todo el DOM, llamar a función 'ejecuta' */
window.onload=ejecuta;

/* FUNCIÓN EJECUTA */
	function ejecuta() {
		
		var botonDespliegue = document.getElementById("desplegable");
		if (botonDespliegue!=null)
			botonDespliegue.onclick= function() {
				var menu = document.getElementById("menu");
				menu.classList.toggle("menu_invisible");
					
			}
		
	}