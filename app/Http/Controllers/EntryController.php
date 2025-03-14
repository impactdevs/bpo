<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if the user is not logged in, redirect  to login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $forms = Form::all();
        return view('entries.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get the form id
        $form_id = request('form_id');

        //get the form
        $form = Form::find($form_id);

        $form->load('fields');

        return view('entries.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //convert the form fields to json
        $responses = json_encode($request->except('_token', 'form_id'));
        $form_id = $request->input('form_id');

        $entry = new Entry();
        $entry->form_id = $form_id;
        $entry->responses = $responses;
        $entry->user_id = $request->input('user_id') ?? auth()->id();
        $entry->save();

        return back()->with('success', 'Entry submitted successfully! Thank you for your response.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
        // if the user is not logged in, redirect  to login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $decodedResponses = json_decode($entry->responses, true); // Decode JSON to associative array

        $formattedResponses = [];

        // Iterate through each response and map to label
        foreach ($decodedResponses as $key => $value) {
            $formField = FormField::find($key); // Assuming $key corresponds to form_fields.id

            if ($formField) {
                $formattedResponses[$formField->label] = $value;
            } else {
                // Handle case where form_field with $key is not found (optional)
                // You may choose to skip or handle this case based on your requirements
                $formattedResponses["Unknown Field (ID: $key)"] = $value;
            }
        }

        //remove responses
        unset($entry->responses);

        // Replace the original responses with the formatted ones
        $entry->formatted_responses = $formattedResponses;
        return view('entries.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entry $entry, Request $request)
    {
        $form_id = $request->input('form_id');
        $form = Form::where('uuid', $form_id)->firstOrFail();

        // Load sections with their related fields
        $form->load(['sections.fields']);

        $decodedResponses = json_decode($entry->responses, true); // Decode JSON to associative array

        $formattedResponses = [];

        // Iterate through each response and map to field ID
        foreach ($decodedResponses as $key => $value) {
            $formField = FormField::find($key); // Assuming $key corresponds to form_fields.id

            if ($formField) {
                $formattedResponses[$formField->id] = $value;
            } else {
                // Handle case where form_field with $key is not found (optional)
                // You may choose to skip or handle this case based on your requirements
                $formattedResponses[$key] = $value; // Keep the original key if no field found
            }
        }

        // Pass formatted responses to the view
        return view('entries.edit', compact('entry', 'form', 'formattedResponses'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        //jus
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();

        return back()->with('success', 'Entry deleted successfully!');
    }

    public function entries(Request $request, $uuid)
    {
        // Return initial view for non-AJAX requests
        if (!$request->ajax()) {
            return view('entries.entries', compact('uuid'));
        }
        //get form with setting
        $form = Form::with('setting')->where('uuid', $uuid)->firstOrFail();

        if (filled($form->setting)) {
            if ($form->setting->title)
            $titleKey=$form->setting->title;
            if ($form->setting->subtitle)
            $subtitleKey=$form->setting->subtitle;
        } else {
            $titleKey = '';
            $subtitleKey = '';
        }
        $entriesQuery = Entry::with(['form.setting', 'user'])
            ->where('form_id', $uuid);
    
        if (auth()->user()->email !== "admin@bpo.com") {
            $entriesQuery->where('user_id', auth()->user()->id);
        }
    
        return DataTables::of($entriesQuery)
            ->addColumn('actions', function($entry) {
                return view('entries.actions', compact('entry'))->render();
            })
            ->editColumn('created_at', function ($entry) {
                return $entry->created_at ? $entry->created_at->format('d M Y, h:i A') : '';
            })
            ->filter(function ($query) use ($request, $titleKey, $subtitleKey) {
                if (!empty($request->search['value'])) {
                    $searchTerm = strtolower($request->search['value']); // Convert search term to lowercase
            
                    $query->where(function($q) use ($searchTerm, $titleKey, $subtitleKey) {
                        if (!empty($titleKey)) {
                            $q->orWhereRaw("LOWER(responses->'$.{$titleKey}') LIKE ?", ["%{$searchTerm}%"]);
                        }
                        if (!empty($subtitleKey)) {
                            $q->orWhereRaw("LOWER(responses->'$.{$subtitleKey}') LIKE ?", ["%{$searchTerm}%"]);
                        }
                        $q->orWhereHas('user', function($userQuery) use ($searchTerm) {
                            $userQuery->whereRaw("LOWER(name) LIKE ?", ["%{$searchTerm}%"]);
                        });
                    });
                }
            })
            
            ->rawColumns(['actions'])
            ->make(true);
    }

    //entry update
    public function entry_update($id, Request $request)
    {
        $entry = Entry::find($id);
        $responses = json_encode($request->except('_token', 'form_id'));
        $entry->responses = $responses;
        $entry->save();

        return back()->with('success', 'Entry updated successfully!');

    }

    public function survey(Request $request, $form, $user)
    {
        //get the form
        $form = Form::where('uuid', $form)->firstOrFail();

        // Load sections with their related fields
        $form->load(['sections.fields']);

        return view('entries.create', compact('form', 'user'));
    }
}
