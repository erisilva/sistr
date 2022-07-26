<?php

namespace App\Exports;

use App\Models\Modalidade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModalidadeExport implements FromQuery, WithHeadings
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


    public function query()
    {
        $result = Modalidade::query()->select('descricao');

        return $result;
    }

    public function headings(): array
    {
        return ["Descrição"];
    }
}
