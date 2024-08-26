<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    //
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                'document' => 'required|file',
                'description' => 'required|string|max:255',
            ]);
    
            $path = $request->file('document')->store('documents');
    
            Document::create([
                'name' => $request->file('document')->getClientOriginalName(),
                'file_path' => $path,
                'description' => $request->input('description'),
            ]);
    
            return redirect()->back()->with('success', 'Document uploaded successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th);
            Log::error('Document upload failed: '.$th->getMessage());
            return redirect()->back()->with('error', 'Document upload failed.');
        }

    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        return Storage::download($document->file_path);
    }

    public function destroy($id)
{
    try {
        $document = Document::findOrFail($id);
        Storage::delete($document->file_path);
        $document->delete();

        return response()->json(['success' => 'Document deleted successfully.']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete document.'], 500);
    }
}

}
