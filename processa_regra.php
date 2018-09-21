<?php
include('db_connection.php');

if(!empty($_POST['id'])){
    $id_processo_regra = $_POST['id']; 
}

if(!empty($_POST['regra'])){
    $regra = $_POST['regra'];  
}

if(!empty($_POST['status'])){
    $status = $_POST['status']; 
}

if(!empty($_POST['total_registro'])){
    $total_registro = $_POST['total_registro']; 
}

if(!empty($_POST['executar'])){
    $executar = $_POST['executar']; 
}else{
    $executar = 0;
}




?>

<script>
      //  window.setInterval(executaRegra(<?php echo $id_processo_regra ?>,<?php echo $regra ?>, <?php echo $status ?>, <?php echo $total_registro ?>, <?php echo $executar ?>), 1000);
    </script>

<?php
/*
 * DADOS DA TABELA PROCESSO ANALISE REGRAS
 */    
$sql = "select * from sma_risk_processo_analise_regras where id = $id_processo_regra";
$result = $link->query($sql);
$row = $result->fetch_assoc();
$status_andamento = $row["status"];
$andamento = $row["andamento"];
$id_processo = $row["id_processo_analise"];

/*
 * VERIFICA DADOS DA TABELA PROCESSOS
 */ 
$sql_p = "select * from sma_risk_processo_analise where id = $id_processo";
$result_p = $link->query($sql_p);
$row_p = $result_p->fetch_assoc();
$id_analise = $row_p["analise"];

/*
 * VERIFICA DADOS DA TABELA ANÁLISE
 */ 
$sql_a = "select * from sma_risk_analises where id = $id_analise";
$result_a = $link->query($sql_a);
$row_a = $result_a->fetch_assoc();
$tabela_cliente = $row_a["tabela"];
$tabela_log_cliente = $row_a["tabela_log"];


date_default_timezone_set('America/Manaus');
$dtHoje = date("Y-m-d H:i:s");
$dataHoje = date("Y-m-d");



//$total = "30000";

