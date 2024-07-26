<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personas;
use Illuminate\Support\Facades\Validator;

class personaController extends Controller
{
    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $persona = personas::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);

        return response()->json($persona, 201);
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
        return view('personas.index', ['personas' => $personas]);
    }

    public function update (Request $request)
    {
        $persona = Personas::find($request->id);
        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $persona->nombre = $request->nombre;
        $persona->apellido = $request->apellido;
        $persona->telefono = $request->telefono;
        $persona->save();

        return response()->json($persona);
    }

    public function search (Request $request)
    {
        $query = $request->input('busqueda', '');
        $personas = Personas::where('nombre', 'like', '%'.$query.'%')
                            ->orWhere('apellido', 'like', '%'.$query.'%')
                            ->get();

        return response()->json(['personas' => $personas]);
    }
}
