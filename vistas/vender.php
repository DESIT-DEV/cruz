<?php 
session_start();
include_once 'header.php';

if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>

    <div class="content-wrapper">

<section class="content">
<div class="row">
	<div class="col-xs-12">
		<h1>Vender</h1>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>
		<br>
		<form method="post" action="agregarAlCarrito.php">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
		</form>
		<br><br>
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead style="background-color:#A9D0F5">
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Precio de venta</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Quitar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->total;
					?>
				<tr>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3>Total: <?php echo $granTotal; ?></h3>
		<form action="./terminarVenta.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>
</div>
</section>
	</div>
	<script type="text/javascript">
  
  toastr.info('Are you the 6 fingered man?')
  </script>
  <!--fin centro-->
		</div>
		</div>
		</div>
		<!-- /.box -->
  
	  </section>
	  <!-- /.content -->
	</div>
  <?php 
  
  require 'footer.php'
   ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	  <script src="https://code.jquery.com/jquery-3.4.1.min.js'
	integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
	crossorigin='anonymous"></script>
   <script src="../public/js/JsBarcode.all.min.js"></script>
   <script src="../public/js/jquery.PrintArea.js"></script>
  
   <?php 

  ob_end_flush();
	?>