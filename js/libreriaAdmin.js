/* Una vez se cargue todo el DOM, llamar a función 'ejecuta' */
window.onload=ejecuta;

/* FUNCIÓN EJECUTA */
	function ejecuta() {
		
		var tipoProducto = document.getElementById("tipo_producto");
		if (tipoProducto!=null) {
			tipoProducto.onchange= function() {
				var seleccionado = tipoProducto.value;
				var boqueDescuento = document.getElementById("bloque_descuento");
				if ("oferta".localeCompare(tipoProducto.value)===0) {
					boqueDescuento.setAttribute("class", "visible_inline");
				}
				else {
					var descuento = document.getElementById("descuento");
					boqueDescuento.setAttribute("class", "invisible");
					descuento.value="0";
				}		
			}
		}
		
		var CheckBoxBorrar = document.getElementById("borrarProductoCB");
		if (CheckBoxBorrar!=null) {
			CheckBoxBorrar.onchange = function() {
				if (borrarProductoCB.checked)
					alert("Desmarca la casilla si NO deseas borrar el producto al presionar 'Guardar cambios'.");
			}
		}
	}