<?php

namespace App\Exports;

use App\Models\Tr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

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
        /*
numero
ano
descricao
situacao_id
origem_id
tipo_id
requisicaoCompras
protocoloSisprot
modalidade_id
numeroModalidade
numeroEdital
        */

    public function __construct($numero, $ano, $descricao, $situacao_id, $origem_id, $tipo_id, $requisicaoCompras, $protocoloSisprot, $modalidade_id, $numeroModalidade, $numeroEdital)
    {
        $this->numero = $numero;
        $this->ano = $ano;
        $this->descricao = $descricao;
        $this->situacao_id = $situacao_id;
        $this->origem_id = $origem_id;
        $this->tipo_id = $tipo_id;
        $this->requisicaoCompras = $requisicaoCompras;
        $this->protocoloSisprot = $protocoloSisprot;
        $this->modalidade_id = $modalidade_id;
        $this->numeroModalidade = $numeroModalidade;
        $this->numeroEdital = $numeroEdital;
    }


    public function query()
    {
        $result = Tr::query()->select('numero', 'ano');

        if (!empty($this->name)){
            $result = $result->where('name', 'like', '%' . $this->name . '%');    
        }

        if (!empty($this->description)){
            $result = $result->Where('description', 'like', '%' . $this->description . '%');
        }

        return $result;
    }

    public function headings(): array
    {
        return ["Nome", "Descrição"];
    }
}
