<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileApiController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        return json_encode([
            "success" => "true", 
            "data" => [$files]
        ]);
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

        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
    
        if (Storage::disk('public')->exists($filePath)) {
                        
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);            
            return response()->json([
                'success' => true,
                'data'    => $file
            ], 201);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading file'
            ], 500);
    
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::find($id);

        if (!$file) {
            return response()->json([
                'success'  => false,
                'message' => 'Error show file'
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'data'    => $file
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Obté el fitxer des de la base de dades a partir de l'ID
        
        $file = File::find($id);
        if(empty($file)){
            return response()->json([
                'success' => false,
                'message' => 'arxiu no trobat'
            ],404);
        }
        
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
            $file->filesize = 1024000;
            $file->save();
    
            // Redirigir a show amb missatge d'èxit
            return json_encode([
                "success" => "true", 
                "data" => $file,
            ]);

        } 
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);
        if(empty($file)){
            return response()->json([
                'success' => false,
                'message' => 'arxiu no esborrat'
            ],404);
        }
        
            // Obté el fitxer des de la base de dades a partir de l'ID
        $file = File::findOrFail($id);

        // Intenta eliminar el fitxer del disc
        $deletedFromDisk = Storage::disk('public')->delete($file->filepath);

        if ($deletedFromDisk) {
            // Si va bé, eliminar el registre de la BD
            $file->delete();

            return response()->json([
                'success' => true,
                'data'    => $file
            ], 200);
        }
       
    }

}
