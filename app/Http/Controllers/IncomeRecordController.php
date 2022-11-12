<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\EmployeeIncomeRecord;
use App\Models\Employee;
use App\Models\IncomeRecord;

class IncomeRecordController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function entryRoom911(Request $request)
    {
        try {

            $validated = $request->validate([
                'identification' =>  'required|string'
            ]);

            $message = "Empleado autorizado";
            $code_status = 200;

            $search = Employee::where('identification', $request->input("identification"))->first();

            if(empty($search)){

                $message = "Empleado no registrado";
                $code_status = 401;
                
            } else{

                if(!$search->state){
                    $message = "Empleado no autorizado";
                    $code_status = 401;
                }
            }

            $data = [
                "employee_identification" => $request->input("identification"), 
                "hour" => date('H:i:s'),
                "state" => $message,
                "date" => date('Y-m-d')
            ];

            $create = IncomeRecord::create($data);

            return response()->json(["message" => $message], $code_status);
            
        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $incomeRecord = IncomeRecord::where('employee_identification', $id)->get()->toArray();

            if (empty($incomeRecord))
                throw new Exception("No existe registro de usuario");

            return response()->json(["income_record" => $incomeRecord], 200);
            
        } catch (Exception $e) {

            return returnExceptions($e);
            
        }
    }

    /**
    * @OA\get(
    *     path="/api/v1/export/income_record",
    *     tags={"Exports"},
    *     summary="Exportar registro de ingresos de empleados",
    *     @OA\Response(
    *         response=200,
    *         description="{Download Income Record}",
    *     ),
    * )
    */
    public function downloadIncomeRecord()
    {
        return Excel::download(new EmployeeIncomeRecord, 'income_record.xlsx');
    }

 
}
