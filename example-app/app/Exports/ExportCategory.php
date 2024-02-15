<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ExportCategory implements ToModel
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(array $row)
    {
        return new Category([
            'name'=>$row[0],
            'slug'=>$row[1],
            'image'=>$row[2],
            'status'=>$row[3],
        ]);
    }
}
