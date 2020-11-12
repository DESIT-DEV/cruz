<?php
if(!isset($_POST["total"])) exit;

session_start();
$idusuario=$_SESSION["idusuario"];
$total = $_POST["total"];
include_once "base_de_datos.php";

$ahora = date("Y-m-d H:i:s");
$estado="Aceptado";
$comprobante="Ticket";
$idcliente="8";

$sentencia = $base_de_datos->prepare("INSERT INTO venta(fecha_hora, total_venta, estado,`idcliente`, `idusuario`,`tipo_comprobante`) VALUES (?, ?, ?,?, ?, ?);");
$sentencia->execute([$ahora, $total, $estado,$idcliente,$idusuario,$comprobante]);

$sentencia = $base_de_datos->prepare("SELECT idventa FROM venta ORDER BY idventa DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->idventa;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO detalle_venta(idarticulo, idventa, cantidad,precio_venta) VALUES (?, ?, ?, ?);");
// $sentenciaExistencia = $base_de_datos->prepare("UPDATE articulo SET stock = stock - ? WHERE idarticulo = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->total;
	$sentencia->execute([$producto->id, $idVenta, $producto->cantidad ,$producto->precioVenta]);
//	$sentenciaExistencia->execute([$producto->cantidad, $producto->id]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>