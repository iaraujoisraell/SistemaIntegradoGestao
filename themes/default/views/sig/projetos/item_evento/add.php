<script>

    $("#dateInicial").datetimepicker({
                format: site.dateFormats.js_ldate,
                fontAwesome: true,
                language: 'sma',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0
            }).datetimepicker('update', new Date());
            
            $(document).ready(function() {
    $('.btn-theme').click(function(){
        $('#aguarde, #blanket').css('display','block');
    });
    
});

 $(document).on('change', '#dateInicial', function (e) {
            localStorage.setItem('dateInicial', $(this).val());
        });
</script>
<script>
     if (localStorage.getItem('dateFim')) {
                localStorage.removeItem('dateFim');
            }
            
        if (!localStorage.getItem('dateFim')) {
            $("#dateFim").datetimepicker({
                format: site.dateFormats.js_ldate,
                fontAwesome: true,
                language: 'sma',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0
            }).datetimepicker('update', new Date());
        }
            
            $(document).on('change', '#dateFim', function (e) {
            localStorage.setItem('dateFim', $(this).val());
        });
        if (sldate = localStorage.getItem('dateFim')) {
            $('#dateFim').val(sldate);
        }
            
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('Criar Item do Evento'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext"><?php echo lang('enter_info'); ?></p>
                 <div class="row">
                <?php
                $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                echo form_open_multipart("projetos/add_item_evento_form", $attrib);
                echo form_hidden('evento', $id);
                ?>
               
                    <div class="col-lg-12">
                        <div class="col-md-8">
                            <div class="form-group">
                                <?= lang("Evento", "slProjeto"); ?>
                                    <?php
                                    $wu3[''] = '';
                                    echo form_dropdown('Evento_descricao', $projetos->nome_evento.' - De :'.$this->sma->hrld($projetos->data_inicio).'  Até :'.$this->sma->hrld($projetos->data_fim), (isset($_POST['projeto']) ? $_POST['projeto'] : $projetos->projeto .' - Dt Início :'.$projetos->dt_inicio), 'id="slProjeto" required="required" class="form-control  select" data-placeholder="' . lang("Selecione") . ' "  style="width:100%;" ');
                                    
                                   // echo $projetos->projeto;
                                    ?>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-lg-12">
                    <div class="col-md-8">
                            <div class="form-group">
                                <?= lang("Descrição", "slprojeto"); ?>
                                <?php echo form_input('descricao', (isset($_POST['descricao']) ? $_POST['descricao'] : $slnumber), 'maxlength="500" class="form-control input-tip" required="required" id="slprojeto"'); ?>
                            </div>
                        </div>
                    </div>
                    <?php //$date_inicio = "01/02/2018 09:00:00";
                            //$date_fim = "30/12/2019 17:00:00";?>
                    <div class="col-lg-12">
                        <div class="col-sm-4">
                                <div class="form-group">
                                 <?= lang("Data Início", "start_date"); ?>
                                    <input type="date" name="dateInicial" class="form-control">
                                 </div>
                        </div>
                        <div class="col-sm-4">
                               <div class="form-group">
                                 <?= lang("Data Término", "dateEntregaDemanda"); ?>
                                   <input type="date" name="dateFim" id='dateFim' class="form-control">
                                  </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12">    
                     <div class="col-md-2">
                            <div class="form-group">
                                <?= lang("Horas Previstas", "sltipo"); ?>
                                <input type="number" name="horas" id='horas' class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">    
                    

                        <div class="row" id="bt">
                            <div class="col-md-12">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <?= lang("Observação", "slnote"); ?>
                                        <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ""), 'class="form-control" id="slnote" style="margin-top: 10px; height: 100px;"'); ?>

                                    </div>
                                </div>
                       


                            </div>

                        </div>
                        <div class="col-md-12">
                            <div
                                class="fprom-group"><?php echo form_submit('add_projeto', lang("submit"), 'id="add_projeto" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;"'); ?>
                                <a  class="btn btn-danger"   href="<?= site_url('Projetos/Item_evento_index/'.$id); ?>"> <div ><?= lang('Sair ') ?></div>  </a></div>
                        </div>
                    </div>
                
                

                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
</div>


