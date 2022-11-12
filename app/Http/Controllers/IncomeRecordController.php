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
    * @OA\Post(
    *     path="/api/v1/auth/entry_room_911",
    *     tags={"Income record"},
    *     summary="Registrar intentos de ingresos a Room-911",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="identification", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Empleado autorizado",
    *                 },
    *             ),
    * 
    *         ),
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Failed",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Mensaje de error",
    *                 },
    *             ),
    * 
    *         ),
    *     )
    * )
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
    * @OA\Get(
    *     path="/api/v1/income_record/{id}",
    *     tags={"Income record"},
    *     summary="Consultar registro de ingresos de un empleado",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="id", required=true, in="path", @OA\Schema(type="string")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "income_record":{},
    *                 },
    *             ),
    * 
    *         ),
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Failed",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Mensaje de error",
    *                 },
    *             ),
    * 
    *         ),
    *     )
    * )
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
    *     tags={"Income record"},
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
