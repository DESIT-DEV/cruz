<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Articulo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen){
	$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
	 VALUES ('$idcategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1')";
	return ejecutarConsulta($sql);
}

public function insertar_notificacion($idarticulo,$nombre){
	$sql="INSERT INTO alertas(idcategoria,nombre,Detalle)
	 VALUES ('$idcategoria','$nombre','Este articulo tiene poco inventario')";
	return ejecutarConsulta($sql);
}

public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen){
	$sql="UPDATE articulo SET idcategoria='$idcategoria',codigo='$codigo', nombre='$nombre',stock='$stock',descripcion='$descripcion',imagen='$imagen' 
	WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}
public function desactivar($idarticulo){
	$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}
public function activar($idarticulo){
	$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idarticulo){
	$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,detalle_ingreso.precio_compra,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM ((articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria) INNER JOIN detalle_ingreso ON a.idarticulo=detalle_ingreso.idarticulo)";
	return ejecutarConsulta($sql);
}
public function listarbajos(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE `stock`<=5 order by `stock`Asc ";
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}

//implementar un metodo para listar los activos, su ultimo precio y el stock(vamos a unir con el ultimo registro de la tabla detalle_ingreso)
public function listarActivosVenta(){
	$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo ORDER BY iddetalle_ingreso DESC LIMIT 0,1) AS precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}
}


/*INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C001','Cuscatleco','','Café estilo americano  8 Onz.','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C002','Cuscatleco','','Café estilo americano 12 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C003','Caturra ','','Café saborizado 8 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C004','Caturra','','Café saborizado 12 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C005','Capuccino','','Café con leche vaporizada y canela 8 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C006','Capuccino','','Café con leche vaporizada y canela 12 ONZ','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C007','Moccacino','','Café con leche y chocolate de 8 Onz.','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C008','Moccacino','','Café con leche y chocolate de 12 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C009','Latte','','Café con leche vaporizada de 8 Onz.','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C010','Honey ','','Café con leche, canela y miel de 12 Onz ','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C011','Expresso','','Café 4 onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C012','Cortadito','','Café expreso 4 Onz con 2 onz leche vaporizada','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C013','Té Manzanilla','','Marca McKornic','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C014','Te de Jazmín','','Marca Twinggins','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C015','Te Verde','','Marca Twinggies','','1')";


INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (12,'C016','Te Negro','','Marca Twinggies','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (15,'F001','Frappé','','1 Expresso con hielo, leche, azucar hecho frozen servido con crema batida y chocolate derretido','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (15,'F002','Frappé Oreo','','1 Expresso con hielo, leche, azucar hecho frozen servido con chocolate derretido y crema batida.','','1')";


INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (15,'F003','Mixtepec','','Hielo, leche, azucar y sirope de menta estilo frozen y servido con chocolate y crema batida.','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (15,'F004','Frozen Chai','','Frozen chai, leche y azucar estilo frozen y servido con canela','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (15,'F005','Izalqueño','','Blue curacao, leche y azucar con marshmellows servido con crema batida y chocolate','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H001','Mesitzo','','Hielo, leche y café con sirope 12 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H002','Mestizo Añejo','','Hielo, leche y café con sirope  y Ron 12 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H003','Capuccino Helado','','Expresso, leche vaporizada canela y hielo
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H004','Limonada','','Limon, sal, hielo y azucar','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H005','Limonada Rosa','','Limon, sal, hielo, azucar y fresa','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H006','Agua embotellada','','Agua embotellada','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H007','Soda Coca','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H008','','Soda Fanta','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H009','','Soda Sprite','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H010','Soda Uva','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (7,'H011','Soda Fresa','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (16,'S001','Smoothie Fresa','','Mezcla de leche, azucar y hielo con fresa','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (16,'S002','Smoothie Melon','','Mezcla de leche, azucar y hielo con Melón
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (16,'S003','Smoothie Piña','','Mezcla de leche, azucar y hielo con Piña','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (16,'S004','Smoothie Papaya','','Mezcla de leche, azucar y hielo con Papaya','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (16,'S005','Smoothie Guineo','','Mezcla de leche, azucar y hielo con Guineo
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (16,'S006','Smoothie Melocotón','','Mezcla de leche, azucar y hielo con Melocotón
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I001','Black Russian','','Mezcla de expresso, shot de ron, vodka, crema shantilli y café moiido sobre la crema con hielo','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I002','Capuccino Irlandés','','Mezcla de base de capuccino mas shot de wisky irlandés','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I003','Café Catalán ','','Mezcla de leche condensada, expresso, zumo de limón y crema shantilli','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I004','Café Vietnamita','','Mezcla de clara de huevo con leche condensada sobre un expresso
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I005','Chai Kauani','','Mezcla de chai con leche vaporizada servida con canela','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I006','Café Etiope','','Cuscatleco en prensa, cardamomo y miel 12 Onz.','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (17,'I007','Café Azteca','','cuscatleco Canela, clavo de olor endulzado con miel 12 Onz
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD001','Sandwich + Café','','Jamón y queso ó Pollo mas café cuscatleco','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD002','Muffin + Capuccino','','Muffin + Capuccino','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD003','Tres Leches + Capuccino','','Porción de Tres leches con canela y capuccino 8 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD004','Mini Croissant + Caturra','','Mini Croissant con jamón más caturra 8 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD005','Combo Irlandés','','Porción de tres leches bañada en wisky mas capuccino 12 Onz.','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD006','Panini mas soda ó café','','Panini italiano mas soda ó café cuscatleco 8 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD007','Combo Árabe','','Pan arabe con jamón, queso y salsa prego ó mayonesa con soda ó cuscatleco 8 Onz','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (18,'CD008','Combo Cubano','','Sandwich cubano mas soda o cuscatleco 8 onz
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Cerveza Regia Lata','','Cerveza Regia Lata','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Cerveza Suprema vidrio','','Cerveza Suprema vidrio','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Cerveza Corona','','Cerveza Corona Vidrio','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Tequila Shot','','4 Onz de Tequila 
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Ron Shot','','4 oNZ DE Ron
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Wisky Shot','','4 Onz de Wisky','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Copa de Vino','','5 Onz de Vino tinto','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (19,'L001','Blue Mix','','Mezcla de limon, ron, hielo, soda sprite y blue curacao
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM01','Hamburguesa','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM02','Orden de Tacos','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM03','Burrito','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM04','Pananini','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM05','Plato de Carne Azada','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM06','Orden de papas fritas','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM07','Panini con carne','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM08','Desayuno tradicional','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM09','Panini con Huevo','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM10','Sandwich de Pollo ','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM11','Sandwich de Jamón  y Queso','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM12','Sandwich Cubano','','Mezcla de leche, azucar y hielo con Melocotón
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM13','Pan Arabe','','','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (13,'CM14','Orden de Nachos','','','','1')";


INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Rollitos de canela','','Mini rollos de canela','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Galletas de avena','','Galletas de Avena','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Alfajores','','Alfajores con azucar espolvoreada','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Francesistas de Piña','','Francesita de Piña','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Francesitas de Fresa','','Francesita de Fresa','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Ojaldres','','Ojaldres con azucar','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Muffins','','Muffin de chocolate o vainilla','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Mini croissant salado','','Mini croissant con jamon y queso','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Chocolatito','','Mini croissant con chocolate derrertido encima
','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (20,'P001','Platano desidratado','','Tiras de plantano desidratado','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (14,'CM14','Tres leches','','Tres leches con canela','','1')";

INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
VALUES (14,'CM14','Crepa de Banana y nutella','','Crepa de nutella y banana','','1')";*/
 ?>






