<?php




if(empty($_POST['data_vencimento'])){
   
    for($i =1; $i < 20; $i++){
  
  echo ' <h3 style="color: red;"> '.$i.' </h3>';
} 
    die();

    
    
    }else{
    $data_vencimento = $_POST['data_vencimento'];  
    
    $data = explode("-","$data_vencimento"); // fatia a string $dat em pedados, usando / como referência
	$d = $data[2];
	$m = $data[1];
	$y = $data[0];
        
        if(($y < 1998) || ($y > 2028)){
            echo '<h3 style="color: red;"> INFORME O ANO DA DATA VÁLIDO!</h3>';
          die();
        }
        // verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = checkdate($m,$d,$y);
	if ($res == 0){
	  echo '<h4 style="color: red;"> INFORME UMA DATA DE VENCIMENTO VÁLIDA!</h4>';
          die();
	}else{
            // a data está ok
        }
        
}

if(empty($_POST['valor_parcela'])){
    echo '<h3 style="color: red;"> INFORME O VALOR DA PARCELA </h3>';
    die();
}else{
    $valor_parcela = $_POST['valor_parcela'];    
}

//DATA ATUAL  - HOJE
$data_hoje = date('Y-m-d');

//Verifica se deve calcular juros ou desconto
if($data_vencimento < $data_hoje){
    calculaJurosDesconto($data_vencimento, $data_hoje, $valor_parcela, 1);   
}else if($data_vencimento > $data_hoje){
    calculaJurosDesconto($data_vencimento, $data_hoje, $valor_parcela, 2);   
}else{
   echo '<h3> <font style="color: blue;"> Olá, temos uma ótima notícia para você! </font> <br> <font style="color: red;">Sua fatura VENCE HOJE!</font> <br> <font style="color: blue;">Não deixe atrasar! </font></h3><br>';
}




function calculaJurosDesconto($dataVencimento, $dataHoje, $vlParcela,$tipo){
    $taxaJurosDia = 0.00367;
    $taxaDescontoDia = 0.0005;
    /*
     * CALCULA A DIFERENÇA DE DIAS ENTRE A DATA DE HOJE E A DATA DO VENCIMENTO
     */
    $dtHoje = date_create($dataHoje);  //date_create(), FUNÇÃO PHP, DA CLASSE DATE();
    $dtVencimento = date_create($dataVencimento);
    $diferencaDias = date_diff($dtHoje,$dtVencimento);
    $difDiasFormatado = $diferencaDias->format("%a");
    
    /*
     * SE O TIPO =1, CALCULA O JUROS
     */
    if($tipo == 1){
    /*
     * CALCULA O JUROS DA PARCELA BASEADO NA DIFERENÇA DE DIAS
     */
    $vlJuros = $difDiasFormatado * $taxaJurosDia * 100;
    /*
     * CALCULA O VALOR ATUALIZADO
     */ 
    $vlParcelaVencida_php = str_replace(',', '.', str_replace('.', '', $vlParcela));
    $vlAtualizadoComJuros = $vlParcelaVencida_php + $vlJuros;
    
    echo '<br><br>';
    echo '<h4> Dias de atraso : '. $difDiasFormatado.'</h4> ';
    echo '<h4 style="color: red;">Valor do Juros R$: '. number_format($vlJuros, 2, ',', '.') .'</h4>';
    echo '<h4>Valor Atualizado R$: '. number_format($vlAtualizadoComJuros, 2, ',', '.') .'</h4><br>';
    die();
    
    /*
     * SE O TIPO = 2, CALCULA O DESCONTO
     */
    }else if($tipo == 2){
        /*
     * CALCULA O DESCONTO DA PARCELA BASEADO NA DIFERENÇA DE DIAS
     */
    $vlDesconto = $difDiasFormatado * $taxaDescontoDia * 100;
    /*
     * CALCULA O VALOR ATUALIZADO
     */ 
    $vlParcelaVencer_php = str_replace(',', '.', str_replace('.', '', $vlParcela));
    $vlAtualizadoComDesconto = $vlParcelaVencer_php - $vlDesconto;
    
    echo '<br><br>';
    echo '<h3> Dias para o Vencimento : '. $difDiasFormatado.'</h3> ';
    echo '<h3 style="color: blue;">Valor do Desconto : R$ '. number_format($vlDesconto, 2, ',', '.') .'</h3>';
    echo '<h3>Valor Atualizado :  R$ '. number_format($vlAtualizadoComDesconto, 2, ',', '.') .'</h3><br>';
    die();
    }

}


?>