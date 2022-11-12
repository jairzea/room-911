<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $department = Department::all('id', 'name', 'description');
            return response()->json(["department" => $department], 200);
        } catch (Exception $e) {

            return returnExceptions($e);

        }
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
                'name' => 'required|string|unique:departments',
                'description' => 'string'
            ]);

            $data = [
                "name" => $request->input("name"), "description" => $request->input("description")
            ];

            $create = Department::create($data);
            return response()->json(["message" => "Departamento creado con éxito", "id" => $create->id], 200);
            
        } catch (Exception $e) {

            return returnExceptions($e);

        }
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
                'description' => 'string'
            ]);

            $department = Department::find($id);

            $dataUpdate = [
                "name" => $request->input("name"), "description" => $request->input("description")
            ];

            if (empty($department))
                throw new Exception("No existe el departamento con id: " . $id . " para ser actualizado");

            $department->update($dataUpdate);
            $message = "Departamento actualizado con éxto";
            
            return response()->json(["message" => $message], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

}
