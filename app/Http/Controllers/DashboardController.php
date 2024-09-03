<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\FormField;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $email = auth()->user()->email;
        // count the number of entries
        if ($email == "admin@bpo.com") {
            // get all entries
            $entries = $this->entries();
            $registered = $this->registered_entities();
            return view('dashboard', compact('entries', 'registered'));
        }
        return redirect()->route('entries.index');
    }

    public function entries()
    {
        $entries = Entry::count();

        return $entries;
    }

    public function registered_entities()
    {
        // get all entries
        $registered = Entry::whereJsonContains('responses->14', 'Yes')->count();

        return $registered;
    }

    public function headers($uuid)
    {
        //get table headers from form fields where section.form_id = $uuid, get only label, type, options
        $labels = FormField::whereHas('section', function ($query) use ($uuid) {
            $query->where('form_id', $uuid);
        })->select('id', 'label', 'type', 'options')->get();
        $headers = [];
        foreach ($labels as $label) {
            // Initialize the array with the label only
            $headers[$label->id] = [
                'label' => $label->label
            ];

            // Only add sub_headers for checkbox and radio types
            if (in_array($label->type, ['radio', 'checkbox'])) {
                // Split options by comma and trim white spaces
                $options = array_map('trim', explode(',', $label->options));

                // Assign the options as sub_headers under the label
                $headers[$label->id]['sub_headers'] = $options;
            }
        }

        return $headers;
    }
}
