<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Department;

class DepartmentController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/v1/departments",
    *     tags={"Departments"},
    *     summary="Listar departamentos",
    *     security={{"bearer_token":{}}},
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "department":{},
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
    * @OA\Post(
    *     path="/api/v1/departments",
    *     tags={"Departments"},
    *     summary="Crear departamento",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="description", in="query", @OA\Schema(type="string")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Departamento creado con éxito",
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
    * @OA\Put(
    *     path="/api/v1/departments/{id}",
    *     tags={"Departments"},
    *     summary="Actualizar departamento",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="description", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="id", required=true, in="path", @OA\Schema(type="string")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "message":"Departamento creado con éxito",
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
