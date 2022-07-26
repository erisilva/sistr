<?php

namespace App\Exports;

use App\Models\Deliberacao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeliberacaosExport implements FromQuery, WithHeadings
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
        $result = Deliberacao::query()->select('descricao');

        return $result;
    }

    public function headings(): array
    {
        return ["Descrição"];
    }
}
