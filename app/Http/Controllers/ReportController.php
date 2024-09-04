<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\FormField;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::all();

        return view('reports.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
    public function reports($uuid)
    {
        // Retrieve headers for the form
        $headers = $this->headers($uuid);

        // Create a map of headers by their label for quick lookup
        $headerLabels = [];
        foreach ($headers as $headerId => $headerData) {
            $headerLabels[$headerData['label']] = $headerData;
        }

        $entries = Entry::latest()->paginate(15);

        // Process each entry to decode responses and map to labels
        foreach ($entries as $entry) {
            $decodedResponses = json_decode($entry->responses, true); // Decode JSON to associative array

            $formattedResponses = [];

            // Iterate through each response and map to label
            foreach ($decodedResponses as $key => $value) {
                $formField = FormField::find($key); // Assuming $key corresponds to form_fields.id
                if ($formField) {
                    $formattedResponses[$formField->label] = $value;
                }
            }

            // Ensure all headers are in the formatted responses
            foreach ($headerLabels as $label => $headerData) {
                if (!array_key_exists($label, $formattedResponses)) {
                    $formattedResponses[$label] = null;
                }
            }

            // Remove original responses
            unset($entry->responses);

            // Replace the original responses with the formatted ones
            $entry->formatted_responses = $formattedResponses;
        }

        // Pass headers and entries to the view
        return view('reports.reports', compact('headers', 'uuid', 'entries'));
    }

    public function getReportsData(Request $request, $uuid)
    {
        // Retrieve headers for the form
        $headers = $this->headers($uuid);

        // Create a map of headers by their label for quick lookup
        $headerLabels = [];
        foreach ($headers as $headerId => $headerData) {
            $headerLabels[$headerData['label']] = $headerData;
        }

        // Initialize query for entries
        $query = Entry::query();

        // Apply search filter if provided
        if ($request->has('search') && $request->get('search')['value'] !== null) {
            $searchValue = $request->get('search')['value'];
            \Log::info($searchValue);

            $query->where(function ($query) use ($searchValue) {
                // Convert both the responses and search value to lowercase to ignore case
                $query->whereRaw('LOWER(responses) LIKE ?', ['%' . strtolower($searchValue) . '%']);
            });
        }



        // Paginate results
        $entries = $query->latest()->paginate($request->get('length', 10), ['*'], 'page', $request->get('start', 1) / $request->get('length', 10) + 1);

        // Process entries for DataTables
        $data = $entries->map(function ($entry) use ($headerLabels) {
            $decodedResponses = json_decode($entry->responses, true);
            $formattedResponses = [];

            foreach ($decodedResponses as $key => $value) {
                $formField = FormField::find($key);
                if ($formField) {
                    $formattedResponses[$formField->label] = $value;
                }
            }

            foreach ($headerLabels as $label => $headerData) {
                if (!array_key_exists($label, $formattedResponses)) {
                    $formattedResponses[$label] = null;
                }
            }

            return $formattedResponses;
        });

        // Return data in DataTables format
        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => Entry::count(),
            'recordsFiltered' => $entries->total(),
            'data' => $data
        ]);
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
