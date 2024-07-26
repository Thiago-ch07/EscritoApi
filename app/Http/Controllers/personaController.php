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
        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        $persona->delete();
        return response()->json(['message' => 'Persona eliminada correctamente']);
    }

    public function index (Request $request)
    {
        $personas = personas::all();
        return response()->json(['personas' => $personas]);
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

    public function search (Request $request)
    {
        $personas = personas::where('nombre', 'like', '%'.$request->busqueda.'%')->orWhere('apellido', 'like', '%'.$request->busqueda.'%')->get();
        return response()->json(['personas' => $personas]);
    }
}
