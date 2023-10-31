<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\File;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        // Desa el fitxer al storage
        $path = $request->file('file')->store('uploads', 'public'); 
        $fileSize = $request->file('file')->getSize();
        $file = File::create(['filepath' => $path, 'filesize' => $fileSize]);
        // Desa la clau primària (id) del nou registre de la taula files a una variable
        $fileId = $file->id;

        // Obtenir les dades del formulari
        $data = $request->all();
        $data['file_id'] = $fileId;

        Place::create($data);

        return redirect()->route('places.index');
    }

    public function show(Place $place)
    {
        return view('places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        if($request->hasFile('file')) {
            $path = $request->file('file')->store('places');
            $file = File::create(['filepath' => $path]);
            $place->file_id = $file->id;
        }

        $place->update($request->all());

        return redirect()->route('places.index');
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('places.index');
    }
}
