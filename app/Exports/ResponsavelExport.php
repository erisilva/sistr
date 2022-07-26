<?php

namespace App\Exports;

use App\Models\Responsavel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResponsavelExport implements FromQuery, WithHeadings
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
        $result = Responsavel::query()->select('nome');

        return $result;
    }

    public function headings(): array
    {
        return ["Nome"];
    }
}
