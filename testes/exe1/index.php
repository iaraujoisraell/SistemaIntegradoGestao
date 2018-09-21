<!DOCTYPE html>
<html lang="en">

<?php include './head.php'; ?>

<body>
 <div  id="wrapper">
     <nav class="navbar-top" role="navigation">

            <!-- begin BRAND HEADING -->
            <div class="navbar-header">
               
                <a href="index.php">
                   <img src="arquivos/img/Bemol.logo.png" width="100px;"height="50px;"  alt="">
                    </a>
            </div>
            <ul class="nav navbar-right">
                <li class="dropdown">
                    <font style="color: #ffffff; font-size: 18px;"> ISRAEL ARAUJO </font>
                </li>
            </ul>
       </nav>     
     <div style="height: 700px;" id="page-wrapper">

            <div class="page-content">
              <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>AVALIAÇÃO PRÁTICA 
                                <small>PARA ENGENHEIRO DE SOFTWARE</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a class="btn btn-success" href="index.php"><i class="fa fa-calendar"></i> 1 - Cálculo da dívida atualizada de uma parcela de contrato. </a>
                                </li>
                                <li> <a class="btn btn-default" href="pacientes.php"><i class="fa fa-users"></i> 2 - Registros de pacientes para atendimento hospitalar. </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                 
                </div>
                <div class="row">

                    <div class="col-lg-6">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="portlet portlet-default">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4>Calcular valor atualizado da parcela</h4>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="portlet-body">
                                        <h4>Data do Vencimento</h4>
                                        <input  type="date" class="form-control" required="true"  maxlength="8" id="input_id_data_vencimento" />
                                        <h4>Valor da Parcela  R$ </h4>
                                        
                                      <input type="text" placeholder="R$ 999,99" class="form-control" required="true" onkeypress="mascara(this, mvalor);" maxlength="10" id="input_id_valor_parcela"  />
                                        <br>
                                       
                                        <button style="width: 150px; " class="btn btn-red"  onclick="calculaValor()">Calcular Valor</button>
                                        <a href="index.php" style="width: 150px; " class="btn btn-white"  >Limpar Valores</a>
                                        
                                        
                                        <div id="conteudo"> </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            
        </div>
     </div>
   
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- jQuery UI added before Bootstrap on this page for no interference -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="arquivos/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="arquivos/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="arquivos/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="arquivos/js/plugins/popupoverlay/defaults.js"></script>   
    <script src="arquivos/js/flex.js"></script>
    <script src="arquivos/js/demo/advanced-form-demo.js"></script>

</body>

</html>
