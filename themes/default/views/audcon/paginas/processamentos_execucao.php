<meta http-equiv="refresh" content="10">
<style>
    #blanket,#aguarde {
    position: fixed;
    display: none;
}

#blanket {
    left: 0;
    top: 0;
    background-color: #f0f0f0;
    filter: alpha(opacity =         65);
    height: 100%;
    width: 100%;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=65)";
    opacity: 0.65;
    z-index: 9998;
}

#aguarde {
    width: auto;
    height: 30px;
    top: 40%;
    left: 45%;
    background: url('http://i.imgur.com/SpJvla7.gif') no-repeat 0 50%; 
    line-height: 30px;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    z-index: 9999;
    padding-left: 27px;
}
</style> 
<script>
    
    
    function executaRegra(id, regra, status, total_registro, executar) {
      $.ajax({
        type: "POST",
        url: "../../../processa_regra.php",
        data: {
          id: id,
          regra: regra,
          status: status,
          total_registro: total_registro,
          executar: executar
          
          //data_vencimento: $('#input_id_data_vencimento').val()
        },
        success: function(data) {
          $('#conteudo'+regra).html(data);
        }
      });
     
    }



 
</script>



<script>
   


//var auto_refresh = setInterval(
//function ()
//{
//$('#setTime').load('../../../visualiza_andamento_regra.php').fadeIn("slow");
//}, 5000);

</script>


<body class="hold-transition sidebar-collapse sidebar-mini">
    <div class="wrapper">
 <?php  $processos_analises = $this->AudCon_model->getProcessosAnalisesById($id); ?>
  
