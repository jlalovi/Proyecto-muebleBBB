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
		
		var CheckBoxBorrarProd = document.getElementById("borrarProductoCB");
		if (CheckBoxBorrarProd!=null) {
			CheckBoxBorrarProd.onchange = function() {
				if (CheckBoxBorrarProd.checked)
					alert("Desmarca la casilla si NO deseas borrar el producto al presionar 'Modificar'.");
			}
		}
		
		var CheckBoxBorrarCat = document.getElementById("borrarCategoriaCB");
		if (CheckBoxBorrarCat!=null) {
			CheckBoxBorrarCat.onchange = function() {
				var nuevoNombreCat = document.getElementById("nombreModificarCategoria");
				if (CheckBoxBorrarCat.checked) {
					nuevoNombreCat.setAttribute("class", "invisible");
					nuevoNombreCat.value="borrar";
					alert("Desmarca la casilla si NO deseas borrar la categoria al presionar 'Modificar'.");
				}
				else {
					nuevoNombreCat.value="";
					nuevoNombreCat.setAttribute("class", "visible_inline");
				}
					
			}
		}
	}