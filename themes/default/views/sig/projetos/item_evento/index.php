<?php 

           $usuario = $this->session->userdata('user_id');
           $projetos_usuario = $this->site->getProjetoAtualByID_completo($usuario);
           $projetos_usuario->projeto;        
           
             $evento_selecionado = $this->projetos_model->getEventoByID($id);
?>
    <div class="box">
        
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-calendar-o"></i><?=lang('Evento : '.$evento_selecionado->nome_evento);?>
        </h2>
        
        <div id="eventos_index" class="box-icon">
           <div class="fprom-group">
            <a class="btn btn-primary" href="<?=site_url('projetos/add_item_evento_form/'.$id)?>"> 
             <i class="fa fa-plus-circle"></i>   <?=lang('Itens do Evento')?>
            </a>
          </div>
        </div>
    </div>
    
    <?php if ($Owner || $GP['bulk_actions']) {?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?=form_submit('performAction', 'performAction', 'id="action-form-submit"')?>
    </div>
    <?=form_close()?>
<?php }



?>
        <script>
        $('#idTr').bind('click', function() {
  alert("Linha foi clicada");
});
        </script>
        
        <style>
            table#tableTrClick tr.trClick{background: #000; color: #fff; cursor: pointer;}
table#tableTrClick tr.trClick:hover{background: green; color: #fff; font-weight: bold;}

        </style>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                        <div class="portlet portlet-default">
                         <div style="text-align: right" class="col-lg-12">
                  </div> <?php
                            $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                            echo form_open_multipart("Projetos/Item_eventos_index_form", $attrib);
                             echo form_hidden('id', $id);
                            ?>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                         <tr>
                                       
                                                <th>ID</th>
                                                <th>DESCRIÇÃO</th>
                                               
                                                
                                                <th>Editar</th>
                                                <th>Excluir</th>
                                                </a>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                             <?php
                                                $wu4[''] = '';
                                                $cont = 1;
                                                foreach ($eventos as $evento) {
                                                   
                                               //  $quantidade_acoes = $this->projetos_model->getAcoesEventoByID($evento->id);
                                                ?>   
                                           
                                            <tr   class="odd gradeX">
                                                        <td><?php echo $cont++; ?>   </td> 
                                                        
                                                         <td > 
                                                            <?php echo form_input('descricao'.$evento->id, (isset($_POST['descricao'.$evento->id]) ? $_POST['descricao'.$evento->id] : $evento->descricao), 'maxlength="200" class="form-control input-tip" required="required" id="tipo"'); ?>
                                                        </td>
                                                        
                                                       
                                                        
                                                        <td class="center">
                                                                  <a style="color: #D37423;" class="btn fa fa-edit"  href="<?= site_url('projetos/edit_item_evento/'.$evento->id.'/'.$evento->evento); ?>"></a>
                                              
                                                         </td>
                                                         <td class="center">
                                                           <a style="color: red;" class="btn fa fa-trash-o" href="<?= site_url('projetos/delete_item_eventos/'.$evento->id.'/'.$evento->evento); ?>"></a>
                                                
                                                        </td>
                                            </tr>
                                                <?php
                                                
                                                }
                                                ?>
                                            
                                            
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <center>
                            <div class="col-md-12">
                            <?php echo form_submit('add_item', lang("Atualizar"), 'id="add_item" class="btn btn-success" style="padding: 6px 15px; margin:15px 0;" onclick="javascript:document.getElementById('."blanket".').style.display = "block"; document.getElementById('."aguarde".').style.display = "block";" '); ?>
                            <a  class="btn btn-danger" href="<?= site_url('projetos/Eventos_index/'); ?>"><?= lang('Voltar') ?></a>
                                       
                             </div>
                       
                        </center> 
                        </div>
                        <!-- /.portlet -->

                    </div>
        </div>
    </div>
</div>

