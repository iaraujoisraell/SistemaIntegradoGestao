<!DOCTYPE html>
<html lang="en">

<?php include './head.php'; 





?>

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

        <!-- begin MAIN PAGE CONTENT -->
        <div style="height: 700px;" id="page-wrapper">

            <div class="page-content">
               <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>AVALIAÇÃO PRÁTICA 
                                <small>PARA ENGENHEIRO DE SOFTWARE</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li><a class="btn btn-default" href="index.php"><i class="fa fa-calendar"></i> 1 - Cálculo da dívida atualizada de uma parcela de contrato. </a>
                                </li>
                                <li> <a class="btn btn-success" href="pacientes.php"><i class="fa fa-users"></i> 2 - Registros de pacientes para atendimento hospitalar. </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                    <div class="col-lg-12">
                        <div class="row">
                            <button style="margin-bottom: 20px;" type="button" class="btn btn-white" data-toggle="modal" data-target="#modal-insert">
                            Novo Cadastro
                        </button>
                            
                         <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Registros de paciêntes para atendimento hospitalar</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NOME</th>
                                                <th>CPF</th>
                                                <th>DATA NASCIMENTO</th>
                                                <th>EDITAR</th>
                                                <th>EXCLUIR</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            class MyDB extends SQLite3 {
                                          function __construct() {
                                             $this->open('db/pacientes.db');
                                          }
                                       }
   
                                   $db = new MyDB();
                                   if(!$db) {
                                      echo $db->lastErrorMsg();
                                   } else {
                                     // echo "Opened database successfully\n";
                                   }
                                  $sql =<<<EOF
                                      SELECT * from PACIENTES ORDER BY NOME ASC; 
EOF;
                                   $cont_id = 1;
                                   $ret = $db->query($sql);
                                   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
     
                                           
                                            
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $cont_id++; ?></td>
                                                <td><?php echo $row['NOME']; ?></td>
                                                <td><?php echo mask($row['CPF'],'###.###.###-##'); ?></td>
                                                <td class="center"><?php echo date("d/m/Y", strtotime($row['DTNASCTO'])); ?></td>
                                                <td><a href="editarPaciente.php?cpf=<?php echo $row['CPF'] ?>"><i class="fa fa-edit"></i></a></td>
                                               <td><a href="app/processaPacientes.php?tipo=delete&cpf=<?php echo $row['CPF'] ?>"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                           <?php
                                            
                                   }

                                   $db->close();
                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                      
                    </div>
                </div>
            </div>
            
        </div>
        <script>
             function maskCPF(CPF) {
                var evt = window.event;
                kcode=evt.keyCode;
                if (kcode == 8) return;
                if (cpfPaciente.value.length == 3) { cpfPaciente.value = cpfPaciente.value + '.'; }
                if (cpfPaciente.value.length == 7) { cpfPaciente.value = cpfPaciente.value + '.'; }
                if (cpfPaciente.value.length == 11) { cpfPaciente.value = cpfPaciente.value + '-'; }
                
                //SOMENTE NUMERO
                var tecla=(window.event)?event.keyCode:e.which;   
                if((tecla>47 && tecla<58)) return true;
                else{
                    if (tecla==8 || tecla==0) return true;
                    else  return false;
                }
         }
         
        </script>
        
        <div class="modal fade" id="modal-insert">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro de Paciênte</h4>
              </div>
                <form action="app/processaPacientes.php?tipo=insert" method="POST">  
                  <div class="modal-body">
                    <h4>CPF </h4>
                    <input style="text-transform: uppercase" type="text" placeholder="999.999.99-99"  class="form-control" required="true"  maxlength="14" id="cpfPaciente" name="cpfPaciente" onKeyPress="return maskCPF(event); "  />
                    <h4>Nome </h4>
                    <input type="text" placeholder="Nome Completo" class="form-control" required="true" maxlength="40" id="nomePaciente" name='nomePaciente'  />
                     <h4>Data de Nascimento</h4>
                    <input  type="date" class="form-control" required="true"  maxlength="8" id="input_id_data_vencimento" name="dtNascimento"/>

                    <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                  </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
        
        <div class="modal fade" id="modal_edit">
            
        </div>

    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- jQuery UI added before Bootstrap on this page for no interference -->
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="arquivos/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="arquivos/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="arquivos/js/plugins/popupoverlay/jquery.popupoverlay.js"></script>
    <script src="arquivos/js/plugins/popupoverlay/defaults.js"></script>   
     <script src="arquivos/js/plugins/hisrc/hisrc.js"></script>
    <script src="arquivos/js/demo/advanced-form-demo.js"></script>
    <script src="arquivos/js/plugins/datatables/jquery.dataTables.js"></script>
     <script src="arquivos/js/plugins/datatables/datatables-bs3.js"></script>
     <script src="arquivos/js/flex.js"></script>
      <script src="arquivos/js/demo/advanced-tables-demo.js"></script>
    


</body>

</html>
