<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->



<!DOCTYPE html>
<html>
<?php  $this->load->view($this->theme . 'audcon/head'); ?>
    
    
<body >


  <?php  $this->load->view($this->theme . 'audcon/topo'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  
  <?php  $this->load->view($this->theme . 'audcon/menu_esquerdo'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="div-ajax-carregamento-pagina">
        <div class="col-md-12">
          <div class="box  box-solid">
            <div class="box-header">
              <h3 class="box-title">Aguarde</h3>
            </div>
            <div class="box-body">
              Carregando
            </div>
            <!-- /.box-body -->
            <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
          </div>
          <!-- /.box -->
        </div>
    </div>
  
  
  <?php echo  $this->load->view($this->theme . $pagina); ?>
  
  <!-- /.content-wrapper -->
  <?php  //$this->load->view($this->theme . 'audcon/footer_rodape'); ?>

  <!-- Control Sidebar -->
 <?php // $this->load->view($this->theme . 'audcon/menu_direito'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php  $this->load->view($this->theme . 'audcon/footer'); ?>

</body>
</html>
