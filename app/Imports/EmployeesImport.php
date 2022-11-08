<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name' => $row['name'],
            'last_name' => $row['last_name'],
            'department_id' => $row['department'],
            'identification' => $row['identification'] . '-' . strtotime(date('Y-m-d  H:m:s'))
        ]);
    }
}
