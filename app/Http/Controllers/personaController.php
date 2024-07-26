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
        return response()->json($persona);
    }

    public function delete (Request $request)
    {
        $persona = personas::find($request->id);
        $persona->delete();
        return response()->json(['message' => 'Persona eliminada correctamente']);
    }
}
