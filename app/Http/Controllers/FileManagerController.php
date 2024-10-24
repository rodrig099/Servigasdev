<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function index()
    {
        $folders = Folder::with('subFolders')->whereNull('parent_id')->get();
        return view('file-manager.index', compact('folders'));
    }

    public function createFolder(Request $request)
    {
        $request->validate(['name' => 'required']);
        Folder::create(['name' => $request->name, 'parent_id' => $request->parent_id]);
        return back()->with('success', 'Carpeta creada con éxito');
    }

    public function show($id)
    {
        $folder = Folder::with('subFolders', 'files')->findOrFail($id);
        return view('file-manager.show', compact('folder'));
    }

    public function uploadFile(Request $request, $folderId)
    {
        $request->validate(['file' => 'required|file']);  // Validación de archivo

        // Almacena el archivo en el disco 'public' dentro de 'files'
        $path = $request->file('file')->store('files', 'public');

        // Guarda la información del archivo en la base de datos
        File::create([
            'name' => $request->file->getClientOriginalName(),
            'path' => $path,  // Esto guarda 'files/nombrearchivo.ext'
            'folder_id' => $folderId
        ]);

        return redirect()->route('folders.show', $folderId)->with('success', 'Archivo subido con éxito');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        $filePath = storage_path('app/public/' . $file->path);  // Ruta correcta en 'public'

        if (!file_exists($filePath)) {
            return response()->json(['message' => 'El archivo no existe.'], 404);
        }

        return response()->download($filePath);
    }

    public function deleteFile($id)
    {
        $file = File::findOrFail($id);
        Storage::disk('public')->delete($file->path);  // Elimina el archivo del disco 'public'
        $file->delete();
        return back()->with('success', 'Archivo eliminado con éxito');
    }

    public function deleteFolder($id)
    {
        $folder = Folder::findOrFail($id);
        foreach ($folder->files as $file) {
            Storage::disk('public')->delete($file->path);
            $file->delete();
        }
        foreach ($folder->subFolders as $subFolder) {
            $this->deleteFolder($subFolder->id);
        }
        $folder->delete();
        return back()->with('success', 'Carpeta eliminada con éxito');
    }

    public function renameFolder(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $folder = Folder::findOrFail($id);
        $folder->name = $request->name;
        $folder->save();
        return back()->with('success', 'Carpeta renombrada con éxito');
    }
}