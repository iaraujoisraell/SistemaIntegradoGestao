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
    
    
<body class="hold-transition skin-blue layout-boxed <?php if($layout){ echo $layout; }?>  sidebar-mini">
<div class="wrapper">

  <?php  $this->load->view($this->theme . 'audcon/topo'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  
  <?php  $this->load->view($this->theme . 'audcon/menu_esquerdo'); ?>
  <!-- Content Wrapper. Contains page content -->
  
  <?php echo  $this->load->view($this->theme . $pagina); ?>
  
  <!-- /.content-wrapper -->
  <?php  $this->load->view($this->theme . 'audcon/footer_rodape'); ?>

  <!-- Control Sidebar -->
 <?php  $this->load->view($this->theme . 'audcon/menu_direito'); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php  $this->load->view($this->theme . 'audcon/footer'); ?>

</body>
</html>
