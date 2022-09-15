<?php

namespace App\Exports;

use App\Models\Tr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;

class TrsExport implements FromQuery, WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    * 
    * php artisan make:export PermissionsExport --model=Permission
    * 
    * https://laravel-excel.com/
    * 
    *
    */

    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }


    public function query()
    {
        $result = Tr::query()->select('situacaos.descricao as situacao',
                                      'trs.numero', 
                                      'trs.ano', 
                                      'origems.descricao as origem',
                                      'tipos.descricao as tipo',
                                      'trs.descricao',
                                      'trs.quantidadeItens',
                                      
                                      DB::raw('DATE_FORMAT(trs.entregueSupAdm, \'%d/%m/%Y\') AS data_entregueSupAdm'),
                                      DB::raw('DATE_FORMAT(trs.entregueComprasContrato, \'%d/%m/%Y\') AS data_entregueComprasContrato'),
                                      'responsavels.nome as responsavel',
                                      DB::raw('DATE_FORMAT(trs.inicioCotacao, \'%d/%m/%Y\') AS data_inicioCotacao'),
                                      DB::raw('DATE_FORMAT(trs.terminoCotacao, \'%d/%m/%Y\') AS data_terminoCotacao'),
                                      'trs.requisicaoCompras',
                                      'trs.valor',
                                      DB::raw('DATE_FORMAT(trs.envioSuplanPro, \'%d/%m/%Y\') AS data_envioSuplanPro'),
                                      DB::raw('DATE_FORMAT(trs.retornoSuplanPro, \'%d/%m/%Y\') AS data_retornoSuplanPro'),
                                      'trs.protocoloSisprot',
                                      DB::raw('DATE_FORMAT(trs.envioCCOAF, \'%d/%m/%Y\') AS data_envioCCOAF'),
                                      DB::raw('DATE_FORMAT(trs.retornoCCOAF, \'%d/%m/%Y\') AS data_retornoCCOAF'),
                                      'deliberacaos.descricao as deliberacao',
                                      'trs.numeroPAC',
                                      'modalidades.descricao as modalidade',
                                      'trs.numeroModalidade',
                                      DB::raw('DATE_FORMAT(trs.autuacao, \'%d/%m/%Y\') AS data_autuacao'),
                                      DB::raw('DATE_FORMAT(trs.inicioMinutas, \'%d/%m/%Y\') AS data_inicioMinutas'),
                                      DB::raw('DATE_FORMAT(trs.terminoMinutas, \'%d/%m/%Y\') AS data_terminoMinutas'),

                                      DB::raw('DATE_FORMAT(trs.inicioMinutasARP, \'%d/%m/%Y\') AS data_inicioMinutasARP'),
                                      DB::raw('DATE_FORMAT(trs.terminoMinutasARP, \'%d/%m/%Y\') AS dataterminoMinutasARP'),

                                      'pregoeiros.nome as pregoeiro',
                                      
                                      DB::raw('DATE_FORMAT(trs.inicioMinutasEdital, \'%d/%m/%Y\') AS data_inicioMinutasEdital'),
                                      DB::raw('DATE_FORMAT(trs.terminoMinutasEdital, \'%d/%m/%Y\') AS data_terminoMinutasEdital'),
                                      DB::raw('DATE_FORMAT(trs.envioPgm, \'%d/%m/%Y\') AS data_envioPgm'),
                                      DB::raw('DATE_FORMAT(trs.retornoPgm, \'%d/%m/%Y\') AS data_retornoPgm'),

                                      DB::raw('DATE_FORMAT(trs.inicioSaneamentoPendencias, \'%d/%m/%Y\') AS data_inicioSaneamentoPendencias'),
                                      DB::raw('DATE_FORMAT(trs.terminoSaneamentoPendencias, \'%d/%m/%Y\') AS data_terminoSaneamentoPendencias'),

                                      'trs.numeroEdital',

                                      DB::raw('DATE_FORMAT(trs.dataPregao, \'%d/%m/%Y\') AS data_Pregao'),

                                      DB::raw('DATE_FORMAT(trs.impugnacao, \'%d/%m/%Y\') AS data_impugnacao'),
                                      
                                      DB::raw('DATE_FORMAT(trs.inicioAnaliseTecnica, \'%d/%m/%Y\') AS data_inicioAnaliseTecnica'),
                                      DB::raw('DATE_FORMAT(trs.terminoAnaliseTecnica, \'%d/%m/%Y\') AS data_terminoAnaliseTecnica'),
                                      

                                      

                                      DB::raw('DATE_FORMAT(trs.dataHomologacao, \'%d/%m/%Y\') AS data_dataHomologacao'),
                                      DB::raw('DATE_FORMAT(trs.dataRatificacao, \'%d/%m/%Y\') AS data_dataRatificacao'),
                                      DB::raw('DATE_FORMAT(trs.dataReratificacao, \'%d/%m/%Y\') AS data_dataReratificacao'),
                                      DB::raw('DATE_FORMAT(trs.formalizacaoContratoArp, \'%d/%m/%Y\') AS data_formalizacaoContratoArp'),
                                      DB::raw('DATE_FORMAT(trs.dataContratoArp, \'%d/%m/%Y\') AS data_dataContratoArp'),

                                      'trs.publicacao',
                                      'trs.observacao',
                                      'users.name as operador',
                                      DB::raw('DATE_FORMAT(trs.created_at, \'%d/%m/%Y\') AS data'),
                                      DB::raw('DATE_FORMAT(trs.created_at, \'%H:%i\') AS hora')
                                  );

        // joins
        $result = $result->join('situacaos', 'situacaos.id', '=', 'trs.situacao_id');
        $result = $result->join('origems', 'origems.id', '=', 'trs.origem_id');
        $result = $result->join('deliberacaos', 'deliberacaos.id', '=', 'trs.deliberacao_id');
        $result = $result->join('modalidades', 'modalidades.id', '=', 'trs.modalidade_id');
        $result = $result->join('responsavels', 'responsavels.id', '=', 'trs.responsavel_id');
        $result = $result->join('pregoeiros', 'pregoeiros.id', '=', 'trs.pregoeiro_id');
        $result = $result->join('tipos', 'tipos.id', '=', 'trs.tipo_id');
        $result = $result->join('users', 'users.id', '=', 'trs.user_id');

        // fitros
        foreach ($this->filtros as $filtro => $valor) {
            if (!empty($valor)){
                if (is_int($valor)){
                    $result = $result->where('trs.' . $filtro, '=', $valor);   
                } else {
                    $result = $result->Where('trs.' . $filtro, 'like', '%' . $valor . '%');
                }
            }    
        }

        // sort
        $result = $result->orderBy('trs.ano', 'desc');
        $result = $result->orderBy('trs.numero', 'asc'); 

        return $result;
    }

    public function headings(): array
    {
        return ["Status", 
                "TR Nº",
                "Ano",
                "Solicitante",
                "Tipo TR",
                "Objeto",
                "Qtde. Itens",                
                "Entrada na S.A.",
                "Entrada DCC",
                "Responsável Cotação",
                "Início Cotação",
                "Término cotação",
                "Requisição Compras Nº",
                "Valor R$",
                "Envio SUPLAN",
                "Retorno SUPLAN",
                "SISPROT Nº",
                "Envio CCOAF",
                "Retorno CCOAF",
                "Deliberação CCOAF",
                "PAC Nº",
                "Modalidade",
                "Nº Modalidade",
                "Autuação PAC",
                "Início minuta (contrato/aditivo)",
                "Término minuta (contrato/aditivo)",
                "Início minuta ARP",
                "Término minuta ARP",
                "Pregoeiro (a)",
                "Início minuta Edital",
                "Término minuta Edital",                
                "Envio PGM",
                "Retorno PGM",
                "Início Saneamento Pendênias",
                "Término Saneamento Pendências",
                "Nº EDITAL",
                "Data PREGÃO",
                'Impugnação / Suspensão',
                'Início Análise Técnica',
                'Término Análise Técnica',
                "Homologação",
                "Ratificação",
                "Reratificação",
                "Formalização (contrato/aditivo/ARP)",
                "Data (contrato/aditivo/ARP)",
                'PUBLICAÇÃO DOC',
                "Observações",
                "Funcionario Responsável",
                "Data do Cadastro",
                "Hora do Cadastro"
            ];
    }
}
