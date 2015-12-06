-- Javier Latorre López-Villalta
-- BBDD PROYECTO MUEBLEBBB

CREATE DATABASE IF NOT EXISTS mueblebbb;

USE mueblebbb;
-- En caso de querer reiniciar las tablas:
drop table if exists lineas_pedido;
drop table if exists productos;
drop table if exists categorias;
drop table if exists perfil_usuario;
drop table if exists usuarios;
drop table if exists perfiles;


-- Tablas

CREATE TABLE IF NOT EXISTS categorias (
	id_categoria INT,        -- Inicializadas en la BBDD.
	categoria VARCHAR(10),      -- Máximo de 10 caracteres para el nombre de la categoría (en caso contrario se rompe el estilo del contenedor del producto)
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

CREATE TABLE IF NOT EXISTS usuarios (
	id_usuario INT,
    usuario VARCHAR(15),
    passwd VARCHAR(15),
	CONSTRAINT pk_usuarios PRIMARY KEY(id_usuario)
);

CREATE TABLE IF NOT EXISTS perfiles (
	id_perfil INT,
    perfil VARCHAR(7), -- cliente o admin
	CONSTRAINT pk_perfiles PRIMARY KEY(id_perfil)
);

CREATE TABLE IF NOT EXISTS perfil_usuario (
	id_perfil INT,
	id_usuario INT,
	CONSTRAINT pk_perfiles_usuario PRIMARY KEY(id_usuario, id_perfil),
    CONSTRAINT fk_perfiles_en_perfil_usuario FOREIGN KEY (id_perfil) REFERENCES perfiles(id_perfil),
    CONSTRAINT fk_usuarios_en_perfil_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Tiene dos propiedades comentadas porque serían las necesarias en caso de necesitar la tabla 'facturas', para seguir desarrollando el carrito
CREATE TABLE IF NOT EXISTS lineas_pedido (
	id_pedido INT,
	id_producto INT,
    id_usuario INT,
    cantidad INT,
    precio INT,
    descuento INT,
    -- id_factura INT,
    -- numero_linea,
	CONSTRAINT pk_lineas_pedido PRIMARY KEY(id_pedido),
    CONSTRAINT fk_productos_en_lineas_pedido FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
    CONSTRAINT fk_usuarios_en_lineas_pedido FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Datos por defecto

INSERT INTO categorias (id_categoria, categoria)
	VALUES 
		(0,"Dormitorio"),
        (1,"Salón"),
        (2,"Cocina"),
        (3,"Baño"),
		(4,"Exterior");
        
INSERT INTO productos (id_producto, id_categoria, nombre, imagen, precio, descuento, nuevo, caracteristicas)
	VALUES
		(1, 0, "Armario muy chulo", "../imagenes/_ID1-armario.jpg", 1448, 25, false, "Un armario de madera de la buena con unas medidas muy grandes."),
        (2, 4, "Tumbona con estilo", "../imagenes/_ID2-tumbona.jpg", 144, 24, false, "Una tumbona de acero inoxidable perfecta para tumbarse al sol y sudar todo lo que te de la gana."),
        (3, 1, "Mesa blanca", "../imagenes/_ID3-mesa.jpg", 970, 23, false, "Una mesa de pseudomármol reendurecido fácil de limpiar con una capacidad de 6 personas."),
        (4, 2, "Mesa comedor vintage", "../imagenes/_ID4-mesa_comedor.jpg", 897, 25, false, "Mesa de madera de árbol de Mordor barnizada con sangre de orco"),
        (5, 0, "Estantería molona", "../imagenes/_ID5-estanteria.jpg", 832, 0, true, "Estantería corredera para sosterner grandes pesos y durable antiexplosiones alquímicas."),
        (6, 0, "Mesita dulces sueños", "../imagenes/_ID6-mesita_noche.jpg", 279, 0, true, "Mesita de noche del tamaño de un niño pequeño con cerradura para guardar tu bienes más personales."),
        (7, 0, "Aparador metálico", "../imagenes/_ID7-aparador_metal.jpg", 615, 0, false, "Un aparador de metal gris antioxidable y antitiempo."),
        (8, 0, "Armario Mindi", "../imagenes/_ID8-armario_mindi.jpg", 1080, 0, false, "Armario mindi amplio para ropa y con un compartimento especial para amantes."),
        (9, 0, "Baúl dos cajones", "../imagenes/_ID9-baul_cajones.jpg", 288, 0, false, "Baúl para almacenar tus recuerdos más queridos, con dos cajones extra para almacenar los recuerdos más valiosos."),
        (10, 0, "Biombo polipiel", "../imagenes/_ID10-biombo.jpg", 700, 0, false, "Biombo tapizado en polipiel, con cinco divisiones y detalle enmarcado de tachuelas."),
        (11, 2, "Cajas vintage", "../imagenes/_ID11-cajas_vintage.jpg", 22, 0, false, "5 cajas de estilo vintage realizadas en metal con un acabado ilustrado multicolor. Quedará genial para la cocina."),
        (12, 3, "Cajonera ropa", "../imagenes/_ID12-cestos_ropa_cajonera.jpg", 249, 0, false, "Sinfonier de madera en color blanco con tres cestos de mimbre con forro de tela y tablero color natural."),
        (13, 3, "Colgador baño", "../imagenes/_ID13-colgador_banyo_zorro.jpg", 37, 0, false, "El Colgador de baño es el lugar perfecto para guardar todos los artículos pequeños del baño."),
        (14, 3, "Cuadros baño", "../imagenes/_ID14-cuadros_banyo.jpg", 32, 0, false, "Dos cuadros realizados en madera color gris desgastado con ilustraciones de baños."),
        (15, 3, "Cuadros baño 2", "../imagenes/_ID15-cuadros_banyo2.jpg", 67, 0, true, "Cuatro cuadros sobre madera con ilustraciones de baños."),        
        (16, 3, "Espejo baño", "../imagenes/_ID16-Espejo_banyo_plata.jpg", 49, 0, true, "Espejo de metal con baño de plata antigua con un diseño moderno."),
        (17, 2, "Estante cocina", "../imagenes/_ID17-estante_cacharros.jpg", 73, 0, true, "Estante de pared realizado en metal de color gris. De aspecto industrial, con un toque ideal para tu cocina."),
        (18, 1, "Estantería escalones", "../imagenes/_ID18-estanteria_escalonada.jpg", 287, 0, true, "Estantería escalonada perfecta para el salón y colocar cosas en orden de importancia o subir al cielo."),
        (19, 3, "Juego toallas", "../imagenes/_ID19-juego_toallas.jpg", 6, 17, false, "Toalla de baño realizada en algodón, de tacto suave y muy absorbente."),
        (20, 1, "Librería salón", "../imagenes/_ID20-libreria.jpg", 93, 0, true, "Coloca en tu salón esta librería line de madera que se caracteriza por la sencillez y pureza de sus líneas."),  
        (21, 0, "Mesita flor", "../imagenes/_ID21-mesa_auxiliar_flor.jpg", 216, 25, false, "Mesa auxiliar estilo clásico de madera con 2 cajones. Color verde con estampado de una flor."),
        (22, 1, "Mesita roja", "../imagenes/_ID22-mesa_auxiliar_roja.jpg", 112, 0, true, "Mesa auxiliar hecha en metal rojo de acabado envejecido de estilo industrial."),
        (23, 4, "Mesa centroteca", "../imagenes/_ID23-mesa_centroteca.jpg", 437, 26, false, "Mesa de centro con patas de metal y tablero de madera de teca con una composición tipo mosaico."),
        (24, 2, "Mesa/Sillas comedor", "../imagenes/_ID24-mesa_sillas_comedor.jpg", 582, 13, false, "Juego de mesa y cuatro sillas de comedor de estilo clásico realizados en madera."),
        (25, 1, "Mesas acopables", "../imagenes/_ID25-mesas_acoplables.jpg", 398, 25, false, "Tres mesas realzadas en madera de abeto y metal. Con patas en color gris de acabado envejecido y tablero al natural."),
        (26, 1, "Mesas nido", "../imagenes/_ID26-mesas_nido.jpg", 210, 0, false, "Tres mesas auxiliares nido, de diferentes tamaños, realizadas con patas de metal y tableros en fibra de madera de acabado al natural."),
        (27, 2, "Mueble cocina", "../imagenes/_ID27-fregadero_cocina.jpg", 1520, 0, false, "Mueble de cocina con dos pozas en piedra de color negro y estructura en madera de abeto de color marrón."),
        (28, 4, "Parasol aluminio", "../imagenes/_ID28-parasol_aluminio.jpg", 125, 0, false, "Parasol de aluminio con lona de color crudo natural de polietester y tratamiento hidrofugo. Sistema fácil despliegue mediante manivela."),
        (29, 3, "Perchero baño", "../imagenes/_ID29-Perchero_toallas.jpg", 25, 0, false, "Perchero de pared realizado en madera de acabado envejecido con colgadores de metal."),
        (30, 4, "Silla exterior", "../imagenes/_ID30-silla_mattia.jpg", 128, 0, false, "Dale un toque señorial a cualquier ambiente con esta preciosa silla metálica."),
        (31, 1, "Silla orejas", "../imagenes/_ID31-silla_orejas.jpg", 181, 0, false, "Silla de estilo clásico realizada en madera con tapizado de algodón."),
        (32, 4, "Silla plegable", "../imagenes/_ID32-silla_patio.jpg", 32, 0, true, "Silla plegable realizada con estructura plegable de hierro con pintura anticorrosión."),
        (33, 1, "Silla pino", "../imagenes/_ID33-silla_pino.jpg", 97, 0, false, "Silla de estilo clásico realizada en madera de pino fácil de combinar."),
        (34, 1, "Sillón pino", "../imagenes/_ID34-sillon_monoplaza.jpg", 290, 0, false, "Sillón de estilo retro realizadp en madera de pino y tapizado en algodón."),
        (35, 2, "Tabla cortar", "../imagenes/_ID35-tabla_cortar.jpg", 49, 0, false, "Tabla de cortar realizada en madera. Amenizada con un acabado multicolor."),
        (36, 3, "Vitrina baño", "../imagenes/_ID36-vitrina_banyo.jpg", 268, 0, false, "Vitrina de baño estilo clásico de madera. Color verde con estampado de una flor.");

INSERT INTO usuarios (id_usuario, usuario, passwd)
	VALUES 
		(0,"superadmin", "1234"), -- admin y cliente
        (1,"admin", "1234"), -- admin
		(2,"jlalovi", "77349150"), -- admin y cliente
        (3,"pepe", "1234"), -- cliente
        (4,"antonio", "1234"), -- cliente
        (5,"emilio", "1234"), -- cliente
        (6,"sandra", "1234"), -- cliente
        (7,"raul", "1234"); -- cliente
 
 INSERT INTO perfiles (id_perfil, perfil)
	VALUES 
		(0,"admin"),
		(1,"cliente");

INSERT INTO perfil_usuario (id_usuario, id_perfil)
	VALUES 
		(0,0),
		(0,1),
        (1,0),
        (2,0),
        (2,1),
        (3,1),
        (4,1),
        (5,1),
        (6,1),
        (7,1);

-- PRUEBAS
-- SELECT max(id_producto) FROM productos;

-- INSERT INTO productos (id_producto, id_categoria, nombre, imagen, precio, descuento, nuevo, caracteristicas) VALUES (7, 2, 'Prueba', '../imagenes/image_placeholder.png', 123, 0, false, 'características del producto')

SELECT * FROM productos;
SELECT * FROM categorias;

SELECT * FROM productos JOIN categorias ON categorias.id_categoria = productos.id_categoria ORDER BY categorias.categoria, productos.nombre;

