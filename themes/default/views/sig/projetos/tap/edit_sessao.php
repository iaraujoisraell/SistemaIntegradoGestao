<link href='<?= $assets ?>fullcalendar/css/fullcalendar.min.css' rel='stylesheet' />
<link href='<?= $assets ?>fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href="<?= $assets ?>fullcalendar/css/bootstrap-colorpicker.min.css" rel="stylesheet" />

<style>
    .fc th {
        padding: 10px 0px;
        vertical-align: middle;
        background:#F2F2F2;
        width: 14.285%;
    }
    .fc-content {
        cursor: pointer;
    }
    .fc-day-grid-event>.fc-content {
        padding: 4px;
    }

    .fc .fc-center {
        margin-top: 5px;
    }
    .error {
        color: #ac2925;
        margin-bottom: 15px;
    }
    .event-tooltip {
        width:150px;
        background: rgba(0, 0, 0, 0.85);
        color:#FFF;
        padding:10px;
        position:absolute;
        z-index:10001;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 11px;
    }
</style>

           
                
           
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header"><p class="introtext">EDITAR SESSÃO</p>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="fa fa-2x">&times;</i>
                                </button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="error"></div>
                               <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                                echo form_open_multipart("Projetos/edit_tap_sessao" , $attrib); 
                                echo form_hidden('id', $id);
                                echo form_hidden('documentacao', $documentacao);
                                ?>
                                    
                                    
                                    <div class="form-group">
                                        <?= lang('title', 'title'); ?>
                                         <?php echo form_input('title', (isset($_POST['title']) ? $_POST['title'] : $tap->titulo), 'maxlength="200" class="form-control input-tip" required="required" id="slprojeto"'); ?>
                                    </div>
                                
                               
                                   <div class="form-group">
                                        <?= lang("Somente Imagem", "document") ?> 
                                            <?php if($tap->anexo){ ?>
                                        <div class="btn-group">
                                            <a target="_blanck" href="<?= site_url('../assets/uploads/projetos/' . $tap->anexo) ?>" class="tip btn btn-file" title="<?= lang('Arquivo em Anexo') ?>">
                                                <i class="fa fa-chain"></i>
                                                <span class="hidden-sm hidden-xs"><?= lang('Ver Anexo') ?></span>
                                            </a>
                                                    <?php /* <input type="checkbox"><button type="button" class="btn btn-danger" id="reset"><?= lang('REMOVER') ?> */ ?>
                                        </div>

                                        <?php } ?>
                                       <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" value="<?php echo $tap->anexo; ?>" data-show-upload="false"
                                               data-show-preview="false" class="form-control file">
                                    </div>
                                    
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <?= lang('Largura (%)', 'largura'); ?>
                                         <?php echo form_input('largura', (isset($_POST['largura']) ? $_POST['largura'] : $tap->largura), 'maxlength="3" class="form-control input-tip"  id="largura"'); ?>
                                    </div>
                                        </div>
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                        <?= lang('Altura (%)', 'altura'); ?>
                                         <?php echo form_input('altura', (isset($_POST['altura']) ? $_POST['altura'] : $tap->altura), 'maxlength="3" class="form-control input-tip"  id="altura"'); ?>
                                    </div>
                                        </div>
                                </div>
                       
                                
                                    <div class="form-group">
                                        <?= lang('description', 'description'); ?>
                                        <?php echo form_textarea('descricao', (isset($_POST['descricao']) ? $_POST['descricao'] : $tap->descricao), 'class="form-control" id="slcomentarioIndicadores"  style="margin-top: 10px; height: 150px;"'); ?>
                                    </div>
                       
                                        <div class="fprom-group">
                                        <?php echo form_submit('add_projeto', lang("Salvar"), 'id="add_projeto" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;"'); ?>
                                            <a  class="btn btn-danger" href="<?= site_url('projetos/tap/'.$documentacao); ?>"><?= lang('Voltar') ?></a>
                                </div>
                                    <?php echo form_close(); ?>
                            </div>
                           
                        </div>
                    </div>
               
           

<script type="text/javascript">
    var currentLangCode = '<?= $cal_lang; ?>', moment_df = '<?= strtoupper($dateFormats['js_sdate']); ?> HH:mm', cal_lang = {},
    tkname = "<?=$this->security->get_csrf_token_name()?>", tkvalue = "<?=$this->security->get_csrf_hash()?>";
    cal_lang['add_event'] = '<?= lang('add_event'); ?>';
    cal_lang['edit_event'] = '<?= lang('edit_event'); ?>';
    cal_lang['delete'] = '<?= lang('delete'); ?>';
    cal_lang['event_error'] = '<?= lang('event_error'); ?>';
</script>
<script src='<?= $assets ?>fullcalendar/js/moment.min.js'></script>
<script src="<?= $assets ?>fullcalendar/js/fullcalendar.min.js"></script>
<script src="<?= $assets ?>fullcalendar/js/lang-all.js"></script>
<script src='<?= $assets ?>fullcalendar/js/bootstrap-colorpicker.min.js'></script>
<script src='<?= $assets ?>fullcalendar/js/main.js'></script>
