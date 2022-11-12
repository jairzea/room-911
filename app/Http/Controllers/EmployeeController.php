<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\EmployeesImport;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/v1/employees?id={id}&department={department}",
    *     tags={"Employee"},
    *     summary="Listar empleados",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="id", in="path", @OA\Schema(type="integer")),
    *     @OA\Parameter(name="department", in="path", @OA\Schema(type="integer")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "_rel":"employees",
    *                      "_embedded":{},
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
    public function index(Request $request)
    {
        try {

            $page = $request->get('page');

            $id = $request->get('id');
            $department = $request->get('department');

            $consult = Employee::with('department')->with('incomeRecord')->get();
            
            if ($request->input('id')) {
                $consult = $consult->where('identification', $id);
            }

            if ($request->get('department')) {
                $consult = $consult->where('department_id', $department);

            }

            foreach ($consult as $key => $value) {
                $val[] = $value;
            }

            if(empty($val) || empty($consult))
                throw new Exception("No se encontraron registros");

            $employees = array(
                "_rel"		=> "employees",
                "_embedded" => array(
                    "employees" => $val
                )
            );

            return response()->json(["response" => $employees], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

    /**
    * @OA\Post(
    *     path="/api/v1/employees",
    *     tags={"Employee"},
    *     summary="Crear empleado",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="last_name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="identification", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="id", required=true, in="query", @OA\Schema(type="integer")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Empleado creado con éxito",
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
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string|unique:employees',
                'identification' =>  'required|integer|unique:employees',
                'id' =>  'required|integer|exists:departments'
            ]);

            $identification = $request->input("identification") . '-' . strtotime(date('Y-m-d  H:m:s'));

            $search = Employee::where('identification', $identification)->first();

            if(!empty($search))
                throw new Exception("Ya existe el empleado con el id interno");

            $data = [
                "name" => $request->input("name"), "last_name" => $request->input("last_name"), "identification" => $identification, "department_id" => $request->input("id"), "state" => 1
            ];

            $create = Employee::create($data);

            return response()->json(["message" => "Empleado creado con éxito"], 200);
            
        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }


    /**
    * @OA\Put(
    *     path="/api/v1/employees/{id}",
    *     tags={"Employee"},
    *     summary="Editar empleado",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="last_name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="department_id", required=true, in="query", @OA\Schema(type="integer")),
    *     @OA\Parameter(name="id", required=true, in="path", @OA\Schema(type="integer")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Empleado actualizado con éxito",
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
    public function update(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string',
                'id' =>  'required|integer|exists:departments'
            ]);

            $employe = Employee::find($id);

            $dataUpdate = [
                "name" => $request->input("name"), "last_name" => $request->input("last_name"), 
                "department_id" => $request->input("id")
            ];

            if (empty($employe))
                throw new Exception("No existe el empleado con id: " . $id . " para ser actualizado");

            $employe->update($dataUpdate);
            
            return response()->json(["message" => "Empleado actualizado con éxto"], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

    /**
    * @OA\Post(
    *     path="/api/v1/employees/bulk_upload_users",
    *     tags={"Employee"},
    *     summary="Carga masiva de empleados",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="file", required=true, in="query", @OA\Schema(type="file")),
    *     @OA\Parameter(name="department_id", required=true, in="query", @OA\Schema(type="integer")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Empleado actualizado con éxito",
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
    public function bulkUploadUsers(Request $request)
    {

        try {

            $validated = $request->validate([
                'id' =>  'required|integer|exists:departments',
                'file' => 'required|mimes:csv,txt',
            ]);

            Excel::import(new EmployeesImport($request->id), $request->file);

            return response()->json(["message" => "Empleados cargados correctamente"], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
         
    }

    /**
    * @OA\Patch(
    *     path="/api/v1/employees/{id}",
    *     tags={"Employee"},
    *     summary="Cambio de estado de un empleados",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="id", required=true, in="path", @OA\Schema(type="integer")),
    *     @OA\Parameter(name="state", required=true, in="query", @OA\Schema(type="integer")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Cambio de estado realizado correctamente",
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
    public function changeState(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'state' => 'required|boolean'
            ]);

            $search = Employee::find($id);
            
            if (empty($search)) {
                throw new Exception("No existe el empleado");
            }

            $search->update(["state" => $request->input("state")]);

            return response()->json(["message" => "Cambio de estado realizado correctamente"], 200);
            
            
        } catch (Exception $e) {
            return returnExceptions($e);
        }
    }

    /**
    * @OA\Delete(
    *     path="/api/v1/employees/{id}",
    *     tags={"Employee"},
    *     summary="Eliminar un empleados",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="id", required=true, in="path", @OA\Schema(type="integer")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Empleado eliminado satisfactoriamente",
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
    public function delete($id){

        try {

            $employe = Employee::with('incomeRecord')->find($id);

            if (empty($employe)) {
                throw new Exception("No existe el empleado");
            }

            if(count($employe->incomeRecord) > 0){
                throw new Exception("No se puede eliminar un empleado con registros de ingresos");
            }

            $employe->delete();

            return response()->json(["message" => "Empleado eliminado satisfactoriamente"], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }
}
