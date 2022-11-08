<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class SampleFile implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [[
            'name',
            'last_name', 
            'identification'
        ]];
    }
}