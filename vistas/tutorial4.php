<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['consultav']==1) {

 ?>
<style>
#video-container{
    height:85vh;
    overflow:hidden;
}
video{
    width: 75%;
    overflow:hidden;
}
</style>

    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Tutoriales de Ventas</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div id="video-container" class="row no-margin no-padding">
    <video autoplay controls loop >
        <source src="../files/tutorial/ventas.mp4">
    </video>
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
 
 <?php 
}

ob_end_flush();
  ?>

