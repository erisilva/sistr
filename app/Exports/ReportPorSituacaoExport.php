<?php

namespace App\Exports;

use App\Models\Tr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;

class ReportPorSituacaoExport implements FromQuery, WithHeadings
{
    use Exportable;

    private $dataInicio;
    private $dataFinal;

    /**
    * @return \Illuminate\Support\Collection
    * 
    * php artisan make:export ReportPorSituacaoExport --model=Permission
    * 
    * https://laravel-excel.com/
    * 
    *
    */

    public function __construct($dataInicio, $dataFinal)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFinal = $dataFinal;
    }

    public function query()
    {
        # get data
        $porSituacao = DB::table('trs')
            ->join('situacaos', 'situacaos.id', '=', 'trs.situacao_id')
            ->select('situacaos.descricao', DB::raw('count(trs.id) as total'))
            ->where('trs.created_at', '>=', $this->dataInicio)
            ->where('trs.created_at', '<=', $this->dataFinal)
            ->groupBy('trs.situacao_id')
            ->orderBy('situacaos.descricao')
            ->get();

        return $porSituacao;
    }

    public function headings(): array
    {
        return ["Descrição", "Total"];
    }
}
