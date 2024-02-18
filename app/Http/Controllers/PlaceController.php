<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Place;
use App\Models\File;
use App\Models\User;
use App\Models\Favorite;

use Auth;




class PlaceController extends Controller
{

    public function __construct()
    {
    $this->authorizeResource(Place::class, 'place');
    }

    public function index()
    {
    
    $places = Place::withCount('favorited')->get();
    return view('places.index', compact('places'));
    
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request, user $user)
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

        $data['visibility_id'] = $request->input('visibility');
        $data['author_id'] = auth()->id();
        Place::create($data);

        return redirect()->route('places.index')
        ->with('success', 'Place successfully saved');
    }

    public function show(Place $place)
    {
        $place->loadCount('favorited');
        return view('places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
    $fileId = $place->file_id; // Almacena el file_id actual para poder eliminarlo más tarde si es necesario.

    // Procesa el nuevo archivo si se ha subido uno.
    if ($request->hasFile('file')) {
        // Sube el nuevo archivo y crea un registro de archivo.
        $path = $request->file('file')->store('uploads', 'public');
        $fileSize = $request->file('file')->getSize();
        $file = File::create(['filepath' => $path, 'filesize' => $fileSize]);

        // Si se crea un nuevo archivo, actualiza file_id.
        if ($file) {
            $place->file_id = $file->id;
        }
    }
    // Actualiza la información del place.
    $place->fill($request->except(['file']));
    $place->author_id = auth()->id(); 
    $place->save();

    // Si se creó un nuevo archivo y se actualizó el place, ahora se puede eliminar el archivo anterior.
    if ($request->hasFile('file') && $fileId !== $place->file_id) {
        $oldFile = File::find($fileId);
        if ($oldFile) {
            Storage::disk('public')->delete($oldFile->filepath);
            $oldFile->delete();
        }
    }
    return redirect()->route('places.index')->with('success', 'Place successfully updated');
    }

    public function destroy(Place $place)
    {
        Storage::disk('public')->delete($place->file->filepath);
        $place->file->delete();
        $place->delete();
        return redirect()->route('places.index')
        ->with('success', 'Place successfully deleted');
    }

    //nuevos metodos de place:  favorite, unfavorite

    public function favorite (Request $request, Place $place){
        $favorite = Favorite::where('user_id',auth()->user()->id)->where('place_id', $place->id )->first();
        if($favorite){
            $favorite->delete();
            Log::debug("Fav eliminado");
            return redirect()->back();
        } else {
            $favorite = Favorite::create([
                'user_id' => auth()->user()->id,
                'place_id' => $place->id,
            ]);
            return redirect()->back();
            Log::debug("Fav creat");
        }

    }

}