<?php $analises = $this->AudCon_model->getAnaliseById($processos_analises->analise); ?>
        <?php $clientes = $this->AudCon_model->getClienteById($analises->cliente); ?>
                  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Acompanhamento do Processamento das Análises</h1>
        
        <h3><?php echo   $clientes->company; ?><small><?php $status = $analises->status;  if($status == 0){ ?> ABERTO  <?php }else if($status == 1){ ?> EM ANÁLISE <?php }else if($status == 2){ ?> CONCLUÍDO  <?php }  ?></small>
      </h3>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Análise</li>
      </ol>
    </section>
    <div id="blanket"></div>
 <div id="aguarde">Aguarde...Processamento em Andamento</div>
    <!-- Main content -->
    <section class="content">
         <?php if ($Settings->mmode) { ?>
                        <div class="alert alert-warning">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <?= lang('site_is_offline') ?>
                        </div>
                    <?php }
                    if ($error) { ?>
                        <div class="alert alert-danger">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $error; ?></ul>
                        </div>
                    <?php }
                    if ($message) { ?>
                        <div class="alert alert-success">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <ul class="list-group"><?= $message; ?></ul>
                        </div>
                    <?php } ?>
      <!-- Small boxes (Stat box) -->
      <br><br>
                  
        <div class="row">
        
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Processamentos das Regras </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Regra</th>
                  <th>T. Registros</th>
                  <th>Reg. Analisados</th>
                  <th>Inconsistências</th>
                  <th>Valor </th>
                  <th>Andamento da processo de análise</th>
                  <th>Tempo</th>
                  <th>Status</th>
                  <th>Opções</th>
                </tr>
                </thead>
               
                   
                       
                <tbody>
                
                <?php
                    $cont = 1;                            
                   $analises_processos = $this->AudCon_model->getRegrasAnaliseProcessosByProcessos($id);
                    foreach ($analises_processos as $pro) {
                    
                        $regra = $this->AudCon_model->getRegrasBySessao($pro->id_regra);
                        $regra_descricao = $regra->descricao;
                        
                        $status = $pro->status; 
                        
                            $parte_dt_inicio = explode(" ", $pro->data_hora_inicio);
                            $data_inicio = $parte_dt_inicio[0];
                            $hora_inicio = $parte_dt_inicio[1];
                        
                            $parte_dt_fim = explode(" ", $pro->data_hora_fim);
                            $data_fim = $parte_dt_fim[0];
                            $hora_fim = $parte_dt_fim[1];
                            
                            $dtHoje = date("Y-m-d H:i:s");
                            $parte_dt_agora = explode(" ", $dtHoje);
                            $data_agora = $parte_dt_agora[0];
                            $hora_agora = $parte_dt_agora[1];
                            
                        if($status == 0){
                            $status_descricao = "ABERTO";
                            $cor = "primary";
                            $titulo = 'EXECUTAR';
                            $disabled = "";
                            $executar = 0;
                            $tempo_execucao = "";
                            
                        }else if($status == 1){
                            $status_descricao = "PROCESSANDO";
                            $cor = "warning";
                            $titulo = 'PROCESSANDO';
                            $disabled = "disabled";
                            $executar = 1;
                            
                           
                            $parte_dt_fim = explode(" ", $pro->data_hora_fim);
                            $data_fim = $parte_dt_fim[0];
                            $hora_fim = $parte_dt_fim[1];
                           
                            $dtHoje = date("Y-m-d H:i:s");
                            $parte_dt_agora = explode(" ", $dtHoje);
                            $data_agora = $parte_dt_agora[0];
                            $hora_agora = $parte_dt_agora[1];
                            
                            $tempo_execucao = gmdate('H:i:s', strtotime( $hora_agora ) - strtotime( $hora_inicio ) );
                            
                            $tempo_diferenca = gmdate('H:i:s', strtotime( $hora_agora ) - strtotime( $hora_fim ) );
                            
                            if($tempo_diferenca >= '00:00:10'){
                             ?>    
                        <script>
                        executaRegra(<?php echo $pro->id; ?>,<?php echo $pro->id_regra; ?>, <?php echo $pro->status; ?>, <?php echo $processos_analises->num_registros; ?>, 1);
                        </script>
                    
                            <?php   
                            }
                            
                            
                        }else if($status == 2){
                            $status_descricao = "CONCLUÍDO";
                            $cor = "success";
                            $titulo = 'CONCLUÍDO';
                            $disabled = "disabled";
                            $executar = 0;
                            	
                            $tempo_execucao = gmdate('H:i:s', strtotime( $hora_fim ) - strtotime( $hora_inicio ) );
                            
                        }
                        
                        
                        //$total_registro_teste = 30000;
                        $porcentagem2 = ($pro->andamento * 100)/$processos_analises->num_registros;
                        $porcentagem = substr($porcentagem2, 0, 5); 
                    ?>   
  
                        <tr>
                          <td><?php echo $pro->id_regra.' - '.$regra_descricao; ?></td>  
                          <td><?php echo $processos_analises->num_registros; ?></td>
                          <td><?php echo $pro->andamento; ?></td>
                          <td><?php echo $pro->quantidade; ?></td>
                          <td><?php if($pro->valor_referente){ echo number_format($pro->valor_referente,2,",","."); } ?></td>
                          <td>
                              <div id="conteudo<?php echo $pro->id_regra; ?>">
                              <div class="progress">
                                  <div class="progress-bar progress-bar-success " role="progressbar" aria-valuenow="<?php echo $pro->andamento; ?>" aria-valuemin="0" aria-valuemax="<?php echo $processos_analises->num_registros; ?>" style="width: <?php echo $porcentagem; ?>%">
                                 <?php echo  $porcentagem.'%'; ?>   
                                </div>
                              </div>
                              </div>
                          </td>
                          <td><?php echo $tempo_execucao; ?></td>
                          <td>
                              <a class="btn btn-block btn-<?php echo $cor; ?>" <?php echo $disabled; ?>   onclick="executaRegra(<?php echo $pro->id; ?>,<?php echo $pro->id_regra; ?>, <?php echo $pro->status; ?>, <?php echo $processos_analises->num_registros; ?>, 1); location.reload();" > <?PHP ECHO  $titulo; ?> </a> 
                          <!--    <a class="btn btn-block btn-<?php //echo $cor; ?>"    onclick="executaRegra(<?php // echo $pro->id; ?>,<?php //echo $pro->id_regra; ?>, <?php //echo $pro->status; ?>, <?php //echo $processos_analises->num_registros; ?>, 1); location.reload();" > <i class="fa fa-refresh"></i></a> -->
                          </td>

                        </tr>
                    <?php
                    }
                    ?>
               
               
                
                </tbody>
                
               
                <tfoot>
                <tr>
                  <th>Regra</th>
                  <th>T. Registros</th>
                  <th>Reg. Analisados</th>
                  <th>Inconsistências</th>
                  <th>Valor </th>
                  <th>Andamento da processo de análise</th>
                  <th>Tempo</th>
                  <th>Status</th>
                  <th>Opções</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        
              
      </div>
      
      
      <!-- /.row -->
      <!-- Main row -->
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 </div>

</body>
<script>
     function alertas(){
         
    
    document.getElementById('blanket').style.display = 'block';
    document.getElementById('aguarde').style.display = 'block';
   
    
    }
    </script>
