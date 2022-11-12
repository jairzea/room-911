<?php

namespace App\Exports;

use App\Models\IncomeRecord;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeIncomeRecord implements FromCollection
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IncomeRecord::all();
    }
}
