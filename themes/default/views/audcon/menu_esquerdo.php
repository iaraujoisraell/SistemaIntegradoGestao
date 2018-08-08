<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= $this->session->userdata('avatar') ? $assets . '../../../assets/uploads/avatars/thumbs/' . $this->session->userdata('avatar') : $assets . 'images/' . $this->session->userdata('gender') . '.png'; ?>" class="img-circle" alt="User Image">
        </div>
          <?php
                $usuario = $this->session->userdata('user_id');
                $dados_user = $this->site->getUser($usuario);
                ?>
        <div class="pull-left info">
          <p><?php echo $dados_user->first_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li <?php if($menu == "analise"){ ?> class="active" <?php } ?>>
          <a href="<?= site_url('AudCon'); ?>">
            <i class="fa fa-th"></i> <span>Análises</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        
       
        <li  <?php if($menu == "parametrizacao"){ ?> active <?php } ?> class="treeview">
          <a href="#">
            <i class="fa  fa-gears"></i>
            <span>Parametros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($ativo == "modulo1"){ ?> class="active" <?php } ?>><a href="<?= site_url('AudCon/modulo1'); ?>"><i class="fa fa-reorder"></i> Tabelas</a></li>
            <li <?php if($ativo == "modulo2"){ ?> class="active" <?php } ?>><a href="<?= site_url('AudCon/modulo2'); ?>"><i class="fa fa-signal"></i> Coberturas X Planos</a></li>
            <li <?php if($ativo == "modulo3"){ ?> class="active" <?php } ?>><a href="<?= site_url('AudCon/modulo3'); ?>"><i class="fa  fa-gear"></i> SIP da ANS</a></li>
            <li <?php if($ativo == "modulo4"){ ?> class="active" <?php } ?>><a href="<?= site_url('AudCon/modulo4'); ?>"><i class="fa  fa-sliders "></i> Regras de Procedimentos</a></li>
          </ul>
        </li>
        
        <li  class="<?php if($menu == "cadastros"){ ?> active <?php } ?> treeview">
          <a href="#">
            <i class="fa fa-barcode"></i>
            <span>Cadastros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($ativo == "regras"){ ?> class="active" <?php } ?>><a href="<?= site_url('AudCon/regras'); ?>"><i class="fa fa-cog"></i>Regras</a></li>
            <li <?php if($ativo == "emprestimo"){ ?> class="active" <?php } ?>> <a href="<?= site_url('Sig/bi_emprestimo'); ?>"><i class="fa fa-users"></i> Clientes</a></li>
          </ul>
        </li>
       
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>