<?php

namespace App\Http\Controllers;

use App\Imports\DocumentImport;
use App\Models\Document;
use App\Models\DocumentData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

//     public function show($id)
// {
//     $document = Document::findOrFail($id);

//     $documentData = DocumentData::where('document_id', $id)->get();

   
//     return view('documents.show', compact('document', 'documentData'));
// }

public function show($id)
{
    $document = Document::findOrFail($id);
    $documentData = DocumentData::where('document_id', $id)->get();

    // Define all potential columns
    $allColumns = ['name', 'company', 'email', 'contact', 'location', 'position', 'employer', 'office_number'];

    // Determine which columns have at least one non-empty value
    $columnsToShow = collect($allColumns)->filter(function ($column) use ($documentData) {
        return $documentData->contains(function ($data) use ($column) {
            // Check if the column is not empty, null, or 'N/A'
            return !empty($data->$column) && $data->$column !== 'N/A';
        });
    });

    return view('documents.show', compact('document', 'documentData', 'columnsToShow'));
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

public function import(Request $request, Document $document)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

   // dd($request->file('file'));

    // Pass document ID and name to the importer
    Excel::import(new DocumentImport($document->id, $document->description), $request->file('file'));

    return back()->with('success', 'Document data imported successfully.');
}


}
