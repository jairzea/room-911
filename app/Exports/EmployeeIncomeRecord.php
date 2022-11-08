<?php

namespace App\Exports;

use App\Models\IncomeRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeIncomeRecord implements FromCollection
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return IncomeRecord::all();
    }

    public function headings(): array
    {
        return ["id", "employee_indentification", "hour", "date", "status", "cret", "upd"];
    }
}