if ($status_andamento == 0){  
    
  
    $sql = "UPDATE sma_risk_processo_analise_regras SET status= 1, data_hora_inicio = '$dtHoje'  WHERE    id ='$id_processo_regra'";
    mysqli_query($link, $sql);
  
        
    $sql_banco_cliente = "SELECT * FROM sma_$tabela_cliente limit $total_registro";
    $result_banco_cliente = $link->query($sql_banco_cliente);
    $cont_andamento = 0;
    
}else if($status_andamento == 1){
    
    $sql_banco_r = "SELECT * FROM sma_risk_processo_analise_regras where id = $id_processo_regra ";
    $result_banco_r = $link->query($sql_banco_r);
    $row_r = $result_banco_r->fetch_assoc();
    $andamento = $row_r["andamento"];
    
    
    $diferenca_rowns = $total_registro - $andamento;
    
    $sql_banco_cliente = "SELECT * FROM sma_$tabela_cliente limit $andamento, $diferenca_rowns";
    $result_banco_cliente = $link->query($sql_banco_cliente);
    $cont_andamento = $andamento;
    
}
   
    
    
    
    if ($result_banco_cliente->num_rows > 0) {
        while($row_cliente = $result_banco_cliente->fetch_assoc()) {

           $id = $row_cliente["id"];
           $guia = $row_cliente["guia"];
           $cod_servico =  $row_cliente["codigo_servico"];  //TUSS
           $qtde = $row_cliente["quantidade"];
           $vl_procedimento = $row_cliente["valor_procedimento"];
           $competencia = $row_cliente["competencia"];
           $codigo_prestador = $row_cliente["codigo_prestador"];

           //BENEFICIÁRIO
           $tipo_procedimento_cliente = $row_cliente["carater_atendimento"]; //34 - TIPO/CARATER PROCEDIMENTO
           $regime_atendimento = $row_cliente["regime_atendimento"]; //35 - REGIME_ATENDIMENTO
           $cirurgico_cliente = $row_cliente["cirurgico"]; //38 - CIRURGICO
           $sexo_beneficiario = $row_cliente["sexo_beneficiario"]; //45 - SEXO
           $dt_nascimento_beneficiario = $row_cliente["dt_nascimento"]; //47 - IDADE MÍNIMA  /   48 - IDADE MÁXIMA
           /*
            * CALCULA A IDADE
            */
           $parte_dt_agora = explode("-", $dt_nascimento_beneficiario);
           $ano = $parte_dt_agora[0];
           $mes = $parte_dt_agora[1];
           $dia = $parte_dt_agora[2];

            // Descobre que dia é hoje e retorna a unix timestamp
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            // Descobre a unix timestamp da data de nascimento do fulano
            $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

            // Depois apenas fazemos o cálculo já citado :)
            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
           
          
          

           $quantidade_procedimento = $row_cliente["quantidade"]; //51 - QUANTIDADE

           /*
            * BANCO DE REGRAS TUSS
            * 
            */
           $sql_banco_regras = "SELECT * FROM sma_risk_modulo_4_6 WHERE id_termo = $cod_servico ";
           $result_banco_regras = $link->query($sql_banco_regras);
            if ($result_banco_regras->num_rows > 0) {
               $row_banco_regra = $result_banco_regras->fetch_assoc();
               
               $rol = substr($row_banco_regra["rol"], 0, 3); //Regra 23 - ROL       
               $tipo_procedimento = $row_banco_regra["tipo_procedimento"];//REGRA 34 - TIPO/CARATER PROCEDIMENTO
               $cirurgico = $row_banco_regra["cirurgico"]; //REGRA 38 - CIRURGICO
               $sexo = $row_banco_regra["sexo"]; // REGRA 45 - SEXO
               $idade_minima = $row_banco_regra["idade_min"]; //REGRA 47 - IDADE MÍNIMA
               $idade_maxima = $row_banco_regra["idade_max"]; //REGRA 48 - IDADE MÁXIMA
               $quantidade = $row_banco_regra["quantidade"]; //REGRA 51 - QUANTIDADE
            }   
               
               
            /*
            * INÍCIO REGRA 23 - CONSTA NO ROL
            */

            if($regra == 23){
                if($rol == "SIM"){
                //CASO NÃO CONSTE, VERIFICA A QUANTIDADE REALIZADA
                }else{
                    if($qtde > 0){
                        //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA
                        $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','SIM','$rol','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                }   
                
                
                
           /*
            * FIM REGRA 23 - CONSTA NO ROL
            */   
            }else
            
          /*
          * INÍCIO REGRA 34 - TIPO/CARATER PROCEDIMENTO
           * U = URGENTE
           * E = ELETIVO
           * A = AMBOS
           * NC = NÃO COBERTO
          */
         if($regra == 34){
             
               /*
                * verifica o tipo de procedimento
                */
               if($tipo_procedimento == "NC"){
                   
                    if($qtde > 0){
                        //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA
                        $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$tipo_procedimento_cliente','$tipo_procedimento','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                      
                   }
                    
               }else if($tipo_procedimento == "E"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "E", COMPARA COM A BASE DO CLIENTE SE É 'U OU A'
                   
                    if($tipo_procedimento_cliente == "U"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA
                            $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$tipo_procedimento_cliente','$tipo_procedimento','$vl_procedimento','$qtde','$regra')";
                            mysqli_query($link, $sql_insert_inconsistencia);
                            
                           }
                    }
                }else if($tipo_procedimento == "U"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "U", COMPARA COM A BASE DO CLIENTE SE É 'E OU A'
                   
                    if($tipo_procedimento_cliente == "E"){
                    
                        if($qtde > 0){
                            $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$tipo_procedimento_cliente','$tipo_procedimento','$vl_procedimento','$qtde','$regra')";
                            mysqli_query($link, $sql_insert_inconsistencia);
                               
                        }
                    }
                }
                  
         /*
          * FIM REGRA 34 - TIPO PROCEDIMENTO
          */
        }else
            
            
          /*
           * INÍCIO REGRA 35 - REGIME DE ATENDIMENTO
           * 1 = AMBULATORIAL
           * 2 = INTERNACAO
           * 3 = AMBOS
           * 4 = HOSPITAL DIA
           * NC = NÃO COBERTO
          */
         if($regra == 35){
             /*
            
               
               /*
                * verifica o tipo de procedimento
                
               if($tipo_procedimento == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $data_inconsistencia = array(
                        'processo_analise' => $processo,
                        'id_base_cliente' => $id,
                        'valor_cliente' => $tipo_procedimento_cliente,
                        'valor_regra' => $tipo_procedimento,
                        'valor_inconsistencia' => $vl_procedimento,
                        'quantidade' => $qtde,   
                        'id_regra' => $regra
                        );
                      $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                   }
                    
               }else if($tipo_procedimento == "A"){
                 //ACEITA TIPO E,U
                   
                   
                }else if($tipo_procedimento == "E"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "E", COMPARA COM A BASE DO CLIENTE SE É 'U OU A'
                   
                    if(($tipo_procedimento_cliente == "U")||$tipo_procedimento_cliente == "A"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                           }
                    }
                }else if($tipo_procedimento == "U"){
                 //SE O TIPO DO PROCEDIMENTO FOR DO TIPO "U", COMPARA COM A BASE DO CLIENTE SE É 'E OU A'
                   
                    if(($tipo_procedimento_cliente == "E")||$tipo_procedimento_cliente == "A"){
                    
                        if($qtde > 0){
                               //CASO TENHA REGISTRO MAIOR QUE 0, REGISTRA A INCONSISTENCIA

                               $data_inconsistencia = array(
                                'processo_analise' => $processo,
                                'id_base_cliente' => $id,
                                'valor_cliente' => $tipo_procedimento_cliente,
                                'valor_regra' => $tipo_procedimento,
                                'valor_inconsistencia' => $vl_procedimento,
                                'quantidade' => $qtde,   
                                'id_regra' => $regra
                                );
                              $this->AudCon_model->addLogInconsistencia($data_inconsistencia);
                           }
                    }
                
            }   
              * FIM DA REGRA 35 - REGIME DE ATENDIMENTO
              */      
        }else
            
          /*
          * INÍCIO REGRA 38 - CIRURGICO
           * S = SIM
           * N = NÃO
           * NC = NÃO COBERTO
          */
         if($regra == 38){
             
               /*
                * verifica o tipo de procedimento
                */
               if($cirurgico == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                        $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$cirurgico_cliente','$cirurgico','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                       
                   }
                    
               }else if($cirurgico == "S"){
                 //SE A REGRA DIZ SIM E NA BASE DO CLIENTE DIZER NÃO, REGISTRA A INCONSISÊNCIA
                   if($cirurgico_cliente == "N"){
                       if($qtde > 0){
                       
                        $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$cirurgico_cliente','$cirurgico','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                   }
                   
                }else if($cirurgico == "N"){
                  //SE NÃO FOR UM PROCEDIMENTO CIRÚRGICO MAS NA BASE DO CLIENTE DIZ QUE SIM, REGISTRA A INCONSISÊNCIA
                   
                    if($cirurgico_cliente == "S"){
                       if($qtde > 0){
                        $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$cirurgico_cliente','$cirurgico','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                   }
                    
                }
            
             
             // FIM REGRA 38 - CIRURGICO
         }else
          /*
          * INÍCIO REGRA 45 - SEXO
           * M = MASCULINO
           * F = FEMININO
           * A = AMBOS 
           * NC = NÃO COBERTO PELO ROL
          */
         if($regra == 45){
             
             /*
                * verifica o tipo de procedimento
                */
               if($sexo == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$sexo_beneficiario','$sexo','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                   }
                    
               }else if($sexo == "M"){
                 //SE A REGRA DIZ M E NA BASE DO CLIENTE DIZ F, REGISTRA A INCONSISÊNCIA
                   if($sexo_beneficiario == "F"){
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                            $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$sexo_beneficiario','$sexo','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                        
                       
                    }
                   }
                   
                }else if($sexo == "F"){
                  //SE A REGRA DIZ F E NA BASE DO CLIENTE DIZ M, REGISTRA A INCONSISÊNCIA
                   
                    if($sexo_beneficiario == "M"){
                       if($qtde > 0){
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$sexo_beneficiario','$sexo','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                   }
                    
                }
            
             
             // FIM REGRA 45 - SEXO
         
            
             
             
         }else 
             
          /*
          * INÍCIO REGRA 47 - IDADE MÍNIMA
          */
             
         if($regra == 47){
             
             /*
                * verifica o tipo de procedimento
                */
               if($idade_minima == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$idade','$idade_minima','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                       
                   }
                    
               }else if($idade < $idade_minima  ){
                 //SE A IDADE DO BENEFICIÁRIO FOR MAIOR QUE A IDADE PERMITIDA, VERIFICA SE FOI REALIZADO ALGUM PROCEDIMENTO
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, REGISTRA A INCONSISTÊNCIA
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$idade','$idade_minima','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                   
                   
                }
            
             
             // FIM REGRA 47 - IDADE MÍNIMA
         }
               
         /*
          * INÍCIO REGRA 48 - IDADE MÁXIMA
          */
             
         if($regra == 48){
             
             /*
                * verifica o tipo de procedimento
                */
               if($idade_maxima == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$idade','$idade_maxima','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                   }
                    
               }else if($idade > $idade_maxima  ){
                 //SE A IDADE DO BENEFICIÁRIO FOR MAIOR QUE A IDADE PERMITIDA, VERIFICA SE FOI REALIZADO ALGUM PROCEDIMENTO
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, REGISTRA A INCONSISTÊNCIA
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$idade','$idade_maxima','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                   
                   
                }
            
             
             // FIM REGRA 48 - IDADE MÁXIMA
         }
         
         /*
          * INÍCIO REGRA 51 - QUANTIDADE
          */
             
         if($regra == 51){
             
             /*
                * verifica o tipo de procedimento
                */
               if($quantidade == "NC"){
                   
                    if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, SENDO NÃO COBERTO, REGISTRA A INCONSISTÊNCIA
                       
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$quantidade_procedimento','$quantidade','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                   }
                    
               }else if($quantidade_procedimento > $quantidade  ){
                 //SE A IDADE DO BENEFICIÁRIO FOR MAIOR QUE A IDADE PERMITIDA, VERIFICA SE FOI REALIZADO ALGUM PROCEDIMENTO
                       if($qtde > 0){
                       //CASO TENHA PROCEDIMENTOS REALIZADOS, REGISTRA A INCONSISTÊNCIA
                       
                       $sql_insert_inconsistencia = "INSERT INTO sma_$tabela_log_cliente "
                               . "(processo_analise, id_base_cliente, codigo_prestador, valor_cliente, valor_regra,valor_inconsistencia, quantidade,id_regra)"
                               . " VALUES ('$id_processo','$id','$codigo_prestador','$quantidade_procedimento','$quantidade','$vl_procedimento','$qtde','$regra')";
                        mysqli_query($link, $sql_insert_inconsistencia);
                    }
                   
                   
                }
            
             
             // FIM REGRA 51 - QUANTIDADE
         }
                 
           
           $cont_andamento++;
           
           $sql_andamento = "UPDATE sma_risk_processo_analise_regras SET andamento = $cont_andamento WHERE  id ='$id_processo_regra'";
           mysqli_query($link, $sql_andamento);
           
           $data_reg = date("Y-m-d H:i:s");
           $sql_andamento_termino2 = "UPDATE sma_risk_processo_analise_regras SET data_hora_fim = '$data_reg'  WHERE  id = '$id_processo_regra'";
           mysqli_query($link, $sql_andamento_termino2);
        }
    
        /*
         * PEGA A QTDE DE INCONSISTENCIAS ENCONTRADAS
         */
        $sql_inc = "SELECT COUNT(*) as inconsistencias FROM sma_$tabela_log_cliente where processo_analise = $id_processo and id_regra = $regra";
        $result_inc = $link->query($sql_inc);
        $row_a2 = $result_inc->fetch_assoc();
        $qtde_inconsistencias = $row_a2["inconsistencias"];
        
        /*
         * SOMA O VALOR TOTAL DAS INCONSISTENCIAS
         */
        $sql_val = "SELECT SUM(valor_inconsistencia) as valor FROM sma_$tabela_log_cliente where processo_analise = $id_processo and id_regra = $regra";
        $result_val = $link->query($sql_val);
        $row_val = $result_val->fetch_assoc();
        $valor = $row_val["valor"];
        
        /*
         * PORCENTAGEM EM RELACAO AO TOTAL DE REGISTROS
         */
        $porcentagem = ($qtde_inconsistencias * 100)/$total_registro;
        
        
        $sql2 = "UPDATE sma_risk_processo_analise_regras SET  quantidade = $qtde_inconsistencias, valor_referente = '$valor', porcentagem = $porcentagem  WHERE id_processo_analise ='$id_processo' and id_regra = $regra ";
        mysqli_query($link, $sql2);
        
        
        
    ?>
    
<?php      
    $data_termino = date("Y-m-d H:i:s");
    $sql_andamento_termino2 = "UPDATE sma_risk_processo_analise_regras SET data_hora_fim = '$data_termino'  WHERE  id ='$id_processo_regra'";
    mysqli_query($link, $sql_andamento_termino2);
    
} 

$data_termino = date("Y-m-d H:i:s");
$sql_andamento_termino = "UPDATE sma_risk_processo_analise_regras SET status = 2  WHERE  id ='$id_processo_regra'";
mysqli_query($link, $sql_andamento_termino);







?>