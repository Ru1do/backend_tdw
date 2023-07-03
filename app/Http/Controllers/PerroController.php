<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InteraccionRequest;
use App\Models\Perro;


class PerroController extends Controller
{
    public function index()
    {
        $perros = Perro::all();
        return view('perros.index', compact('perros'));
    }

    public function create()
    {
        return view('perros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:12',
            'url_foto' => 'required|url',
            'descripcion' => 'required|string',
        ]);

        Perro::create([
            'nombre' => $request->nombre,
            'url_foto' => $request->url_foto,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('perros.index')->with('success', 'Perro creado exitosamente.');
    }

    public function show(Perro $perro)
    {
        return view('perros.show', compact('perro'));
    }

    public function edit(Perro $perro)
    {
        return view('perros.edit', compact('perro'));
    }

    public function update(Request $request, Perro $perro)
    {
        $request->validate([
            'nombre' => 'required|string|max:12',
            'url_foto' => 'required|url',
            'descripcion' => 'required|string',
        ]);

        $perro->update([
            'nombre' => $request->nombre,
            'url_foto' => $request->url_foto,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('perros.index')->with('success', 'Perro actualizado exitosamente.');
    }

    public function destroy(Perro $perro)
    {
        $perro->delete();
        return redirect()->route('perros.index')->with('success', 'Perro eliminado exitosamente.');
    }
    public function storeInteraccion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perro_interesado_id' => 'required|integer|exists:perros,id',
            'perro_candidato_id' => 'required|integer|exists:perros,id',
            'preferencia' => 'required|in:aceptado,rechazado',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
}
}