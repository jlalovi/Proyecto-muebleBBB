-- Javier Latorre López-Villalta
-- BBDD PROYECTO MUEBLEBBB

CREATE DATABASE IF NOT EXISTS mueblebbb;

USE mueblebbb;
-- En caso de querer reiniciar las tablas:
drop table productos;
drop table categorias;


CREATE TABLE IF NOT EXISTS categorias (
	id_categoria INT,        -- Inicializadas en la BBDD.
	nombre VARCHAR(10),      -- Máximo de 10 caracteres para el nombre de la categoría.
	CONSTRAINT pk_categorias PRIMARY KEY(id_categoria)
);

CREATE TABLE IF NOT EXISTS productos (
	id_producto INT,              -- Autogenerado con PHP
    id_categoria INT,
	nombre VARCHAR(20),           -- Máximo de 20 caracteres para el nombre del producto.
    imagen VARCHAR(100),          -- NOTA: (imagenes en http://mimub.com/es)
	precio INT,	      -- Máximo de 6 cifras y 2 decimales
    descuento INT,      -- Máximo de 2 cifras y 0 decimales (En PHP, si descuento!=0, mostrar descuento)
    nuevo BOOL,                   -- Verdadero o Falso, en función de si se quiere marcar como novedad o no.
	caracteristicas VARCHAR(200), -- Máximo 200 caracteres, reservados para descripción completa del producto (página cuando se pincha sobre él)
	CONSTRAINT pk_productos PRIMARY KEY(id_producto),
	CONSTRAINT fk_categorias_en_productos FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

INSERT INTO categorias (id_categoria, nombre)
	VALUES 
		(1,"Dormitorio"),
        (2,"Salón"),
        (3,"Cocina"),
        (4,"Baño"),
		(5,"Exterior");
        
INSERT INTO productos (id_producto, id_categoria, nombre, imagen, precio, descuento, nuevo, caracteristicas)
	VALUES
		(1, 1, "Armario muy chulo", "../imagenes/_ID1-armario.jpg", 1448, 25, false, "Un armario de madera de la buena con unas medidas muy grandes."),
        (2, 5, "Tumbona con estilo", "../imagenes/_ID2-tumbona.jpg", 110, 24, false, "Una tumbona de acero inoxidable perfecta para tumbarse al sol y sudar todo lo que te de la gana."),
        (3, 2, "Mesa blanca", "../imagenes/_ID3-mesa.jpg", 809, 23, false, "Una mesa de pseudomármol reendurecido fácil de limpiar con una capacidad de 6 personas."),
        (4, 3, "Mesa comedor vintage", "../imagenes/_ID4-mesa_comedor.jpg", 897, 0, true, "Mesa de madera de árbol de Mordor barnizada con sangre de orco"),
        (5, 1, "Estantería molona", "../imagenes/_ID5-estanteria.jpg", 832, 0, true, "Estantería corredera para sosterner grandes pesos y durable antiexplosiones alquímicas."),
        (6, 1, "Mesita dulces sueños", "../imagenes/_ID6-mesita_noche.jpg", 279, 0, true, "Mesita de noche del tamaño de un niño pequeño con cerradura para guardar tu bienes más personales.");

-- PRUEBAS
-- SELECT max(id_producto) FROM productos;

-- INSERT INTO productos (id_producto, id_categoria, nombre, imagen, precio, descuento, nuevo, caracteristicas) VALUES (7, 2, 'Prueba', '../imagenes/image_placeholder.png', 123, 0, false, 'características del producto')

SELECT * FROM productos