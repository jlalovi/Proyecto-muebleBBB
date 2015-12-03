<?php
	/**
	 * Esta clase genera lenguaje HTML a trav�s de funciones est�ticas que representan las etiquetas posibles en
	 * este lenguaje de marcas.
	 * 
	 * Por cuestiones de limpieza y orden a la hora de inspeccionar el HTML generado, despu�s de cada devoluci�n de cadena
	 * realizo un salto de l�nea. Adem�s, he a�adido la funci�n 'tab($n)' para sangrar dichas l�neas de HTML y hacer un c�digo
	 * mucho m�s limpio y ordenado.
	 * 
	 * Estos m�todos est�ticos Html me devuelven cadenas, por lo que al llamar a las funciones para crear el HTML, s�lo tengo
	 * que hacer un 'echo' y concatenar cada una de las llamadas con puntos '.' y cerrando la �ltima sentencia con el ';'.
	 * 
	 * @author Javier Latorre -> jlalovi@gmail.com
	 *
	 */
	class Html {
		/**
		 * Funci�n para devolver una cadena de atributos comunes en las diferentes etiquetas, en funci�n de los que el usuario
		 * haya pasado por par�metro al utilizar los m�todos est�ticos de la clase Html. A esta se accede desde la clase
		 * para comprobar si se han introducido par�metros o no, y evitar por tanto que en caso de haber par�metros vac�os "",
		 * aparezca dicho par�metro sin valor en las etiquetas generadas de HTML.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		private static function atributosComunes($class="", $id="",$otros_atributos="") {
			$atributos = "";
				
			if ($class!="")	$atributos.="class='{$class}' ";
			if ($id!="") $atributos.="id='{$id}' ";
			if ($otros_atributos!="") $atributos.=$otros_atributos;
			
			return $atributos;
		}

		/*********************************************************************************************************
		 *
		 * ETIQUETAS ESPECIALES
		 *
		 *********************************************************************************************************/		
		
		/**
		 * Funci�n para tabular o sangrar el c�digo HTML por cuestiones de limpieza y orden.
		 * Las tabulaciones son de dos espacios por tabulaci�n.
		 * 
		 * @param number $n -> n�mero de tabulaciones (por defecto 1)
		 */
		public static function tab($n=1) {
			$tabs="";
			for ($i=0; $i<$n; $i++)
				$tabs.="    "; // Al ser las tabulaciones '\t' tan grandes, las realizo manualmente con 4 espacios.
			return $tabs;
		}
		
		/*********************************************************************************************************
		 * 
		 * ETIQUETAS PRINCIPALES
		 * 
		 *********************************************************************************************************/
		
		/**
		 * Etiqueta DOCTYPE para HTML5
		 */
		public static function doctype() { //Puedo mejorar esto pasando por par�metro el tipo de DOCTYPE y dejar por defecto el de HTML5
			return "<!DOCTYPE html>";
		}
		/**
		 * Etiqueta de apertura de &lt;html>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 */
		public static function html_() { 
			return "<html>"."\n";
		}
		/**
		 * Etiqueta de cierre de &lt;/html>
		 * El gui�n bajo del principio lo utilizo como indicador de que se trata de un cierre de etiqueta correspondiente.
		 */
		public static function _html() { 
			return "</html>";
		}
		/**
		 * Etiqueta de apertura de &lt;head>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 */
		public static function head_() { 
			return "<head>"."\n";
		}
		/**
		 * Etiqueta de cierre de &lt;/head>
		 * El gui�n bajo del principio lo utilizo como indicador de que se trata de un cierre de etiqueta correspondiente.
		 */
		public static function _head() {
			return "</head>"."\n";
		}
		/**
		 * Etiqueta &lt;title>&lt;/title>
		 */
		public static function title($titulo="") {
			return "<title>$titulo</title>"."\n";
		}
		/**
		 * Etiqueta &lt;meta />
		 * En el par�metro se le pasar� una cadena con el/los atributo/s que tendr� el meta. Sino se introduce nada, 
		 * por defecto tendr� el valor de charset='ISO-8859-1', porque considero que es el m�s utilizado (al menos para m�)
		 * 
		 * Ejemplos de valores para meta:
		 * <p>&lt;meta name="author" content="Juan P�rez" />: Define el autor del documento.
		 * <p>&lt;meta name="generator" content="WordPress 2.8.4" />: Definir el programa con el que se ha creado.
		 * <p>&lt;meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />: Definir la codificaci�n de caracteres del documento.
		 * <p>&lt;meta name="copyright" content="librosweb.es" />: Definir el copyright del documento.
		 * <p>&lt;meta name="robots" content="index, follow" />: Definir el comportamiento de los buscadores.
		 * <p>&lt;meta name="keywords" content="dise�o, css, hojas de estilos, web, html" />: Definir las palabras clave que definen el contenido del documento.
		 * <p>&lt;meta name="description" content="Art�culos sobre dise�o web, usabilidad y accesibilidad" />: Definir una breve descripci�n del sitio.
		 */
		public static function meta($atributos="charset='ISO-8859-1'") {
			return "<meta $atributos/>"."\n";
		}
		/**
		 * Etiqueta &lt;link />
		 * Por defecto se genrar� un link de CSS que apunta a un archivo de la siguiente ruta 'css/estilos.css', por ser por mi parte
		 * el link m�s frecuente de uso personal.
		 *
		 * @Link http://www.w3schools.com/tags/tag_link.asp
		 * @param string $rel
		 * @param string $type
		 * @param string $href
		 * @param string $otros_atributos -> Este par�metro est� reservado para otro tipo de atributos como 'media' o 'target'
		 */
		public static function link($otros_atributos="", $href="css/estilos.css", $rel="stylesheet", $type="text/css") {
			return "<link href=$href rel=$rel type=$type $otros_atributos/>"."\n";
		}
		/**
		 * Etiqueta de apertura de &lt;body>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 */
		public static function body_() { 
			return "<body>"."\n";
		}
		/**
		 * Etiqueta de cierre de &lt;/body>
		 * El gui�n bajo del principio lo utilizo como indicador de que se trata de un cierre de etiqueta correspondiente.
		 */
		public static function _body() {
			return "</body>"."\n";
		}
		
		/*********************************************************************************************************
		 *
		 * ETIQUETAS DE TEXTO
		 *
		 *********************************************************************************************************/	
		
		/**
		 * Etiqueta p�rrafo &lt;p>&lt;/p>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function p($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<p {$atributos}>{$contenido}</p>"."\n";
			else
				return "<p>{$contenido}</p>"."\n";
		}
		/**
		 * Etiqueta de apertura de &lt;p>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function p_($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
				
			if ($atributos!="")
				return "<p {$atributos}>{$contenido}";
			else
				return "<p>{$contenido}";
		}
		/**
		 * Etiqueta de cierre de &lt;/p>
		 */
		public static function _p() {
			return "</p>"."\n";
		}
		/**
		 * Etiqueta secci�n &lt;h1>&lt;/h1> &lt;h2>&lt;/h2> &lt;h3>&lt;/h3> &lt;h4>&lt;/h4> &lt;h5>&lt;/h5> &lt;h6>&lt;/h6>
		 * @param number $seccion -> Grado de la secci�n (del &lt;h1> al &lt;h6>, siendo por defecto 1).
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function seccion($seccion=1, $contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			
			switch ($seccion) {
				case 1:
					if ($atributos!="")
						return "<h1 {$atributos}>{$contenido}</h1>"."\n";
					else
						return "<h1>{$contenido}</h1>"."\n";
					break;
				case 2:
					if ($atributos!="")
						return "<h2 {$atributos}>{$contenido}</h2>"."\n";
					else
						return "<h2>{$contenido}</h2>"."\n";
					break;
				case 3:
					if ($atributos!="")
						return "<h3 {$atributos}>{$contenido}</h3>"."\n";
					else
						return "<h3>{$contenido}</h3>"."\n";
					break;
				case 4:
					if ($atributos!="")
						return "<h4 {$atributos}>{$contenido}</h4>"."\n";
					else
						return "<h4>{$contenido}</h4>"."\n";
					break;
				case 5:
					if ($atributos!="")
						return "<h5 {$atributos}>{$contenido}</h5>"."\n";
					else
						return "<h5>{$contenido}</h5>"."\n";
					break;
				case 6:
					if ($atributos!="")
						return "<h6 {$atributos}>{$contenido}</h6>"."\n";
					else
						return "<h6>{$contenido}</h6>"."\n";
					break;
				default: // Por defecto la secci�n ser� un <h1></h1>
					if ($atributos!="")
						return "<h1 {$atributos}>{$contenido}</h1>"."\n";
					else
						return "<h1>{$contenido}</h1>"."\n";
			}
		}
		
		/**
		 * Etiqueta resaltar &lt;strong>&lt;/strong>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function strong($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			
			if ($atributos!="")
				return "<strong {$atributos}>{$contenido}</strong>";
			else
				return "<strong>{$contenido}</strong>";
		}
		/**
		 * Etiqueta resaltar &lt;em>&lt;/em>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function em($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
				
			if ($atributos!="")
				return "<em {$atributos}>{$contenido}</em>";
			else
				return "<em>{$contenido}</em>";
		}
		/**
		 * Etiqueta tachar &lt;del>&lt;/del>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function del($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<del {$atributos}>{$contenido}</del>";
			else
				return "<del>{$contenido}</del>";
		}
		/**
		 * Etiqueta sub�ndice &lt;sub>&lt;/sub>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function sub($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<sub {$atributos}>{$contenido}</sub>";
			else
				return "<sub>{$contenido}</sub>";
		}
		/**
		 * Etiqueta super�ndice &lt;sup>&lt;/sup>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function sup($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<sup {$atributos}>{$contenido}</sup>";
			else
				return "<sup>{$contenido}</sup>";
		}

		/*********************************************************************************************************
		 *
		 * ETIQUETAS DE SALTOS DE L�NEA
		 *
		 *********************************************************************************************************/
		
		/**
		 * Etiqueta salto de l�nea &lt;br />
		 */
		public static function br() {
			return "<br/>"."\n";
		}
		
		/**
		 * Etiqueta salto de l�nea &lt;br />
		 */
		public static function hr() {
			return "<hr/>"."\n";
		}
		
		/*********************************************************************************************************
		 *
		 * ETIQUETAS DE ENLACES
		 *
		 *********************************************************************************************************/		
		
		/**
		 * Etiqueta enlace &lt;a>&lt;/a>
		 * NOTA: esta funci�n no retorna un salto de l�nea. Su hom�loga con apertura y cierre, s�.
		 * @param string $href -> URL del enlace. Sino se declara, incluso si se declara como "", su valor ser� '#'.
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos
		 */
		public static function a($contenido="", $href="#",  $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($href=="") $href="#";
			
			if ($atributos!="")	
				return "<a href='{$href}' {$atributos}>{$contenido}</a>";
			else 
				return "<a href='{$href}'>{$contenido}</a>";
			
		}
		/**
		 * Etiqueta de apertura &lt;a>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $href -> URL del enlace.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos
		 */
		public static function a_($href="#", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($href=="") $href="#";
			
			if ($atributos!="")
				return "<a href='{$href}' {$atributos}>";
			else
				return "<a href='{$href}'>";
		}
		/**
		 * Etiqueta de cierre &lt;/a>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura. 
		 */
		public static function _a(){
			return "</a>"."\n";
		}
		
		/*********************************************************************************************************
		 *
		 * ETIQUETAS DE LISTAS
		 *
		 *********************************************************************************************************/
		
		/**
		 * Etiqueta de apertura &lt;ol>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param number $start -> Por defecto empezar� a contar por 1.
		 * @param string $otros_atributos
		 */
		public static function ol_($class="", $id="", $start="1", $otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($start=="") $start.="1";
			
			$atributos.="start={$start} ";
			
			return "<ol $atributos>"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/ol>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _ol() {
			return "</ol>"."\n";
		}
		/**
		 * Etiqueta de apertura &lt;ul>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param number $type -> Por defecto indicar� que el tipo de marcador es 'disc'. Tambi�n se pueden son v�lidos: 'circle' y 'square'
		 * @param string $otros_atributos
		 */
		public static function ul_($class="", $id="", $type="disc", $otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($type!="") $type.="disc";
			if ($type!="circle") if ($type!="square") $type.="disc";
			
			$atributos.="type={$type} ";
				
			return "<ul $atributos>"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/ul>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _ul() {
			return "</ul>"."\n";
		}
		/**
		 * Etiqueta de apertura &lt;li>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $contenido
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function li_($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
				
			if ($atributos!="")
				return "<li $atributos>$contenido";
			else
				return "<li>$contenido";
		}
		/**
		 * Etiqueta de cierre &lt;/li>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _li() {
			return "</li>"."\n";
		}
		/**
		 * Etiqueta de lista &lt;li>&lt;/li>
		 * @param string $contenido
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function li($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<li $atributos>$contenido</li>"."\n";
			else
				return "<li>$contenido</li>"."\n";
		}
		
		/*********************************************************************************************************
		 *
		 * ETIQUETAS 'WRAPERS'
		 *
		 *********************************************************************************************************/
		
		/**
		 * Etiqueta span &lt;span>&lt;/span>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function span($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<span {$atributos}>{$contenido}</span>";
			else
				return "<span>{$contenido}</span>";
		}
		
		/**
		 * Etiqueta de apertura &lt;div>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function div_($class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			
			if ($atributos!="")
				return "<div $atributos>"."\n";
			else
				return "<div>"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/div>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _div() {
			return "</div>"."\n";
		}
		
		/**
		 * Etiqueta de apertura &lt;details>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function details_($class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
				
			if ($atributos!="")
				return "<details $atributos>"."\n";
			else
				return "<details>"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/details>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _details() {
			return "</details>"."\n";
		}
		
		/**
		 * Etiqueta summary &lt;summary>&lt;/summary>
		 * @param string $contenido -> Contenido dentro de la etiqueta.
		 * @param string $class -> Clase de la etiqueta.
		 * @param string $id -> Id de la etiqueta.
		 * @param string $otros_atributos -> Otros atributos de etiqueta que se quieran a�adir manualmente.
		 */
		public static function summary($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<summary {$atributos}>{$contenido}</summary>";
			else
				return "<summary>{$contenido}</summary>";
		}		

		/*********************************************************************************************************
		 *
		 * ETIQUETAS IMAGEN
		 *
		 *********************************************************************************************************/		
		
		/**
		 * Etiqueta de cierre &lt;img />
		 * @param string $src
		 * @param string $alt
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function img($src="#", $alt="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			
			if ($src!="") $atributos.="src ='$src' ";
			if ($alt!="") $atributos.="alt ='$alt' ";
			
			if ($atributos!="")
				return "<img $atributos/>"."\n";
			else
				return "<img/>"."\n";
		}

		/*********************************************************************************************************
		 *
		 * ETIQUETAS DE TABLA
		 *
		 *********************************************************************************************************/
		
		/**
		 * Etiqueta de apertura &lt;table>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function table_($class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
				
			if ($atributos!="")
				return "<table $atributos>"."\n";
			else
				return "<table>"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/table>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _table() {
			return "</table>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;caption>&lt;/caption>
		 * @param string $contenido
		 */
		public static function caption($contenido="") {
			return "<caption>$contenido</caption>"."\n";
		}
		
		/**
		 * Crea un encabezado de tabla a partir de los datos pasados por par�metro. Los atributos a�adidos formar�n parte de la etiqueta &lt;tr>
		 * @param array $datos_fila -> contiene los datos del encabezado, de izquierda a derecha
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function trTh($datos_fila=[], $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			$encabezado ="";
			 foreach ($datos_fila as $th) {
			 	$encabezado.="<th>$th</th>";
			 }
						
			if ($atributos!="")
				return "<tr $atributos>$encabezado</tr>"."\n";
			else
				return "<tr>$encabezado</tr>"."\n";
		}
		
		/**
		 * Crea una fila de tabla a partir de los datos pasados por par�metro. Los atributos a�adidos formar�n parte de la etiqueta &lt;tr>
		 * @param array $datos_fila -> contiene los datos de la fila, de izquierda a derecha
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function trTd($datos_fila=[], $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			$fila ="";
			foreach ($datos_fila as $th) {
				$fila.="<td>$th</td>";
			}
		
			if ($atributos!="")
				return "<tr $atributos>$fila</tr>"."\n";
			else
				return "<tr>$fila</tr>"."\n";
		}
		
		public static function tablaDatos($datos_tabla=array(array()), $caption="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			$tabla ="";
			
			if ($caption!="")
				$tabla.="<caption>$caption</caption>";
			
			$encabezado=true; // Para que la primera fila sea 'th'
			foreach ($datos_tabla as $fila) {
				$tabla.="<tr>";
				foreach($datos_tabla[$fila] as $celda) {
					if ($encabezado) {
						$tabla.="<th>$celda</th>";
					}
				}
				$tabla.="</th>";
				$encabezado=false; // Fin de la primera fila, correspondiente al th
			}
			
			if ($atributos!="")
				return "<table $atributos>$tabla</table>"."\n";
			else
				return "<table>$tabla</table>"."\n";
		}
		
		/**
		 * Etiqueta de apertura &lt;tr>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function tr_($class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<tr $atributos>"."\n";
			else
				return "<tr>"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/tr>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _tr() {
			return "</tr>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;th>&lt;/th>
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function th($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<th $atributos>$contenido</th>"."\n";
			else
				return "<th>$contenido</th>"."\n";
		}		
		/**
		 * Etiqueta de apertura &lt;th>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function th_($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<th $atributos>$contenido"."\n";
			else
				return "<th>$contenido"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/th>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _th() {
			return "</th>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;td>&lt;/td>
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function td($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<td $atributos>$contenido</td>"."\n";
			else
				return "<td>$contenido</td>"."\n";
		}
		/**
		 * Etiqueta de apertura &lt;td>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function td_($contenido="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($atributos!="")
				return "<td $atributos>$contenido"."\n";
			else
				return "<td>$contenido"."\n";
		}
		/**
		 * Etiqueta de cierre &lt;/td>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _td() {
			return "</td>"."\n";
		}

		/*********************************************************************************************************
		 *
		 * ETIQUETAS DE FORMULARIO
		 *
		 *********************************************************************************************************/
		
		/**
		 * Etiqueta de apertura &lt;form>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 * @param string $action
		 * @param string $method -> Por defecto en post. Si se introduce algo diferente a 'get', autom�ticamente se cambiar� a 'post'.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function form_($action="", $method="post", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			
			if ($action!="") $atributos.="action='{$action}' ";
			$method=strtolower($method);
			if ($method!="get") {
				$method="post";
				$atributos.="method='{$method}' ";
			}

			return "<form {$atributos}>"."\n"; // En este caso, '$atributos' nunca estar� vac�o.
		}
		/**
		 * Etiqueta de cierre &lt;/form>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _form() {
			return "</form>"."\n";
		}	
		
		/**
		 * Etiqueta de apertura &lt;fieldset>
		 * El gui�n bajo del final lo utilizo como indicador de que necesita ser cerrado con su correspondiente etiqueta de cierre.
		 */
		public static function fieldset_() {
			return "<fieldset>"."\n"; // En este caso, '$atributos' nunca estar� vac�o.
		}
		/**
		 * Etiqueta de cierre &lt;/fieldset>
		 * El gui�n bajo del principio lo utilizo como indicador de que necesita ser abierto con su correspondiente etiqueta de apertura.
		 */
		public static function _fieldset() {
			return "</fieldset>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;legend>&lt;/legend>
		 * @param string $contenido
		 */
		public static function legend($contenido="") {
			return "<legend>$contenido</legend>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;label>&lt;/label>
		 * @param string $contenido
		 * @param string $for -> Aunque le atributo 'for' NO deber�a estar vac�o, permito que se puedan crear labels sin for.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function label($contenido="", $for="", $class="", $id="",$otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($for!="") $atributos.= "for='$for' ";
			
			if ($atributos!="")
				return "<label $atributos>$contenido</label>"."\n";
			else
				return "<label>$contenido</label>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;input />
		 * 
		 * @param string $type -> "text | password | checkbox | radio | submit | reset | file | hidden | image | button"
		 * @param string $name -> Asigna un nombre al control (es imprescindible para que el servidor pueda procesar el formulario).
		 * @param string $value -> Valor inicial del input (el contenido que se muestra)
		 * @param string $id -> Imprescindible si la etiqueta label se hace por separado, ya que es el valor asociado al 'for'
		 * @param bool $label -> Por defecto 'false'. Si es establece como 'true', se autogenerar� la etiqueta 'label', y se deber� rellenar el siguiente par�metro '$contenido_label'
		 * @param string $contenido_label -> Debe ser rellenado si '$label=true'
		 * @param string $class
		 * @param string $otros_atributos -> Otros atributos interesantes:
		 * 									<ul>
		 * 										<li>size = "unidad_de_medida":Tama�o inicial del control (para los campos de texto y de password se refiere al n�mero de caracteres, en el resto de controles se refiere a su tama�o en p�xel).
		 * 										<li>maxlength = "numero": M�ximo n�mero de caracteres para los controles de texto y de password.
		 * 										<li>checked = "checked": Para los controles checkbox y radiobutton permite indicar qu� opci�n aparece preseleccionada.
		 * 										<li>disabled = "disabled": El control aparece deshabilitado y su valor no se env�a al servidor junto con el resto de datos.
		 * 										<li>readonly = "readonly": El contenido del control no se puede modificar.
		 * 										<li>src = "url": Para el control que permite crear botones con im�genes, indica la URL de la imagen que se emplea como bot�n de formulario.
		 * 										<li>alt = "texto": Descripci�n del control.
		 * @return string
		 */
		public static function input($type="text", $name="", $value="", $id="", $label=false, $contenido_label="", $class="", $otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($type!="") $atributos.= "type='$type' ";
			if ($name!="") $atributos.= "name='$name' ";
			if ($value!="") $atributos.= "value='$value' ";
				
			if (($type=="radio" || $type=="checkbox") && $label) {
				return "<label><input $atributos/>$contenido_label</label>"."\n";
			}
			else {
				if ($label)
					return "<label>$contenido_label<input $atributos/></label>"."\n";
				else
					return "<input $atributos/>"."\n";
			}
			
		}
		
		/**
		 * Etiqueta de &lt;textarea>&lt;/textarea>
		 * 
		 * @param string $contenido
		 * @param string $placeholder -> Texto que aparece dentro del 'textarea' antes de seleccionarlo.
		 * @param string $name -> Asigna un nombre al control (es imprescindible para que el servidor pueda procesar el formulario).
		 * @param string $id -> Imprescindible si la etiqueta label se hace por separado, ya que es el valor asociado al 'for'
		 * @param bool $label -> Por defecto 'false'. Si es establece como 'true', se autogenerar� la etiqueta 'label', y se deber� rellenar el siguiente par�metro '$contenido_label'
		 * @param string $contenido_label -> Debe ser rellenado si '$label=true'
		 * @param string $class
		 * @param string $otros_atributos -> Otros atributos interesantes:
		 * 									<ul>
		 * 										<li>rows = "numero": N�mero de filas de texto que mostrar� el textarea.
		 * 										<li>cols = "numero": N�mero de caracteres que se muestran en cada fila del textarea.
		 */
		public static function textarea($contenido="", $placeholder="Escribe texto aqu�...", $name="", $id="", $label=false, $contenido_label="", $class="", $otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);

			if ($name!="") $atributos.= "name='$name' ";
			if ($placeholder!="") $atributos.= "placeholder='$placeholder' ";
		
			if ($label)
				return "<label>$contenido_label<br/><textarea $atributos>$contenido</textarea></label>"."\n";
			else
				return "<textarea $atributos>$contenido</textarea>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;select>&lt;/select> (con opciones)
		 * 
		 * @param number $tabs -> N�mero de tabulaciones de la etiqueta select para sangrar las opciones.
		 * @param array $lista -> Array asociativo con los valores y texto de las opciones.
		 * @param string $name -> Asigna un nombre al control (es imprescindible para que el servidor pueda procesar el formulario).
		 * @param number $select -> Opci�n que estar� seleccionada por defecto.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function select($tabs=0, $lista=["valor"=>"texto"], $name="", $select=1, $class="", $id="", $otros_atributos="") {	
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($name!="") $atributos.= "name='$name' ";
			
			$opciones = "";
			$c=0;
			$tab = Self::tab($tabs);
			
			foreach ($lista as $valor=>$texto) {
				$c++;
				if ($c==$select)				
					$opciones.="$tab    <option selected value='$valor'>$texto</option>\n";
				else
					$opciones.="$tab    <option value='$valor'>$texto</option>\n";
			}
			
			return "<select $atributos>\n$opciones$tab</select>"."\n";
		}
		
		/**
		 * Etiqueta de apertura &lt;select> (sin opciones).
		 * 
		 * @param string $name -> Asigna un nombre al control (es imprescindible para que el servidor pueda procesar el formulario).
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function select_($name="", $class="", $id="", $otros_atributos="") {
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($name!="") $atributos.= "name='$name' ";
			
			return "<select $atributos>"."\n";
		}
		
		/**
		 * Etiqueta de cierre &lt;/select>
		 */
		public static function _select() {
			return "</select>"."\n";
		}
		
		/**
		 * Etiqueta de apertura &lt;optgroup>.
		 * 
		 * @param string $label -> Texto de la etiqueta optgroup.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function optgroup_($label="", $class="", $id="", $otros_atributos=""){
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
			if ($label!="") $atributos.= "label='$label' ";
				
			return "<optgroup $atributos>"."\n";
		}
		
		/**
		 * Etiqueta de cierre &lt;/optgroup>
		 */
		public static function _optgroup() {
			return "</optgroup>"."\n";
		}
		
		/**
		 * Etiqueta de &lt;option>&lt;/option>.
		 * 
		 * @param string $valor -> value
		 * @param string $texto -> Contenido de la etiqueta option
		 * @param bool $selected -> Si aparece seleccionado o no.
		 * @param string $class
		 * @param string $id
		 * @param string $otros_atributos
		 */
		public static function option($valor="", $texto="", $selected=false, $class="", $id="", $otros_atributos=""){
			$atributos = Html::atributosComunes($class, $id, $otros_atributos);
		
			if ($selected)		
				return "<option selected value='$valor' $atributos>$texto</option>\n";
			else
				return "<option value='$valor' $atributos>$texto</option>\n";
		}
	}
?>