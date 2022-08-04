<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style media="screen">
            @page {
                margin: 0cm 0cm;
            }

            body {
                margin-top: 1cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1cm;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 1cm;
                background-color: rgb(179, 179, 179);
                color: white;
                text-align: center;
                line-height: 0.5cm;
                font-family: Helvetica, Arial, sans-serif;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;
                background-color: rgb(179, 179, 179);
                color: white;
                text-align: center;
                line-height: 0.5cm;
            }

            footer .page-number:after { content: counter(page); }

            .bordered td {
                border-color: #959594;
                border-style: solid;
                border-width: 1px;
            }

            table {
                border-collapse: collapse;
            }

             .page-break {
                  page-break-after: always;
                }
    </style>
</head>
    <body>
        <header>
            Termo de Referência
        </header>

        <footer>
          <span>{{ date('d/m/Y H:i:s') }} - </span><span class="page-number">Página </span>         
        </footer>

        <main>
            @foreach($trs as $tr)
            <table  class="bordered" width="100%">
              <tbody>


                <tr>
                    <td colspan="3">
                        <label for="situacao"><strong>STATUS</strong></label>
                        <div id="situacao">{{$tr->situacao->descricao}}</div>
                    </td>  

                    <td colspan="3" style = "text-align: center; font-size: 18px;">
                        <strong>Nº {{ $tr->numero }}/{{ $tr->ano }}</strong>
                    </td>
                    <td colspan="3">
                        <label for="origem"><strong>Origem</strong></label>
                        <div id="origem">{{$tr->origem->descricao}}</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="9">
                        <label for="descricao"><strong>Descrição Básica do Objeto</strong></label>
                        <div id="descricao">{{$tr->descricao}}</div>
                    </td>    
                </tr>

                <tr>
                    <td colspan="2">
                        <label for="tipo"><strong>Tipo</strong></label>
                        <div id="tipo">{{$tr->tipo->descricao}}</div>
                    </td>  
                    <td colspan="2" style = "text-align: center;">
                        <label for="entregueSupAdm"><strong>Entregue SUP.ADM.</strong></label>
                        <div id="entregueSupAdm">{{ (isset($tr->entregueSupAdm)) ? $tr->entregueSupAdm->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="3" style = "text-align: center;">
                        <label for="entregueComprasContrato"><strong>Entregue COMPRAS / CONTRATOS</strong></label>
                        <div id="entregueComprasContrato">{{ (isset($tr->entregueComprasContrato)) ? $tr->entregueComprasContrato->format('d/m/Y') : "-"}}</div>
                    </td>
                    <td colspan="2">
                        <label for="responsavel"><strong>Responsável Cotação</strong></label>
                        <div id="responsavel">{{$tr->responsavel->nome}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style = "text-align: center;">
                        <label for="inicioCotacao"><strong>Início Cotação</strong></label>
                        <div id="inicioCotacao">{{ (isset($tr->inicioCotacao)) ? $tr->inicioCotacao->format('d/m/Y') : '-'}}</div>
                    </td>  
                    <td colspan="2" style = "text-align: center;">
                        <label for="terminoCotacao"><strong>Término cotação</strong></label>
                        <div id="terminoCotacao">{{ (isset($tr->terminoCotacao)) ? $tr->terminoCotacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2">
                        <label for="requisicaoCompras"><strong>Requisição Compras</strong></label>
                        <div id="requisicaoCompras">{{ (isset($tr->requisicaoCompras)) ? $tr->requisicaoCompras : '-'}}</div>
                    </td>
                    <td colspan="3" style = "text-align: right;">
                        <label for="valor"><strong>Valor R$</strong></label>
                        <div id="valor">{{$tr->valor}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style = "text-align: center;">
                        <label for="envioSuplanPro"><strong>Envio SUPLAN_PRO</strong></label>
                        <div id="envioSuplanPro">{{ (isset($tr->envioSuplanPro)) ? $tr->envioSuplanPro->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="retornoSuplanPro"><strong>Retorno SUPLAN_PRO</strong></label>
                        <div id="retornoSuplanPro">{{ (isset($tr->retornoSuplanPro)) ? $tr->retornoSuplanPro->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="assinaturasGabinete"><strong>Assinaturas GABINETE</strong></label>
                        <div id="assinaturasGabinete">{{ (isset($tr->assinaturasGabinete)) ? $tr->assinaturasGabinete->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="1" style = "text-align: center;">
                        <label for="envioCCOAF"><strong>Envio CCOAF</strong></label>
                        <div id="envioCCOAF">{{ (isset($tr->envioCCOAF)) ? $tr->envioCCOAF->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="retornoCCOAF"><strong>Retorno CCOAF</strong></label>
                        <div id="retornoCCOAF">{{ (isset($tr->retornoCCOAF)) ? $tr->retornoCCOAF->format('d/m/Y') : '-'}}</div>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <label for="deliberacao"><strong>Deliberação CCOAF</strong></label>
                        <div id="deliberacao">{{$tr->deliberacao->descricao}}</div>
                    </td>  
                    <td colspan="2">
                        <label for="numeroPAC"><strong>PAC Nº</strong></label>
                        <div id="numeroPAC">{{ (isset($tr->numeroPAC)) ? $tr->numeroPAC : '-'}}</div>
                    </td>
                    <td colspan="3">
                        <label for="modalidade"><strong>MODALIDADE</strong></label>
                        <div id="modalidade">{{$tr->modalidade->descricao}}</div>
                    </td>
                    <td colspan="2">
                        <label for="numeroModalidade"><strong>Nº modalidade</strong></label>
                        <div id="numeroModalidade">{{ (isset($tr->numeroModalidade)) ? $tr->numeroModalidade : '-'}}</div>
                    </td> 
                </tr>

                <tr>
                    <td colspan="2" style = "text-align: center;">
                        <label for="autuacao"><strong>Autuação / Ordenador Despesa</strong></label>
                        <div id="autuacao">{{ (isset($tr->autuacao)) ? $tr->autuacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="inicioMinutas"><strong>Início MINUTAS (contrato/ARP)</strong></label>
                        <div id="inicioMinutas">{{ (isset($tr->inicioMinutas)) ? $tr->inicioMinutas->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="teminoMinutas"><strong>Término MINUTAS (contrato/ARP)</strong></label>
                        <div id="teminoMinutas">{{ (isset($tr->teminoMinutas)) ? $tr->teminoMinutas->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="1" style = "text-align: center;">
                        <label for="inicioMinutasEdital"><strong>Início minuta EDITAL</strong></label>
                        <div id="inicioMinutasEdital">{{ (isset($tr->inicioMinutasEdital)) ? $tr->inicioMinutasEdital->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="terminoMinutasEdital"><strong>Término minuta EDITAL</strong></label>
                        <div id="terminoMinutasEdital">{{ (isset($tr->terminoMinutasEdital)) ? $tr->terminoMinutasEdital->format('d/m/Y') : '-'}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style = "text-align: center;">
                        <label for="envioPgm"><strong>Envio PGM</strong></label>
                        <div id="envioPgm">{{ (isset($tr->envioPgm)) ? $tr->envioPgm->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="retornoPgm"><strong>Retorno PGM</strong></label>
                        <div id="retornoPgm">{{ (isset($tr->retornoPgm)) ? $tr->retornoPgm->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="pendenciasPgm"><strong>Pendências PGM</strong></label>
                        <div id="pendenciasPgm">{{ (isset($tr->pendenciasPgm)) ? $tr->pendenciasPgm->format('d/m/Y') : '-'}}</div>
                    </td>   
                    <td colspan="2">
                        <label for="numeroEdital"><strong>Nº EDITAL</strong></label>
                        <div id="numeroEdital">{{ (isset($tr->numeroEdital)) ? $tr->numeroEdital : '-'}}</div>
                    </td>
                    <td colspan="1" style = "text-align: center;">
                        <label for="dataPregao"><strong>Data PREGÃO</strong></label>
                        <div id="dataPregao">{{ (isset($tr->dataPregao)) ? $tr->dataPregao->format('d/m/Y') : '-'}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="9">
                        <label for="observacaoLicitacao"><strong>Observação da Licitação</strong></label>
                        <div id="observacaoLicitacao">{{$tr->observacaoLicitacao}}</div>
                    </td>    
                </tr>

                <tr>
                    <td colspan="2" style = "text-align: center;">
                        <label for="dataHomologacao"><strong>Data Homologação</strong></label>
                        <div id="dataHomologacao">{{ (isset($tr->dataHomologacao)) ? $tr->dataHomologacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style = "text-align: center;">
                        <label for="dataRatificacao"><strong>Data Ratificação</strong></label>
                        <div id="dataRatificacao">{{ (isset($tr->dataRatificacao)) ? $tr->dataRatificacao->format('d/m/Y') : '-'}}</div>
                    </td> 
                    <td colspan="2" style = "text-align: center;">
                        <label for="formalizacaoContratoArp"><strong>Formalização Contrato/ARP</strong></label>
                        <div id="formalizacaoContratoArp">{{ (isset($tr->formalizacaoContratoArp)) ? $tr->formalizacaoContratoArp->format('d/m/Y') : '-'}}</div>
                    </td> 
                    <td colspan="2" style = "text-align: center;">
                        <label for="dataContratoArp"><strong>Data Contrato/ARP</strong></label>
                        <div id="dataContratoArp">{{ (isset($tr->dataContratoArp)) ? $tr->dataContratoArp->format('d/m/Y') : '-'}}</div>
                    </td> 
                    <td colspan="1" style = "text-align: center;">
                        <label for="solicitacaoEmpenho"><strong>Solicitação Empenho</strong></label>
                        <div id="solicitacaoEmpenho">{{ (isset($tr->solicitacaoEmpenho)) ? $tr->solicitacaoEmpenho->format('d/m/Y') : '-'}}</div>
                    </td>    
                </tr>

                <tr>
                    <td colspan="9">
                        <label for="observacao"><strong>Observações</strong></label>
                        <div id="observacao">{{$tr->observacao}}</div>
                    </td>    
                </tr>

              </tbody>
            </table>
            <div class="page-break"></div>
            @endforeach

        </main>
    </body>
</html>