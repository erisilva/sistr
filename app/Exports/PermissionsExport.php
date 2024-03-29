<?php

namespace App\Exports;

use App\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermissionsExport implements FromQuery, WithHeadings
{
    use Exportable;

    private $name;
    private $description;

    /**
    * @return \Illuminate\Support\Collection
    * 
    * php artisan make:export PermissionsExport --model=Permission
    * 
    * https://laravel-excel.com/
    * 
    *
    */

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }


    public function query()
    {
        $result = Permission::query()->select('name', 'description');

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
