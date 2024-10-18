<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
//use App\Models\User;

class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();


        $carpetas = Folder::where('user_id', $user->id)->get();

        // Obtener archivos dependiendo del rol del usuario
        if ($user->hasRole('Admin') || $user->hasRole('Tecnico')) {
            $carpetas = Folder::all();
            $files = File::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $carpetas = Folder::where('user_id', $user->id)->get();
            $files = File::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('files.index', compact('carpetas', 'files'));
    }

    //////////seccion crear/////////////
    public function create()
    {
        // return view('files.create');
        //$carpetas = Folder::all();

        $user = auth()->user();
        $carpetas = Folder::where('user_id', $user->id)->get();

        return view('files.create', compact('carpetas'));
    }

    //////seccion store///////////
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:3048',
            'folder_name' => 'nullable|string|max:255',
            'subfolder_name' => 'nullable|string|max:255', // Validar el nombre de la subcarpeta
            'existing_folder' => 'nullable|integer|exists:folders,id',
        ]);

        // Si se seleccionó una carpeta existente
        if ($request->input('existing_folder')) {
            // Obtener la carpeta existente
            $folder = Folder::find($request->input('existing_folder'));
            $folderName = $folder->folder_name;
        } elseif ($request->input('folder_name')) {
            // Crear una nueva carpeta
            $folderName = $request->input('folder_name');

            // Verificar si ya existe una carpeta con ese nombre
            if (Folder::where('folder_name', $folderName)->exists()) {
                return redirect()->back()->with('error', 'Ya existe una carpeta con ese nombre.');
            }

            // Guardar la nueva carpeta en la base de datos
            $folder = Folder::create([
                'folder_name' => $folderName,
                'user_id' => Auth::id(),
            ]);

            // Crear la carpeta en el sistema de archivos
            Storage::disk('public')->makeDirectory('files/' . $folderName);

            // Crear la subcarpeta si se proporcionó un nombre
            if ($request->input('subfolder_name')) {
                $subfolderName = $request->input('subfolder_name');

                // Verificar si ya existe una subcarpeta con ese nombre
                if (Storage::disk('public')->exists('files/' . $folderName . '/' . $subfolderName)) {
                    return redirect()->back()->with('error', 'Ya existe una subcarpeta con ese nombre.');
                }

                // Crear la subcarpeta en el sistema de archivos
                Storage::disk('public')->makeDirectory('files/' . $folderName . '/' . $subfolderName);

                // Redirigir a la subcarpeta después de su creación
                return redirect()->route('files.show', $subfolderName)
                    ->with('success', 'Carpeta y subcarpeta creadas exitosamente.');
            }
        } else {
            return redirect()->back()->with('error', 'Debes seleccionar una carpeta existente o crear una nueva.');
        }

        // Subir el archivo a la carpeta seleccionada o creada
        $file = $request->file('file');
        $filePath = 'files/' . $folderName;
        $fileName = $file->getClientOriginalName();

        // Guardar el archivo en el sistema de archivos
        $file->storeAs($filePath, $fileName, 'public');
        $mime_type = $file->getMimeType();

        // Guardar la información del archivo en la base de datos
        File::create([
            'name' => $fileName,
            'path' => $filePath . '/' . $fileName,
            'mime_type' => $mime_type,
            'folder_id' => $folder->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('files.show', $folder->folder_name)
            ->with('success', 'Archivo subido exitosamente.');
    }


    ////////seccion descargar//////////
    public function download($id)
    {
        $file = File::findOrFail($id);

        // Verificar permisos
        if ($file->user_id !== auth()->id() && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Tecnico')) {
            return redirect()->route('files.index')->with('error', 'No tienes permiso para descargar este archivo.');
        }

        return Storage::download('public/' . $file->path, $file->name);
    }


    ///////seccion eliminar archivos//////////
    public function destroy($id)
    {

        $file = File::findOrFail($id);


        if ($file->user_id !== auth()->id() && !auth()->user()->hasRole('Admin')) {
            return redirect()->route('files.index')->with('error', 'No tienes permiso para eliminar este archivo.');
        }

        Storage::delete('public/' . $file->path);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'Archivo eliminado exitosamente.');
    }

    ////////seccion eliminar carpetas////////
    public function destroyFolder($id)
    {
        // Encontrar la carpeta por ID
        $folder = Folder::findOrFail($id);

        // Verificar permisos: el usuario debe ser el propietario de la carpeta o un Admin
        if ($folder->user_id !== auth()->id() && !auth()->user()->hasRole('Admin')) {
            return redirect()->route('files.index')->with('error', 'No tienes permiso para eliminar esta carpeta.');
        }

        // Eliminar todos los archivos asociados a la carpeta
        $files = File::where('folder_id', $folder->id)->get();
        foreach ($files as $file) {
            Storage::delete('public/' . $file->path); // Eliminar el archivo del almacenamiento
            $file->delete(); // Eliminar el registro del archivo
        }

        // Eliminar la carpeta
        $folder->delete();

        return redirect()->route('files.index')->with('success', 'Carpeta y sus archivos eliminados exitosamente.');
    }


    /////////seccion cambiar nombre carpetas////////
    public function renameFolder(Request $request, $id)
    {
        $request->validate([
            'new_folder_name' => 'required|string|max:255',
        ]);

        $folder = Folder::findOrFail($id);
        // Verifica si ya existe una carpeta con el nuevo nombre
        if (Folder::where('folder_name', $request->new_folder_name)->exists()) {
            return redirect()->back()->with('error', 'Ya existe una carpeta con ese nombre.');
        }

        // Cambiar el nombre de la carpeta
        $folder->folder_name = $request->new_folder_name;
        $folder->save();

        return redirect()->route('files.index')->with('success', 'Nombre de la carpeta cambiado exitosamente.');
    }


    ////////seccion ver carpetas y archivos////////
    public function show($folder_name)
    {
        $folder = Folder::where('folder_name', $folder_name)->firstOrFail();
        $archivos = File::where('folder_id', $folder->id)->get();

        return view('files.show', compact('archivos', 'folder_name', 'folder'));
    }


    public function getFile($id)
    {
        $file = File::findOrFail($id);
        return response()->json(['path' => $file->path]);
    }
}