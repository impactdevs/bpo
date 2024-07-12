<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Add this if not already imported


class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        $forms->load('setting');
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            // Add validation rules for other fields as necessary
        ]);

        // Create a new Form record
        $form = Form::create([
            'uuid' => Str::uuid(), // Generate UUID
            'name' => $request->input('name'),
            // Add other fields as necessary
        ]);

        // Redirect to the show route for the newly created form
        return redirect()->route('form-builder.show', $form->uuid);
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        //check where uuid is equal to the form id
        $form = Form::where('uuid', $uuid)->first();

        //load the form with its fields
        $form->load('fields');
        return view('forms.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

        /**
     * Display the specified resource.
     */
    public function display_questionnaire($uuid)
    {
        //check where uuid is equal to the form id
        $form = Form::where('uuid', $uuid)->first();

        //load the form with its fields
        $form->load('fields');
        return view('entries.create', compact('form'));
    }
}
