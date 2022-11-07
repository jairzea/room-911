<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $page = $request->get('page');

            $consult = Employee::paginate($page);

            $employees = array(
                "_rel"		=> "employees",
                "_embedded" => array(
                    "employees" => $consult
                )
            );

            if(empty($consult))
                throw new Exception("No se encontraron registros");

            return response()->json(["response" => $employees], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
                "name" => $request->input("name"), "last_name" => $request->input("last_name"), "identification" => $identification, "department_id" => $request->input("id"),
            ];

            $create = Employee::create($data);

            return response()->json(["message" => "Empleado creado con éxito"], 200);
            
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string',
                'last_name' => 'required|string|unique:employees',
                'id' =>  'required|integer|exists:departments'
            ]);

            $employe = Employee::find($id);

            $dataUpdate = [
                "name" => $request->input("name"), "last_name" => $request->input("last_name"), "department_id" => $request->input("id"),
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bulkUploadUsers(Request $request)
    {

        try {
            
            Excel::import(new UsersImport($request->subcompanies_id), $request->file);

            return response()->json(["message" => "Usuarios cargados correctamente"], 200);

        } catch (Exception $e) {
            
            return response()->json(["message" => $e->getMessage(), "line" => $e->getLine()], 500);

        }
         
    }
}
