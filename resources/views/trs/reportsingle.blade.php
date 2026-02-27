<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            background-color: rgb(200, 200, 200);
            color: black;
            text-align: center;
            line-height: 0.8cm;
            font-family: Helvetica, Arial, sans-serif;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color: rgb(200, 200, 200);
            color: black;
            text-align: center;
            line-height: 0.5cm;
        }

        footer .page-number:after {
            content: counter(page);
        }

        .bordered td {
            border-color: #959594;
            border-style: solid;
            border-width: 1px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <header>
        Termo de Referência Nº {{ $tr->numero }}/{{ $tr->ano }}
    </header>

    <footer>
        <span>{{ date('d/m/Y H:i:s') }} - </span><span class="page-number">Página </span>
    </footer>

    <main>

        <table class="bordered">
            <tbody>
                <tr>
                    <td colspan="5">
                        <label for="sei"><strong>Nº SEI</strong></label>
                        <div id="sei">{{ (isset($tr->sei)) ? $tr->sei : '-'}}</div>
                    </td>
                    <td colspan="4"></td>
                </tr>

                <tr>
                    <td colspan="3">
                        <label for="situacao"><strong>STATUS</strong></label>
                        <div id="situacao">{{$tr->situacao->descricao}}</div>
                    </td>

                    <td colspan="3" style="text-align: center; font-size: 18px;">
                        <strong>Nº {{ $tr->numero }}/{{ $tr->ano }}</strong>
                    </td>
                    <td colspan="3">
                        <label for="origem"><strong>Solicitante</strong></label>
                        <div id="origem">{{$tr->origem->descricao}}</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="9">
                        <label for="descricao"><strong>Objeto</strong></label>
                        <div id="descricao">{{$tr->descricao}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="1" style="text-align: right;">
                        <label for="tipo"><strong>Qtde. Itens</strong></label>
                        <div id="tipo">{{$tr->quantidadeItens}}</div>
                    </td>
                    <td colspan="2">
                        <label for="tipo"><strong>Tipo</strong></label>
                        <div id="tipo">{{$tr->tipo->descricao}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="entregueSupAdm"><strong>Entrada na S.A.</strong></label>
                        <div id="entregueSupAdm">
                            {{ (isset($tr->entregueSupAdm)) ? $tr->entregueSupAdm->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="entregueComprasContrato"><strong>Entrada DCC</strong></label>
                        <div id="entregueComprasContrato">
                            {{ (isset($tr->entregueComprasContrato)) ? $tr->entregueComprasContrato->format('d/m/Y') : "-"}}
                        </div>
                    </td>
                    <td colspan="2">
                        <label for="responsavel"><strong>Responsável Cotação</strong></label>
                        <div id="responsavel">{{$tr->responsavel->nome}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center;">
                        <label for="inicioCotacao"><strong>Início Cotação</strong></label>
                        <div id="inicioCotacao">
                            {{ (isset($tr->inicioCotacao)) ? $tr->inicioCotacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="terminoCotacao"><strong>Término cotação</strong></label>
                        <div id="terminoCotacao">
                            {{ (isset($tr->terminoCotacao)) ? $tr->terminoCotacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2">
                        <label for="requisicaoCompras"><strong>Requisição Compras Nº</strong></label>
                        <div id="requisicaoCompras">{{ (isset($tr->requisicaoCompras)) ? $tr->requisicaoCompras : '-'}}
                        </div>
                    </td>
                    <td colspan="3" style="text-align: right;">
                        <label for="valor"><strong>Valor R$</strong></label>
                        <div id="valor">{{$tr->valor}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center;">
                        <label for="envioSuplanPro"><strong>Envio SUPLAN</strong></label>
                        <div id="envioSuplanPro">
                            {{ (isset($tr->envioSuplanPro)) ? $tr->envioSuplanPro->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="retornoSuplanPro"><strong>Retorno SUPLAN</strong></label>
                        <div id="retornoSuplanPro">
                            {{ (isset($tr->retornoSuplanPro)) ? $tr->retornoSuplanPro->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: right;">
                        <label for="protocoloSisprot"><strong>SISPROT Nº</strong></label>
                        <div id="protocoloSisprot">{{$tr->protocoloSisprot}}</div>
                    </td>
                    <td colspan="1" style="text-align: center;">
                        <label for="envioCCOAF"><strong>Envio CCOAF</strong></label>
                        <div id="envioCCOAF">{{ (isset($tr->envioCCOAF)) ? $tr->envioCCOAF->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="retornoCCOAF"><strong>Retorno CCOAF</strong></label>
                        <div id="retornoCCOAF">
                            {{ (isset($tr->retornoCCOAF)) ? $tr->retornoCCOAF->format('d/m/Y') : '-'}}</div>
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
                        <label for="modalidade"><strong>Modalidade</strong></label>
                        <div id="modalidade">{{$tr->modalidade->descricao}}</div>
                    </td>
                    <td colspan="2">
                        <label for="numeroModalidade"><strong>Nº Modalidade</strong></label>
                        <div id="numeroModalidade">{{ (isset($tr->numeroModalidade)) ? $tr->numeroModalidade : '-'}}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="1" style="text-align: center;">
                        <label for="autuacao"><strong>Autuação PAC</strong></label>
                        <div id="autuacao">{{ (isset($tr->autuacao)) ? $tr->autuacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="inicioMinutas"><strong>Início minuta (contrato/aditivo)</strong></label>
                        <div id="inicioMinutas">
                            {{ (isset($tr->inicioMinutas)) ? $tr->inicioMinutas->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="terminoMinutas"><strong>Término minuta (contrato/aditivo)</strong></label>
                        <div id="terminoMinutas">
                            {{ (isset($tr->terminoMinutas)) ? $tr->terminoMinutas->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="inicioMinutasARP"><strong>Início minuta ARP</strong></label>
                        <div id="inicioMinutasARP">
                            {{ (isset($tr->inicioMinutasARP)) ? $tr->inicioMinutasARP->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="terminoMinutasARP"><strong>Término minuta ARP</strong></label>
                        <div id="terminoMinutasARP">
                            {{ (isset($tr->terminoMinutasARP)) ? $tr->terminoMinutasARP->format('d/m/Y') : '-'}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <label for="pregoeiro"><strong>Pregoeiro (a)</strong></label>
                        <div id="pregoeiro">{{$tr->pregoeiro->nome}}</div>
                    </td>
                    <td colspan="3" style="text-align: center;">
                        <label for="inicioMinutasEdital"><strong>Início minuta Edital</strong></label>
                        <div id="inicioMinutasEdital">
                            {{ (isset($tr->inicioMinutasEdital)) ? $tr->inicioMinutasEdital->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="3" style="text-align: center;">
                        <label for="terminoMinutasEdital"><strong>Término minuta Edital</strong></label>
                        <div id="terminoMinutasEdital">
                            {{ (isset($tr->terminoMinutasEdital)) ? $tr->terminoMinutasEdital->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center;">
                        <label for="envioPgm"><strong>Envio PGM</strong></label>
                        <div id="envioPgm">{{ (isset($tr->envioPgm)) ? $tr->envioPgm->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="retornoPgm"><strong>Retorno PGM</strong></label>
                        <div id="retornoPgm">{{ (isset($tr->retornoPgm)) ? $tr->retornoPgm->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="inicioSaneamentoPendencias"><strong>Início Saneamento Pendênias</strong></label>
                        <div id="inicioSaneamentoPendencias">
                            {{ (isset($tr->inicioSaneamentoPendencias)) ? $tr->inicioSaneamentoPendencias->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="3" style="text-align: center;">
                        <label for="terminoSaneamentoPendencias"><strong>Término Saneamento Pendências</strong></label>
                        <div id="terminoSaneamentoPendencias">
                            {{ (isset($tr->terminoSaneamentoPendencias)) ? $tr->terminoSaneamentoPendencias->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <label for="numeroEdital"><strong>Nº EDITAL</strong></label>
                        <div id="numeroEdital">{{ (isset($tr->numeroEdital)) ? $tr->numeroEdital : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="dataPregao"><strong>Data PREGÃO</strong></label>
                        <div id="dataPregao">{{ (isset($tr->dataPregao)) ? $tr->dataPregao->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="impugnacao"><strong>Impugnação / Suspensão</strong></label>
                        <div id="impugnacao">{{ (isset($tr->impugnacao)) ? $tr->impugnacao->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="inicioAnaliseTecnica"><strong>Início Análise Técnica</strong></label>
                        <div id="inicioAnaliseTecnica">
                            {{ (isset($tr->inicioAnaliseTecnica)) ? $tr->inicioAnaliseTecnica->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="terminoAnaliseTecnica"><strong>Término Análise Técnica</strong></label>
                        <div id="terminoAnaliseTecnica">
                            {{ (isset($tr->terminoAnaliseTecnica)) ? $tr->terminoAnaliseTecnica->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="1" style="text-align: center;">
                        <label for="dataHomologacao"><strong>Homologação</strong></label>
                        <div id="dataHomologacao">
                            {{ (isset($tr->dataHomologacao)) ? $tr->dataHomologacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="dataRatificacao"><strong>Ratificação</strong></label>
                        <div id="dataRatificacao">
                            {{ (isset($tr->dataRatificacao)) ? $tr->dataRatificacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="dataReratificacao"><strong>Reratificação</strong></label>
                        <div id="dataReratificacao">
                            {{ (isset($tr->dataReratificacao)) ? $tr->dataReratificacao->format('d/m/Y') : '-'}}</div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="formalizacaoContratoArp"><strong>Formalização
                                (contrato/aditivo/ARP)</strong></label>
                        <div id="formalizacaoContratoArp">
                            {{ (isset($tr->formalizacaoContratoArp)) ? $tr->formalizacaoContratoArp->format('d/m/Y') : '-'}}
                        </div>
                    </td>
                    <td colspan="2" style="text-align: center;">
                        <label for="dataContratoArp"><strong>Data (contrato/aditivo/ARP)</strong></label>
                        <div id="dataContratoArp">
                            {{ (isset($tr->dataContratoArp)) ? $tr->dataContratoArp->format('d/m/Y') : '-'}}</div>
                    </td>
                </tr>

                <tr>
                    <td colspan="9">
                        <label for="publicacao"><strong>PUBLICAÇÃO DOC</strong></label>
                        <div id="publicacao">{{$tr->publicacao}}</div>
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
    </main>
</body>

</html>
