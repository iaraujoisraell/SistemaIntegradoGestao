<?php
 /*
  * ABRE A CLASSE DE CONEXAO COM O BANCO
  */
class MyDB extends SQLite3 {
      function __construct() {
         $this->open('../db/pacientes.db');
      }
   }
   
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
     // echo "Opened database successfully\n";
   }
   
   //RECEBE O TIPO DE AÇÃO QUE IRÁ FAZER
  $tipo = $_GET['tipo'];  
  
  /*
   * INSERT
   */
  if($tipo == 'insert'){
     $nome = $_POST['nomePaciente']; 
     $cpf = $_POST['cpfPaciente']; 
     $dtNasc = $_POST['dtNascimento'];
     
     $cpfSoNumeros = str_replace('.', '', $cpf);
     $cpfSoNumeros = str_replace('-', '', $cpfSoNumeros);   
     
     $sql =<<<EOF
      INSERT INTO PACIENTES (CPF,NOME,DTNASCTO)
      VALUES ('$cpfSoNumeros', '$nome', '$dtNasc');
     
EOF;

   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
   } else {
      header('Location: /bemol_atividade_israel_araujo/pacientes.php');
   }
   $db->close();
    
  /*
   * DELETE
   */    
  }else if($tipo == 'delete'){
      
      $cpfPaciente = $_GET['cpf'];  
        
      $sql =<<<EOF
      DELETE from PACIENTES where CPF = "$cpfPaciente";
EOF;
   
   $ret = $db->exec($sql);
   if(!$ret){
     echo $db->lastErrorMsg();
   } else {
      echo $db->changes(), " Record deleted successfully\n";
       header('Location: /bemol_atividade_israel_araujo/pacientes.php');
   }
   
   $db->close();
   
   /*
   * EDITAR
   */
  }else if($tipo == 'edit'){
     
      $cpfOriginal = $_POST['cpfValor']; 
     $nome = $_POST['nomePaciente']; 
     $cpf = $_POST['cpfPaciente']; 
     $dtNasc = $_POST['dtNascimento'];
     
     
     $cpfSoNumeros = str_replace('.', '', $cpf);
     $cpfSoNumeros = str_replace('-', '', $cpfSoNumeros);   
     
     
     
     $sql =<<<EOF
      UPDATE PACIENTES set CPF = $cpfSoNumeros, NOME = "$nome", DTNASCTO = "$dtNasc"  where CPF = $cpfOriginal;
EOF;
   $ret = $db->exec($sql);
   if(!$ret) {
      echo $db->lastErrorMsg();
      ?>
        <script>
       history.go(-1);
        </script>
      <?PHP
   } else {
      echo $db->changes(), " Record updated successfully\n";
      header('Location: /bemol_atividade_israel_araujo/pacientes.php');
   }

  }
  
   
  


?>