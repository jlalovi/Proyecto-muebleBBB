<?php
	class GestionaPLantilla {
		static $_plantilla;
		public static function Inicio_Plantilla($plantilla) {
			self::$_plantilla=$plantilla;
			ob_start("GestionaPlantilla::Render_Body");
		}
		public static function Render_Body($cadena) {
			$d=fopen(self::$_plantilla, "r");
			$datos=fread($d, filesize(self::$_plantilla));
			return str_replace("{{body}}", $cadena, $datos);
		}
		public static function Fin_Plantilla() {
			ob_flush();
		}
	}
?>