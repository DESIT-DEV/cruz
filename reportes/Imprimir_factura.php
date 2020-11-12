  <?php 
  //activamos almacenamiento en el buffer
  ob_start();
  if (strlen(session_id())<1) 
    session_start();

  if (!isset($_SESSION['nombre'])) {
    echo "debe ingresar al sistema correctamente para visualizar la factura";
  }else{

  if ($_SESSION['ventas']==1) {

  //incluimos el archivo factura
  require('FacturaImprimir.php');

  //establecemos los datos de la empresa
  //$logo="logos.png";
 //$ext_logo="png";


  //obtenemos los datos de la cabecera de la venta actual
  require_once "../modelos/Venta.php";
  $venta= new Venta();
  $rsptav=$venta->ventacabecera($_GET["id"]);

  //recorremos todos los valores que obtengamos
  $regv=$rsptav->fetch_object();

  //configuracion de la factura
  $pdf = new PDF_Invoice('p','mm','A4');
  $pdf->AddPage();

  //enviamos datos de la empresa al metodo addSociete de la clase factura


  $pdf->fact_dev("$regv->tipo_comprobante ","$regv->serie_comprobante- $regv->num_comprobante");
  $pdf->temporaire( "" );
  $pdf->addDate($regv->fecha);
  $pdf->addGiro($regv->giro);
  $pdf->addNrf($regv->num_documento2);
  $pdf->addDepartamento($regv->Departamento);

  //enviamos los datos del cliente al metodo addClientAddresse de la clase factura
  $pdf->addClientAdresse(utf8_decode($regv->cliente),
                         utf8_decode("                  ").utf8_decode($regv->direccion), 
                       $regv->num_documento, 
                         "Email: ".$regv->email, 
                         " ".$regv->giro, 
                         "Telefono: ".$regv->telefono);

  //establecemos las columnas que va tener lña seccion donde mostramos los detalles de la venta
  $cols=array( "CANTIDAD"=>23,
  	         "DESCRIPCION"=>60,
  	         "CANTIDAD"=>22,
  	         "P.U."=>41,
  	        
  	         "SUBTOTAL"=>22);
  $pdf->addCols( $cols);
  $cols=array( "CODIGO"=>"L",
               "DESCRIPCION"=>"L",
               "CANTIDAD"=>"C",
               "P.U."=>"R",
               
               "SUBTOTAL"=>"C" );
  $pdf->addLineFormat( $cols);
  $pdf->addLineFormat($cols); 

  //actualizamos el valor de la coordenada "y" quie sera la ubicacion desde donde empecemos a mostrar los datos 
  $y=89;

  //obtenemos todos los detalles del a venta actual
  $rsptad=$venta->ventadetalles2($_GET["id"]);
  

  while($regd=$rsptad->fetch_object()){
$precio2=$regd->total_venta;
$total=round($precio2/1.13,2);
    $line = array( "CODIGO"=>"$regd->idventa",
                   "DESCRIPCION"=>utf8_decode("$regd->Descripcion"),
                   "CANTIDAD"=>"1",
                   "P.U."=>" ",
                 
                   "SUBTOTAL"=>"$total");
    $size = $pdf->addLine( $y, $line );
    $y += $size +2;

  }  




  /*aqui falta codigo de letras*/
  require_once "Letras.php";
  $V = new EnLetras();

  $total=$regv->total_venta; 
  $V=new EnLetras(); 
  $V->substituir_un_mil_por_mil = true;

   $con_letra=strtoupper($V->ValorEnLetras($total," DOLAR")); 
  $pdf->addCadreTVAs("---".$con_letra);


  //mostramos el impuesto
  $pdf->addTVAs( $regv->impuesto, $regv->total_venta, " ");
  
  $pdf->Output('Reporte de Venta' ,'I');

  	}else{
  echo "No tiene permiso para visualizar el reporte";
  }

  }

  ob_end_flush();
    ?>