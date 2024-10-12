<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $user = auth()->user();


        if ($user->hasRole('Admin') || $user->hasRole('Tecnico')) {
            $files = File::orderBy('created_at', 'desc')->paginate(10);
        } else {

            $files = File::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('files.index', compact('files'));
    }
    public function create()
    {
        return view('files.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:3048',
        ]);

        $file = $request->file('file');
        $path = $file->store('files', 'public');
        $mime_type = $file->getMimeType();


        File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $mime_type,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('files.index')->with('success', 'Archivo subido exitosamente.');

    }


    public function download($id)
    {
        $file = File::findOrFail($id);
        return Storage::download('public/' . $file->path, $file->name);
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);

        Storage::delete('public/' . $file->path);

        $file->delete();

        return redirect()->route('files.index')->with('success', 'Archivo eliminado exitosamente.');
    }
}