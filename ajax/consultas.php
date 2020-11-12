<?php 
require_once "../modelos/Consultas.php";
require "../config/Conexion.php";

$consulta = new Consultas();

switch ($_GET["op"]) {
	

    case 'comprasfecha':
    $fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_fin=$_REQUEST["fecha_fin"];

		$rspta=$consulta->comprasfecha($fecha_inicio,$fecha_fin);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>$reg->fecha,
            "1"=>$reg->usuario,
            "2"=>$reg->proveedor,
            "3"=>$reg->tipo_comprobante,
            "4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
            "5"=>$reg->total_compra,
            "6"=>$reg->impuesto,
            "7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

     case 'ventasfechacliente':
    $fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_fin=$_REQUEST["fecha_fin"];
    $idcliente=$_REQUEST["idcliente"];

        $rspta=$consulta->ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente);
        $data=Array();

        while ($reg=$rspta->fetch_object()) {
            $data[]=array(
            "0"=>$reg->fecha,
            "1"=>$reg->usuario,
            "2"=>$reg->cliente,
            "3"=>$reg->tipo_comprobante,
            "4"=>$reg->serie_comprobante.' '.$reg->num_comprobante,
            "5"=>$reg->total_venta,
            "6"=>$reg->impuesto,
            "7"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
              );
        }
        $results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
        echo json_encode($results);
        break;

             case 'total':
    $fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_fin=$_REQUEST["fecha_fin"];

        $rspta=$consulta->total($fecha_inicio,$fecha_fin);
        $data=Array();
        $total=0;
        while ($reg=$rspta->fetch_object()) {   
$codigo=0;
$Cantidad=0;
$Producto=0;
$venta=0;       

              $Venta=mysqli_query($conexion,"SELECT a.codigo,a.nombre,d.`cantidad`,d.`cantidad`*d.`precio_venta`*d.`descuento` as venta FROM `detalle_venta` d inner join articulo a on d.`idarticulo`=a.`idarticulo` inner join venta v on d.`idventa`=v.idventa WHERE v.`estado`='Aceptado' and d.`idarticulo`='$reg->idarticulo'");
              while($detalle=mysqli_fetch_array($Venta)) { 
                $codigo=$detalle['codigo'];
                $Cantidad=$detalle['cantidad']+$Cantidad;
                $Producto=$detalle['nombre'];
                $venta=$detalle['venta']+$venta;
                $total= $detalle['venta']+$total;
            }
            $data[]=array(  
              "0"=>$codigo,
              "1"=>$Producto,
              "2"=>$Cantidad,
              "3"=>$venta,
                );
        }

      $data[]=array(  
          
          "0"=>"Total en Productos",
          "1"=>$total,
          "2"=>" ",
          "3"=>" ",
            );
            $totalmano=mysqli_query($conexion,"SELECT SUM(`total_venta`) as mano FROM `venta` WHERE DATE(fecha_hora)>='$fecha_inicio' AND DATE(fecha_hora)<='$fecha_fin' and `estado`='Aceptado'");
            while($obra=mysqli_fetch_array($totalmano)) { 
              $obratotal=$obra['mano'];
            }
            $data[]=array(  
              "0"=>"Total en Servicios",
              "1"=>$obratotal-$total,
              "2"=>" ",
              "3"=>" ",
                );
           $data[]=array(  
                  "0"=>"Ganacia Total",
                  "1"=>$obratotal,
                  "2"=>" ",
                  "3"=>" ",
                );
        $results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data);
             echo json_encode($results);
        break;

}
 ?>