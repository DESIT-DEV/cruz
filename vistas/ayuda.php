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
    
    <center>
      <h1>Hola <br>
      si necesitas ayuda llama al 7089-6057</h1>

</center>
      <!-- Default box -->
      <div class="row">
    
<!--fin centro-->
      </div>
      </div>
      
      <!-- /.box -->

    </section>
    <!-- /.content -->

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
