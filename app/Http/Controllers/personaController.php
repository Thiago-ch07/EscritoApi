<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;

class personaController extends Controller
{
    public function store (Request $request)
    {
        $persona = personas::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);
        $response = $persona->save();
        return response()->json($response);
    }

    public function delete (Request $request)
    {
        $persona = personas::find($request->id);
        $persona->delete();
        return response()->json(['message' => 'Persona eliminada correctamente']);
    }

    public function index (Request $request)
    {
        $personas = personas::all();
        $response =  [
            'personas' => $personas
        ];
        return response()->json($response);
    }

    public function update (Request $request)
    {
        $persona = personas::find($request->id);
        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->telefono = $request->telefono;
        $response = $persona->save();
        return response()->json($response);
    }
}
