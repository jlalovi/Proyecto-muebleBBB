<?php
	/**
	 * 
	 * @param string $titulo -> Título de la página HTML
	 * @param string $rutaCss -> ruta al CSS que se aplica a la página que se va a cargar
	 * @param string $rutaJS -> ruta al JS que se aplica a la página que se va a cargar
	 * @return string
	 */
	function cabecera($titulo, $rutaCss, $rutaJS){
		$devolver = <<<CAB
			<!DOCTYPE html>
			<html>
				<head>
					<title>$titulo</title>
					<meta charset="ISO-8859-1">
					<link rel="stylesheet" type="text/css" href="$rutaCss" media="screen" />
					<script type="text/javascript" src="$rutaJS"></script>
				</head>
				<body>
CAB;
		return $devolver;
	}
?>