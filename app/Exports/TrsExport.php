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

    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }


    public function query()
    {
        $result = Tr::query()->select('trs.numero', 
                                      'trs.ano', 
                                      'trs.descricao',
                                      'users.name as operador'
                                  );

        // joins
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
        return ["TR Nº", "Ano", "Descrição Básica do Objeto", "Funcionario Responsável"];
    }
}
