<?php

class GestionaPlantilla
{
	static $_varsget;
	
	public static function Inicio_Plantilla($plantilla)
	{
		self::CreaVariablesSesion();
		var_dump(session_id());
		$aux=self::$_varsget;
		exec("php -f $plantilla $aux > ./datos.txt");
		ob_start("GestionaPlantilla::Render_Body");
	}
	public static function Render_Body($cadena)
	{
		$d=fopen("./datos.txt", "r");
		$datos=fread($d, filesize("./datos.txt"));
		return str_replace("{{body}}", $cadena, $datos);
	}
	
	public static function Fin_Plantilla()
	{
		ob_flush();
	}
	
	private static function  CreaVariablesSesion()
	{
		$vars=NULL;
		$i=1;
		foreach ($_SESSION as $clave=>$valor)
		{
			if($i<count($_SESSION))
			{
				$vars=$vars.$clave." ".$valor."&";
			}
			else 
			{
				$vars=$vars.$clave." ".$valor;
			}
			$i++;
		}
		self::$_varsget=$vars;
	}
}
?>


<?php
/*
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
*/
?>