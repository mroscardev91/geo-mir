<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class FileController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(File::class, 'file');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
       return view("files.index", [
           "files" => File::all()
       ]);
   }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("files.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validar fitxer
    $validatedData = $request->validate([
        'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
    ]);
   
    // Obtenir dades del fitxer
    $upload = $request->file('upload');
    $fileName = $upload->getClientOriginalName();
    $fileSize = $upload->getSize();
    Log::debug("Storing file '{$fileName}' ($fileSize)...");

    // Pujar fitxer al disc dur
    $uploadName = time() . '_' . $fileName;
    $filePath = $upload->storeAs(
        'uploads',      // Path
        $uploadName ,   // Filename
        'public'        // Disk
    );
   
    if (Storage::disk('public')->exists($filePath)) {
        Log::debug("Disk storage OK");
        $fullPath = Storage::disk('public')->path($filePath);
        Log::debug("File saved at {$fullPath}");
        
        // Desar dades a BD
        $file = File::create([
            'filepath' => $filePath,
            'filesize' => $fileSize,
        ]);
        Log::debug("DB storage OK");
        
        // Patró PRG amb missatge d'èxit
        return redirect()->route('files.show', $file)
            ->with('success', 'File successfully saved');
    } else {
        Log::debug("Disk storage FAILS");
        // Patró PRG amb missatge d'error
        return redirect()->route("files.create")
            ->with('error', 'ERROR uploading file');
    }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Obté el fitxer de la BD
    $file = File::find($id);

    // Si no es troba el fitxer a la BD, redirigeix a index amb un missatge d'error
    if (!$file) {
        return redirect()->route('files.index')
            ->with('error', 'Fitxer no trobat a la BD');
    }

    // Comprova si el fitxer existeix al disc
    if (!Storage::disk('public')->exists($file->filepath)) {
        return redirect()->route('files.index')
            ->with('error', 'El fitxer no es troba al disc');
    }

    // Retorna la vista amb les dades del fitxer
    return view('files.show', compact('file'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Obté el fitxer des de la base de dades a partir de l'ID
    $file = File::findOrFail($id);

    // Retorna la vista edit amb les dades del fitxer
    return view('files.edit', ['file' => $file]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Obté el fitxer des de la base de dades a partir de l'ID
    $file = File::findOrFail($id);

    // Validar el fitxer
    $validatedData = $request->validate([
        'upload' => 'required|mimes:jpg,jpeg,png,gif|max:2048' // max 2MB
    ]);

    // Si la validació falla, es retornarà automàticament a la vista d'edició

    // Desar el nou fitxer al disc
    $upload = $request->file('upload');
    $fileName = $upload->getClientOriginalName();
    $uploadName = time() . '_' . $fileName;
    $filePath = $upload->storeAs(
        'uploads',      // Path
        $uploadName ,   // Filename
        'public'        // Disk
    );

    if (Storage::disk('public')->exists($filePath)) {
        // Si va bé, esborra l'antic fitxer i actualitza les dades a la BD
        if($file->filepath != $filePath) {
            Storage::disk('public')->delete($file->filepath);
        }

        $file->filepath = $filePath;
        $file->filesize = $upload->getSize();
        $file->save();

        // Redirigir a show amb missatge d'èxit
        return redirect()->route('files.show', $file)
            ->with('success', 'File successfully updated');
    } else {
        // En cas contrari, redirigir a edit amb missatge d'error
        return redirect()->route('files.edit', $file)
            ->with('error', 'ERROR updating file');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Obté el fitxer des de la base de dades a partir de l'ID
    $file = File::findOrFail($id);

    // Intenta eliminar el fitxer del disc
    $deletedFromDisk = Storage::disk('public')->delete($file->filepath);

    if ($deletedFromDisk) {
        // Si va bé, eliminar el registre de la BD
        $file->delete();

        // Redirigir a index amb missatge d'èxit
        return redirect()->route('files.index')
            ->with('success', 'File successfully deleted');
    } else {
        // En cas contrari, redirigir a show amb missatge d'error
        return redirect()->route('files.show', $file)
            ->with('error', 'ERROR deleting file');
    }
}
}
