<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Regras de Procedimentos
        <small>Contas Médicas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">SIP</li>
      </ol>
    </section>

    <div class="div-ajax-carregamento-pagina">
        <div class="col-md-12">
          <div class="box box-danger box-solid">
            <div class="box-header">
              <h3 class="box-title">Aguarde</h3>
            </div>
            <div class="box-body">
              Carregando
            </div>
            <!-- /.box-body -->
            <!-- Loading (remove the following to stop the loading)-->
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
            <!-- end loading -->
          </div>
          <!-- /.box -->
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-lg-2">
              <a class="btn btn-block btn-success" href="<?= site_url('AudCon/modulo4/todos'); ?>"><i class="fa  fa-retweet"></i> Todos</a>
          </div>
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="box">
            <div class="box-header">
               
              
            </div>
            <!-- /.box-header -->
             <div class="table-responsive">
              <table  id="example1" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: firebrick; color: #ffffff; text-align: center" >
                      <th colspan="1">TAB TUSS</th>
                      <th colspan="4">MÓDULO 2</th>
                      <th colspan="26">MÓDULO 4 - PARAMETROS TECNICOS DE LIBERAÇÕES DE PROCEDIMENTOS</th>
                      <th colspan="4">MÓDULO 5 - PARÂMETRO DE GESTÃO DE CUSTOS DA OPERADORA</th>
                      <th colspan="5">MÓDULO 6 - PARÂMETROS DE FATURAMENTO DE CONTAS</th>
                      
                  
                </tr>
                <tr style="background-color: darkgrey; text-align: center" >
                  <th><a href="">17</a></th>
                  <th>23</th>
                  <th>30</th>
                  <th></th>
                  <th></th>
                  <th>34</th>
                  <th>35</th>
                  <th>36</th>
                  <th>38</th>
                  <th>39</th>
                  <th>40</th>
                  <th>41</th>
                  <th>42</th>
                  <th>43</th>
                  <th>44</th>
                  <th>45</th>
                  <th>46</th>
                  <th>47</th>
                  <th>48</th>
                  <th>49</th>
                  <th>50</th>
                  <th>51</th>
                  <th>52</th>
                  <th>53</th>
                  <th>54</th>
                  <th>55</th>
                  <th>56</th>
                  <th>57</th>
                  <th>58</th>
                  <th>59</th>
                  <th>62</th>
                  <th>63</th>
                  <th>64</th>
                  <th>65</th>
                  <th>66</th>
                  <th>75</th>
                  <th>76</th>
                  <th>77</th>
                  <th>78</th>
                  <th>79</th>
                 
                  
                </tr>
                <tr style="background-color: orange;">
                  <th>TUSS</th>
                  <th>ROL</th>
                  <th>PAC</th>
                  <th>Grupo CBHPM</th>
                  <th>SubGrupo CBHPM</th>
                  <th>Tipo Proc.</th>
                  <th>Reg. Atend.</th>
                  
                  <th>Justif.</th>
                  <th>Cirurgico</th>
                  <th>Proc. Seriado</th>
                  <th>Nec. Auditoria</th>
                  <th>Nível Autoriz.</th>
                  
                  <th>Prov. Nível Aut.</th>
                  <th>Perícia pré Oper.</th>
                  <th>Nec. Perícia</th>
                  <th>Sexo</th>
                  <th>Prov. Sexo</th>
                  
                  <th>Idade Mín.</th>
                  <th>Idade Máx.</th>
                  <th>Prov. Idade</th>
                  <th>Ocor. Máx.</th>
                  <th>Qtde</th>
                  
                  <th>Prazo Interv.</th>
                  <th>Média Prazo Interv.</th>
                  <th>Qtde Máx. Interv.</th>
                  <th>Prov. Prazo</th>
                  <th>Dias Inter.</th>
                  
                  <th>Dias Prorrog.</th>
                  <th>Tab. Prazo Int. Ev.</th>
                  <th>Omitir Dem.</th>
                  <th>Cód. Incomp.</th>
                  <th>Uso OPME</th>
                  <th>Coberturas</th>
                  <th>Lista Esp.</th>
                  <th>Horário Esp.</th>
                  <th>Perícia Pós Op.</th>
                  
                  <th>Inc. Máx Guia</th>
                  <th>Reg. Prontuário</th>
                  <th>Comporta Cód. Pgto</th>
                  <th>Prov. Falta Aut. Prévia</th>
                  
                  
                </tr>
                </thead>
                <tbody>
                <?php
                                            
                   $modulo4 = $this->AudCon_model->getModulo4($limite);
                    foreach ($modulo4 as $mod) {
                        
                        
                        
                    
                ?>   
                
                <tr>
                  <td><?php echo $mod->id_termo; ?></td>
                  <td><?php echo $mod->rol; ?></td>
                  
                  <td><?php echo $mod->pac; ?></td>
                  <td><?php echo $mod->grupo_cbhpm; ?></td>
                  <td><?php echo $mod->subgrupo_cbhpm; ?></td>
                  <td><?php echo $mod->tipo_procedimento; ?></td>
                  <td><?php echo $mod->regime_atendimento; ?></td>
                  
                  <td><?php echo $mod->justificativa; ?></td>
                  <td><?php echo $mod->cirurgico; ?></td>
                  <td><?php echo $mod->procedimento_seriado; ?></td>
                  <td><?php echo $mod->necessita_auditoria; ?></td>
                  <td><?php echo $mod->nivel_autorizacao; ?></td>
                  
                  <td><?php echo $mod->providencia_nivel_autorizacao; ?></td>
                  
                  <td><?php echo $mod->pericia_pre_operatorio; ?></td>
                  <td><?php echo $mod->necessita_pericia; ?></td>
                  <td><?php echo $mod->sexo; ?></td>
                  <td><?php echo $mod->providencia_sexo; ?></td>
                  <td><?php echo $mod->idade_min; ?></td>
                  
                  <td><?php echo $mod->idade_max; ?></td>
                  
                  <td><?php echo $mod->providencia_idade; ?></td>
                  <td><?php echo $mod->ocorrencia_max; ?></td>
                  <td><?php echo $mod->quantidade; ?></td>
                  
                  <td><?php echo $mod->prazo_intervalar; ?></td>
                  <td><?php echo $mod->medida_prazo_intervalar; ?></td>
                  <td><?php echo $mod->qtd_max_intervalar; ?></td>
                  <td><?php echo $mod->providencia_prazo; ?></td>
                  <td><?php echo $mod->dias_internacao; ?></td>
                  
                  <td><?php echo $mod->dias_prorrogacao; ?></td>
                  
                  <td><?php echo $mod->tab_prazo_intervalar_evento; ?></td>
                  <td><?php echo $mod->omitir_demonstrativo; ?></td>
                  <td><?php echo $mod->codigos_incompativeis; ?></td>
                  <td><?php echo $mod->uso_opme; ?></td>
                  <td><?php echo $mod->coberturas; ?></td>
                  <td><?php echo $mod->lista_espera; ?></td>
                  <td><?php echo $mod->comporta_horario_especial; ?></td>
                  <td><?php echo $mod->pericia_pos_operatoria; ?></td>
                  
                  <td><?php echo $mod->incidencia_maxima_guia; ?></td>
                  <td><?php echo $mod->registro_prontuario; ?></td>
                  <td><?php echo $mod->comporta_codigo_pagto; ?></td>
                  <td><?php echo $mod->providencia_falta_autorizacao_previa; ?></td>
                  
                  
                </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr style="background-color: orange;">
                  <th>TUSS</th>
                  <th>ROL</th>
                  <th>PAC</th>
                  <th>Grupo CBHPM</th>
                  <th>SubGrupo CBHPM</th>
                  <th>Tipo Proc.</th>
                  <th>Reg. Atend.</th>
                  
                  <th>Justif.</th>
                  <th>Cirurgico</th>
                  <th>Proc. Seriado</th>
                  <th>Nec. Auditoria</th>
                  <th>Nível Autoriz.</th>
                  
                  <th>Prov. Nível Aut.</th>
                  <th>Perícia pré Oper.</th>
                  <th>Nec. Perícia</th>
                  <th>Sexo</th>
                  <th>Prov. Sexo</th>
                  
                  <th>Idade Mín.</th>
                  <th>Idade Máx.</th>
                  <th>Prov. Idade</th>
                  <th>Ocor. Máx.</th>
                  <th>Qtde</th>
                  
                  <th>Prazo Interv.</th>
                  <th>Média Prazo Interv.</th>
                  <th>Qtde Máx. Interv.</th>
                  <th>Prov. Prazo</th>
                  <th>Dias Inter.</th>
                  
                  <th>Dias Prorrog.</th>
                  <th>Tab. Prazo Int. Ev.</th>
                  <th>Omitir Dem.</th>
                  <th>Cód. Incomp.</th>
                  <th>Uso OPME</th>
                  <th>Coberturas</th>
                  <th>Lista Esp.</th>
                  <th>Horário Esp.</th>
                  <th>Perícia Pós Op.</th>
                  
                  <th>Inc. Máx Guia</th>
                  <th>Reg. Prontuário</th>
                  <th>Comporta Cód. Pgto</th>
                  <th>Prov. Falta Aut. Prévia</th>
                  
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
