<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class Settingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = DB::table('cleaning_options')
        ->join('form_fields', 'cleaning_options.form_field_id', '=', 'form_fields.id')
        ->select('cleaning_options.*', 'form_fields.label')->get();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get all the form fields with type textarea
        $form_fields = DB::table('form_fields')
        ->where('type', 'textarea')
        ->orWhere('type', 'text')
        //number
        ->orWhere('type', 'number')
        ->get();

        return view('settings.create', compact('form_fields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $save = DB::table('cleaning_options')->insert([
            'form_field_id' => $request->form_field_id,
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('settings.index');
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
    public function edit($setting)
    {
        $currentItem = DB::table('cleaning_options')->where('id', $setting)->first();

        $form_fields = DB::table('form_fields')->where('type', 'textarea')
        ->orWhere('type', 'text')->get();

        return view('settings.edit', compact('currentItem', 'form_fields'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update where $id
        $update = DB::table('cleaning_options')->where('id', $id)->update([
            'form_field_id' => $request->form_field_id,
            'name' => $request->name,
            'updated_at' => now()
        ]);

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete where $id
        $delete = DB::table('cleaning_options')->where('id', $id)->delete();

        return redirect()->route('settings.index');
    }
}
