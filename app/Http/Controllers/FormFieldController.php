<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = new FormField();
        $field->form_id = $request->input('form_id');
        $field->label = $request->input('label');
        $field->type = $request->input('type');
        $field->options = $request->input('options');
        $field->save();

        return redirect()->route('form-builder.show', $field->form_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $field = FormField::findOrFail($id);
        return view('fields.edit', compact('field'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $field = FormField::findOrFail($id);
        $field->label = $request->input('label');
        $field->type = $request->input('type');
        $field->options = $request->input('options');
        $field->save();

        return redirect()->route('form-builder.show', $field->form_id)->with('success', 'Field updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy($id)
    {
        $field = FormField::findOrFail($id);
        $field->delete();

        return redirect()->route('form-builder.show', $field->form_id)->with('success', 'Field deleted successfully');
    }
}
