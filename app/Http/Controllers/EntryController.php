<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $entry->user_id = auth()->id();
        $entry->save();

        return back()->with('success', 'Entry submitted successfully! Thank you for your response.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entry $entry)
    {
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
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entry $entry)
    {
        //
    }

    public function entries($uuid)
    {
        // Retrieve entries for the given form_id
        $entries = Entry::where('form_id', $uuid)->get();

        //load the form with its settings
        $entries->load('form', 'form.setting');

        // Process each entry to decode responses and map to labels
        foreach ($entries as $entry) {
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

                //set the title and the subtitle
                if (filled($entry->form->setting)) {
                    if ($entry->form->setting->title == $key)
                        $entry['title'] = $value;
                    if ($entry->form->setting->subtitle == $key)
                        $entry['subtitle'] = $value;
                } else {
                    $formattedResponses['title'] = '';
                    $formattedResponses['subtitle'] = '';

                }

            }

            //remove responses
            unset($entry->responses);

            // Replace the original responses with the formatted ones
            $entry->formatted_responses = $formattedResponses;
        }

        // Pass entries to the view
        return view('entries.entries', compact('entries'));
    }
}