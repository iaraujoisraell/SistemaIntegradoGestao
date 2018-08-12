<?php
//include '../head.php';
$id_regra = $_GET['id'];

echo $id_regra;
?>

<div class="modal-dialog">
            <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Cadastro de Condição para Regra<?php echo $id_regra; ?></h4>
        </div>
                <form method="POST" action="add_condicao">
        <div class="modal-body">
           

         

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group company">
                        Valor Cliente
                        <input type="text" name="v_empresa">
                    </div>
                    <div class="form-group person">
                        Operador
                        <input type="text" >
                    </div>
                    <div class="form-group">
                        Valor Esperado
                       <input type="text" >
                    </div>
                    <div class="form-group">
                        Resultado
                        <input type="text" >
                    </div>
                    
                    
                  
                    
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="submit">Enviar</button>
        </div>
                     </form>
    </div>
   
            <!-- /.modal-content -->
          </div>
<?php
//include '../footer.php';

?>
