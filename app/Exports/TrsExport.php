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
                                      'trs.descricao',
                                      'tipos.descricao as tipo',
                                      DB::raw('DATE_FORMAT(trs.entregueSupAdm, \'%d/%m/%Y\') AS data_entregueSupAdm'),
                                      DB::raw('DATE_FORMAT(trs.entregueComprasContrato, \'%d/%m/%Y\') AS data_entregueComprasContrato'),
                                      'responsavels.nome as responsavel',
                                      DB::raw('DATE_FORMAT(trs.inicioCotacao, \'%d/%m/%Y\') AS data_inicioCotacao'),
                                      DB::raw('DATE_FORMAT(trs.terminoCotacao, \'%d/%m/%Y\') AS data_terminoCotacao'),
                                      'trs.requisicaoCompras',
                                      'trs.valor',
                                      DB::raw('DATE_FORMAT(trs.envioSuplanPro, \'%d/%m/%Y\') AS data_envioSuplanPro'),
                                      DB::raw('DATE_FORMAT(trs.retornoSuplanPro, \'%d/%m/%Y\') AS data_retornoSuplanPro'),
                                      DB::raw('DATE_FORMAT(trs.assinaturasGabinete, \'%d/%m/%Y\') AS data_assinaturasGabinete'),
                                      'trs.protocoloSisprot',
                                      DB::raw('DATE_FORMAT(trs.envioCCOAF, \'%d/%m/%Y\') AS data_envioCCOAF'),
                                      DB::raw('DATE_FORMAT(trs.retornoCCOAF, \'%d/%m/%Y\') AS data_retornoCCOAF'),
                                      'deliberacaos.descricao as deliberacao',
                                      'trs.numeroPAC',
                                      'modalidades.descricao as modalidade',
                                      'trs.numeroModalidade',
                                      DB::raw('DATE_FORMAT(trs.autuacao, \'%d/%m/%Y\') AS data_autuacao'),
                                      DB::raw('DATE_FORMAT(trs.inicioMinutas, \'%d/%m/%Y\') AS data_inicioMinutas'),
                                      DB::raw('DATE_FORMAT(trs.teminoMinutas, \'%d/%m/%Y\') AS data_teminoMinutas'),
                                      DB::raw('DATE_FORMAT(trs.inicioMinutasEdital, \'%d/%m/%Y\') AS data_inicioMinutasEdital'),
                                      DB::raw('DATE_FORMAT(trs.terminoMinutasEdital, \'%d/%m/%Y\') AS data_terminoMinutasEdital'),
                                      DB::raw('DATE_FORMAT(trs.envioPgm, \'%d/%m/%Y\') AS data_envioPgm'),
                                      DB::raw('DATE_FORMAT(trs.retornoPgm, \'%d/%m/%Y\') AS data_retornoPgm'),
                                      DB::raw('DATE_FORMAT(trs.pendenciasPgm, \'%d/%m/%Y\') AS data_pendenciasPgm'),
                                      'trs.numeroEdital',
                                      DB::raw('DATE_FORMAT(trs.dataPregao, \'%d/%m/%Y\') AS data_Pregao'),
                                      'trs.observacaoLicitacao',
                                      DB::raw('DATE_FORMAT(trs.dataHomologacao, \'%d/%m/%Y\') AS data_dataHomologacao'),
                                      DB::raw('DATE_FORMAT(trs.dataRatificacao, \'%d/%m/%Y\') AS data_dataRatificacao'),
                                      DB::raw('DATE_FORMAT(trs.formalizacaoContratoArp, \'%d/%m/%Y\') AS data_formalizacaoContratoArp'),
                                      DB::raw('DATE_FORMAT(trs.dataContratoArp, \'%d/%m/%Y\') AS data_dataContratoArp'),
                                      DB::raw('DATE_FORMAT(trs.solicitacaoEmpenho, \'%d/%m/%Y\') AS data_solicitacaoEmpenho'),
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
                "Origem",
                "Descrição Básica do Objeto",
                "Tipo",
                "Entregue SUP.ADM.",
                "Entregue COMPRAS / CONTRATOS",
                "Responsável Cotação",
                "Início Cotação",
                "Término cotação",
                "Requisição Compras",
                "Valor R$",
                "Envio SUPLAN_PRO",
                "Retorno SUPLAN_PRO",
                "Assinaturas GABINETE",
                "Protocolo SISPROT",
                "Envio CCOAF",
                "Retorno CCOAF",
                "Deliberação CCOAF",
                "PAC Nº",
                "MODALIDADE",
                "Nº modalidade",
                "Autuação / Ordenador Despesa",
                "Início MINUTAS (contrato/ARP)",
                "Término MINUTAS (contrato/ARP)",
                "Início minuta EDITAL",
                "Término minuta EDITAL",
                "Envio PGM",
                "Retorno PGM",
                "Pendêcnias PGM",
                "Nº EDITAL",
                "Data PREGÃO",
                "Observação da Licitação",
                "Data Homologação",
                "Data Ratificação",
                "Formalização Contrato/ARP",
                "Data Contrato/ARP",
                "Solicitação Empenho",
                "Observações",
                "Funcionario Responsável",
                "Data do Cadastro",
                "Hora do Cadastro"
            ];
    }
}
