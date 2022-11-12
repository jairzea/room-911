<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Roles;

class RolesController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/v1/roles",
    *     tags={"Roles"},
    *     summary="Listar roles",
    *     security={{"bearer_token":{}}},
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                      "roles":{},
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
            $roles = Roles::all('id', 'name');
            return response()->json(["roles" => $roles], 200);
        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

    /**
    * @OA\Post(
    *     path="/api/v1/roles",
    *     tags={"Roles"},
    *     summary="Crear rol",
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
    *                     "message":"Rol creado con éxito",
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

            // Validamos los datos enviados
            $validated = $request->validate([
                'name' => 'required|string|unique:roles'
            ]);

            $data = [
                "name" => $request->input("name"), "description" => $request->input("description")
            ];

            $create = Roles::create($data);
            return response()->json(["message" => "Rol creado con éxito", "id" => $create->id], 200);
            
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
    public static function show($id)
    {
        try {

            $rol = Roles::find($id);

            if(empty($rol))
                throw new Exception("No existe el rol");

            return response()->json(["rol" => $rol], 200);

            
        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }


    /**
    * @OA\Put(
    *     path="/api/v1/roles/{id}",
    *     tags={"Roles"},
    *     summary="Crear rol",
    *     security={{"bearer_token":{}}},
    *     @OA\Parameter(name="name", required=true, in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="description", in="query", @OA\Schema(type="string")),
    *     @OA\Parameter(name="id", in="path", @OA\Schema(type="string")),
    *     @OA\Response(
    *         response=200,
    *         description="Success.",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                  example={
    *                     "Rol actualizado con éxto",
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

            $rol = Roles::find($id);

            $dataUpdate = [
                "name" => $request->input("name"), "description" => $request->input("description")
            ];

            if (empty($rol))
                throw new Exception("No existe el rol con id: " . $id . " para ser actualizado");

            $rol->update($dataUpdate);
            $message = "Rol actualizado con éxto";
            
            return response()->json(["message" => $message], 200);

        } catch (Exception $e) {

            return returnExceptions($e);

        }
    }

}
