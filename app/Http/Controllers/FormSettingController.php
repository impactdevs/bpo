<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormSetting;
use Illuminate\Http\Request;

class FormSettingController extends Controller
{
    public function index($uuid)
    {
        //get the form fields
        $form = Form::where('uuid', $uuid)->first();
        $form->load('fields');

        //get the form settings
        $form->load('setting');
        
        return view('form-settings.index', compact('form'));
    }

    public function update(Request $request)
    {
        $form = FormSetting::where('form_id', $request->form_id)->first();
        //if update is successful
        if ($form) {
            $update = $form->update($request->all());
            if ($update)
                return back()->with('success', 'Form updated successfully.');
        } else {
            //if update fails
            $create = FormSetting::create($request->all());
            if ($create)
                return back()->with('success', 'Form created successfully.');
        }

        return back()->with('error', 'Form update failed.');
    }

    public function destroy(Request $request)
    {
        return back()->with('success', 'Form deleted successfully.');
    }

    public function show(Request $request)
    {
        return back()->with('success', 'Form showed successfully.');
    }


    public function edit(Request $request)
    {
        return back()->with('success', 'Form edited successfully.');
    }

}
