<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\Models\Roles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        //
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
}
