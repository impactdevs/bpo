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
        ->join('form_fields', 'cleaning_options.form_field_id', '=', 'form_fields.id')->get();
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get all the form fields with type textarea
        $form_fields = DB::table('form_fields')->where('type', 'textarea')->get();

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
}
