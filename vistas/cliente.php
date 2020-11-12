<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['ventas']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Clientes <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Documento</th>
      <th>Numero</th>
      <th>Telefono</th>
      <th>Email</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Documento</th>
      <th>Numero</th>
      <th>Telefono</th>
      <th>Email</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre</label>
      <input class="form-control" type="hidden" name="idpersona" id="idpersona">
      <input class="form-control" type="hidden" name="tipo_persona" id="tipo_persona" value="Cliente">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del cliente" required>
    </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Departamento</label>
     <select class="form-control select-picker" name="departamento" id="departamento" required>
       <option value="SAN SALVADOR">SAN SALVADOR</option>
       <option value="Ahuachapán">Ahuachapán</option>
       <option value="Cabañas">Cabañas</option>
       <option value="Chalatenango">Chalatenango</option>
       <option value="Cuscatlán">Cuscatlán</option>
       <option value="Morazán">Morazán</option>
       <option value="La Libertad">La Libertad</option>
       <option value="La Paz">La Paz</option>
       <option value="La Unión">La Unión</option>
       <option value="San Miguel">San Miguel</option>
       <option value="San Vicente">San Vicente</option>
       <option value="Santa Ana">Santa Ana</option>
       <option value="Sonsonate">Sonsonate</option>
       <option value="Usulután">Usulután</option>
     </select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Número Documento</label>
      <input class="form-control" type="text" name="num_documento" id="num_documento" maxlength="20" placeholder="Número de Documento">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Tipo Dcumento</label>
     <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
       <option value="NRF">NRF</option>
       <option value="DUI">DUI</option>
       <option value="NIT">NIT</option>
     </select>
    </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Número Documento</label>
      <input class="form-control" type="text" name="num_documento2" id="num_documento2" maxlength="20" placeholder="Número de Documento">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Tipo Dcumento</label>
     <select class="form-control select-picker" name="tipo_documento2" id="tipo_documento2" required>
       <option value="NIT">NIT</option>
       <option value="DUI">DUI</option>
       <option value="NRF">NRF</option>
     </select>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Direccion</label>
      <input class="form-control" type="text" name="direccion" id="direccion" maxlength="70" placeholder="Direccion">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="Número de Telefono">
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Email</label>
      <input class="form-control" type="email" name="email" id="email" maxlength="50" placeholder="Email">
    </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Giro del Negocio</label>
      <input class="form-control" type="text" name="giro" id="giro" maxlength="50" placeholder="Giro del Negocio">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php';
 ?>
 <script src="scripts/cliente.js"></script>
 <?php 
}

ob_end_flush();
  ?>
