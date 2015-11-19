<?php
	/**
	 * Clase MySQLDataBase para manipular una BBDD de MySQL desde PHP.
	 * @author Javier Latorre - jlalovi@gmail.com
	 */
	class MySQLDataBase {
		
		private $conexion_mysql; // Objeto de la clase 'PDO'
		
		/**
		 * Crea un objeto MySQLDataBase, que tiene acceso a la BBDD mysql indicada en los parámetros y en el cuál se pueden
		 * hacer modificaciones a través de métodos propios.
		 * @param string $nombreBBDD -> Nombre de la BBDD (en el testeo me he bajado una pública denominada "northwind")
		 * @param string $host -> Por defecto dejo el localhost:3306 que es la utilizada por defecto en MySQL.
		 * @param string $user -> Tu nombre de usuario en MySQL. Por defecto, dejo "root" que es el que viene al instalar MySQL
		 * @param string $password -> Si es que se ha configurado un password, en este parámetro se debería incluir, sino, dejar en blanco.
		 */
		public function MySQLDataBase($nombreBBDD="", $host="localhost:3306", $user="root", $password="") {				
			$dsn= "mysql:host=$host;dbname=$nombreBBDD";			
			try { 
				if ($password!="")
					$this->conexion_mysql=new PDO("$dsn", "$user", "$password");
				else // Caso de que no se haya introducido password
					$this->conexion_mysql=new PDO("$dsn", "$user");					
				$this->conexion_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para registrar  errores con mysql (php se come muchos)
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Devuelve una matriz de la consulta realizada en la base de datos. El primer array hace referencia a la fila y
		 * el segundo a la columna, es decir, el primer array contendrá cada objeto que coincide con los criterios de la consulta,
		 * y el segundo array el valor de las propiedades de cada uno de esos objetos.
		 * @param string $sentenciaSQL -> Query de tipo SELECT que debe ser escrito por completo.
		 * @param string $asociativo -> (Opcional) El array de columnas puede estar identificado por índices numéricos o por valores asociativos.
		 * @return matrix -> array(array())
		 */
		public function ConsultarQ($sentenciaSQL="", $asociativo=false){
			try {
				$datos = $this->conexion_mysql->query("$sentenciaSQL");
				if ($asociativo)
					return $datos->fetchAll(PDO::FETCH_ASSOC);
				else
					return $datos->fetchAll(PDO::FETCH_NUM);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Versión simplificada de consultar en la base de datos.
		 * @param string $tabla -> (Obligatorio) Nombre de la tabla que se quiere consultar
		 * @param string $prop -> (Opcional) Propiedad o propiedades (separadas por comas), que se se quieren consultar de la tabla. Por defecto "*" = todas las propiedades.
		 * @param string $cond -> (Opcional) Otras condiciones como JOIN, WHERE, etc. Para esto se necesita un conocimiento más avanzado de MySQL.
		 * @param string $asociativo -> (Opcional) El array de columnas puede estar identificado por índices numéricos o por valores asociativos.
		 * @return matrix -> array(array())
		 */
		public function Consultar($tabla="", $prop="*", $cond="" , $asociativo=false){
			$sentenciaSQL="SELECT $prop FROM $tabla $cond";
			return $this->ConsultarQ($sentenciaSQL, $asociativo);
		}
		
		/**
		 * Modifica la BBDD por medio de las sentencias compatibles con MySQL como INSERT, UPDATE, DELETE, CREATE, DROP, etc. 
		 * Habrá que escribir la sentencia completa como parámetro, y en caso de que haya un error, aparecerá por pantalla una 
		 * vez ejecutado la sentencia en el navegador.
		 * <p> Este método es el más flexible, pero también el que necesita de más conocimiento en MySQL para la manipulación
		 * de BBDD.
		 * 
		 * @param string $sentenciaSQL -> Sentencia completa de MySQL
		 */
		public function Modificar($sentenciaSQL="") {
			try {
				$this->conexion_mysql->query("$sentenciaSQL");
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Inserta un una nueva fila (propiedades y valores) de la tabla especificada.
		 * @param string $tabla -> Tabla existente en la BBDD.
		 * @param string $propiedades -> separadas por comas. El orden de las propiedades debe corresponderse con el orden de valores en el siguiente parámetro.
		 * @param string $valores -> separados por comas y con comillas simples '' cada valor que sea una cadena.
		 */
		public function InsertInto($tabla="", $propiedades="", $valores="") {
			$sentenciaSQL="INSERT INTO $tabla ($propiedades) VALUES ($valores)";
			$this->Modificar($sentenciaSQL);
		}
		
		/**
		 * Actualiza el valor de una o más propiedades en función de la condición especificada.
		 * <p> Ej. "UPDATE productos SET nombre='armario' WHERE codigo=80" se representaría así:
		 * <li> Update("productos", "nombre", "armario", true, "codigo=80")
		 * @param string $tabla -> Tabla existente en la BBDD.
		 * @param string $propiedad ->
		 * @param string $nuevo_valor -> Indicarlo entre comillas simples '' si se trata de una cadena.
		 * @param string $condicion -> Condición que la fila/s debe cumplir para actualizarse
		 */
		public function Update($tabla="", $propiedad="", $nuevo_valor="", $condicion="") {
			$sentenciaSQL="UPDATE $tabla SET $propiedad=$nuevo_valor WHERE $condicion";
			$this->Modificar($sentenciaSQL);
		}
		
		/**
		 * Borra una fila o filas de una tabla en función de la condición especificada.
		 * @param string $tabla -> Tabla existente en la BBDD.
		 * @param string $condicion -> Condición que la fila/s debe cumplir para borrarse. (Ej. codigo=1)
		 */
		public function DeleteFrom($tabla="", $condicion="") {
			$sentenciaSQL="DELETE FROM $tabla WHERE $condicion";
			$this->Modificar($sentenciaSQL);
		}
		
	}
?>

