<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\FormField;
use Illuminate\Support\Facades\DB;

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

    public function reports($uuid)
    {
        // Retrieve headers for the form
        $headers = $this->headers($uuid);
        // Pass headers and entries to the view
        return view('reports.reports', compact('headers', 'uuid'));
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

            // Add the entry id
            $formattedResponses['entry_id'] = $entry->id;

            foreach ($decodedResponses as $key => $value) {
                $formField = FormField::find($key);
                if ($formField) {
                    $formattedResponses[$formField->label] = $value;

                    // Check if the entry_id and question_id exists in the processed_entries
                    $store_processed_value = DB::table('processed_entries')
                        ->where('entry_id', $entry->id)
                        ->where('question_id', $key)
                        ->first();

                    if ($store_processed_value) {
                        // Create a new key 'processed' in the $formattedResponses array
                        $formattedResponses[$formField->label] = [
                            'value' => $value,
                            'processed' => $store_processed_value->value
                        ];
                    }
                }
            }

            // Add any missing headers with null values
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

        //create an array of headers
        $headers = [];

        //create an array of headers with sub_headers for checkbox and radio types
        foreach ($labels as $label) {
            // Initialize the array with the label only
            $headers[$label->id] = [
                'label' => $label->label,
                'question_id' => $label->id
            ];

            // Only add sub_headers for checkbox and radio types
            if (in_array($label->type, ['radio', 'checkbox'])) {
                // Split options by comma and trim white spaces
                $options = array_map('trim', explode(',', $label->options));

                // Assign the options as sub_headers under the label
                $headers[$label->id]['sub_headers'] = $options;
            }

            //add the type to the headers
            $headers[$label->id]['type'] = $label->type;

            //check in cleaning options table if for question_id exists
            $cleaning_options = DB::table('cleaning_options')->where('form_field_id', $label->id)->pluck('name')->toArray();

            //add the cleaning options to the headers
            $headers[$label->id]['cleaning_options'] = $cleaning_options;
        }

        return $headers;
    }

    //data cleaning function

    public function cleanData(Request $request)
    {
        try {
            //get the entry id
            $entry_id = $request->entry_id;

            //get the question id
            $question_id = $request->question_id;

            //get the value
            $value = $request->value;

            $store_processed_value = DB::table('processed_entries')->where('entry_id', $entry_id)->where('question_id', $question_id)->first();

            if ($store_processed_value) {
                DB::table('processed_entries')->where('entry_id', $entry_id)->where('question_id', $question_id)->update(['value' => $value]);
            } else {
                DB::table('processed_entries')->insert(['entry_id' => $entry_id, 'question_id' => $question_id, 'value' => $value]);
            }

            return response()->json(['success' => 'Data cleaned successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while cleaning data']);
        }
    }


    public function aggregate($uuid)
    {
        // Retrieve headers for the form
        $headers = $this->headers($uuid);

        // Fetch form fields for the given UUID, indexed by ID
        $formFields = FormField::whereIn('id', array_keys($headers))
            ->get()
            ->keyBy('id');

        // Initialize aggregated data array
        $aggregatedData = [];

        // Retrieve and process entries
        $entries = Entry::query()->latest()->get();

        foreach ($entries as $entry) {
            $decodedResponses = json_decode($entry->responses, true);

            foreach ($decodedResponses as $key => $value) {
                if (isset($formFields[$key])) {
                    $formField = $formFields[$key];

                    if ($formField->type === 'radio' || $formField->type === 'checkbox') {
                        $label = (string) $formField->label;

                        // Initialize the label array if it doesn't exist
                        if (!isset($aggregatedData[$label])) {
                            $aggregatedData[$label] = [];

                            // Get the sub_headers for the label
                            $subHeaders = $headers[$formField->id]['sub_headers'];
                            // Initialize the sub_headers with 0
                            foreach ($subHeaders as $subHeader) {
                                $aggregatedData[$label][$subHeader] = 0;
                            }
                        }

                        // Increment counts based on the value
                        if (is_array($value)) {
                            foreach ($value as $v) {
                                $trimmedValue = trim($v);
                                if (isset($aggregatedData[$label][$trimmedValue])) {
                                    $aggregatedData[$label][$trimmedValue]++;
                                }
                            }
                        } else {
                            $trimmedValue = trim($value);
                            if (isset($aggregatedData[$label][$trimmedValue])) {
                                $aggregatedData[$label][$trimmedValue]++;
                            }
                        }
                    }
                }
            }
        }


        return view('reports.aggregations', compact('uuid', 'aggregatedData'));
    }

    public function aggregateData(Request $request, $uuid)
    {
        try {
            // Retrieve headers for the form
            $headers = $this->headers($uuid);

            // Fetch form fields for the given UUID, indexed by ID
            $formFields = FormField::whereIn('id', array_keys($headers))
                ->get()
                ->keyBy('id');

            // Initialize aggregated data array
            $aggregatedData = [];

            // Retrieve and process entries
            $entries = Entry::query()->latest()->get();

            foreach ($entries as $entry) {
                $decodedResponses = json_decode($entry->responses, true);

                foreach ($decodedResponses as $key => $value) {
                    if (isset($formFields[$key])) {
                        $formField = $formFields[$key];

                        if ($formField->type === 'radio' || $formField->type === 'checkbox') {
                            $label = (string) $formField->label;

                            // Initialize the label array if it doesn't exist
                            if (!isset($aggregatedData[$label])) {
                                $aggregatedData[$label] = [];

                                // Get the sub_headers for the label
                                $subHeaders = $headers[$formField->id]['sub_headers'];
                                // Initialize the sub_headers with 0
                                foreach ($subHeaders as $subHeader) {
                                    $aggregatedData[$label][$subHeader] = 0;
                                }
                            }

                            // Increment counts based on the value
                            if (is_array($value)) {
                                foreach ($value as $v) {
                                    $trimmedValue = trim($v);
                                    if (isset($aggregatedData[$label][$trimmedValue])) {
                                        $aggregatedData[$label][$trimmedValue]++;
                                    }
                                }
                            } else {
                                $trimmedValue = trim($value);
                                if (isset($aggregatedData[$label][$trimmedValue])) {
                                    $aggregatedData[$label][$trimmedValue]++;
                                }
                            }
                        }
                    }
                }
            }

            // Return the aggregated data
            return response()->json(['data' => $aggregatedData]);

        } catch (\Exception $e) {
            // Return a more readable error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
