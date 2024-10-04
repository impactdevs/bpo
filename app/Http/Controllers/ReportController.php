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
    {        // Retrieve headers for the form
        $headers = $this->headers($uuid);

        // Create a map of headers by their label for quick lookup
        $headerLabels = [];
        foreach ($headers as $headerId => $headerData) {
            $headerLabels[$headerData['label']] = $headerData;
        }


        // Initialize query for entriesi
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
        // Eager load form fields and processed entries
        $formFieldIds = FormField::pluck('id')->toArray();
        $processedEntries = DB::table('processed_entries')
            ->whereIn('entry_id', $entries->pluck('id'))
            ->whereIn('question_id', $formFieldIds)
            ->get()
            ->groupBy('entry_id');
        // Process entries for DataTables
        $data = $entries->map(function ($entry) use ($headerLabels, $processedEntries) {
            $decodedResponses = json_decode($entry->responses, true);
            $formattedResponses = ['entry_id' => $entry->id];

            foreach ($decodedResponses as $key => $value) {
                $formField = FormField::find($key);
                if ($formField) {
                    // Safely get the processed entry for this specific entry and question
                    $processedEntry = optional($processedEntries[$entry->id])->firstWhere('question_id', $key);
                    $processedValue = $processedEntry ? $processedEntry->value : null;

                    $formattedResponses[$formField->label] = $processedValue ? [
                        'value' => $value,
                        'processed' => $processedValue
                    ] : $value;
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
            if (in_array($label->type, ['radio', 'checkbox', 'select'])) {
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

                    /**
                     * key 18 -> Professional bodies
                     * key 53 -> Primary sources of power
                     * key 78 -> Key business challenges
                     * key 59 -> essential software platforms
                     * key 52 -> internet challenges
                     */
                    if ($key == 18 || $key == 53 || $key == 78 || $key == 59 || $key == 52) {
                        $label = (string) $formField->label;

                        //get the cleaning options
                        $cleaning_options = DB::table('processed_entries')
                            ->where('question_id', $key)
                            ->pluck('value')
                            ->toArray();

                        // Initialize the label array if it doesn't exist
                        if (!isset($aggregatedData[$formField->label])) {
                            $aggregatedData[$formField->label] = [];

                            // Initialize the cleaning options with 0
                            foreach ($cleaning_options as $cleaning_option) {
                                $aggregatedData[$formField->label][$cleaning_option] = 0;
                            }

                        }

                        //get all the cleaning options where 18
                        $cleaning_options_18 = DB::table('processed_entries')
                            ->where('question_id', $key)
                            ->where('entry_id', $entry->id)
                            ->get();



                        // Increment counts based on the value
                        foreach ($cleaning_options_18 as $cleaning_option) {
                            //increment the value of current $cleaning_option->name
                            if (isset($aggregatedData[$formField->label][$cleaning_option->value])) {
                                $aggregatedData[$formField->label][$cleaning_option->value]++;
                            }
                        }
                    }

                    //Education skill levels
                    if ($key == 18 || ($key <= 43 && $key >= 34)) {
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

                        //aggregate radio button and checkbox responses with professional bodies cleaned options
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

    /*
     * Ranking
     */

    /*
     * IT Enabled-6.15, 62
     * Specialised software->6.11, 58
     * Specialised software->6.12, 59
     * work practices->6.16, 63
     * services are broken down->6.17, 64
     * services are broken down->6.18, 65
     * online businesses->6.19, 66
     * online businesses->6.20, 67,
     * Involvement in staff capacity building->6.23, 70
     * Involvement in staff capacity building->6.24, 71
     */

    public function rank(Request $request, $uuid)
    {
        try {
            //minimum points
            $minimum_points = DB::table('ranking_settings')->pluck('minimum_points')->first();
            // Retrieve headers for the form
            $headers = $this->headers($uuid);

            // Fetch form fields for the given UUID, indexed by ID
            $formFields = FormField::whereIn('id', array_keys($headers))
                ->get()
                ->keyBy('id');

            // Initialize aggregated data array
            $rankingData = [];

            // Retrieve and process entries
            $entries = Entry::query()->latest()->get();

            foreach ($entries as $entry) {
                $decodedResponses = json_decode($entry->responses, true);

                foreach ($decodedResponses as $key => $value) {
                    //get question ids 62, 58, 59, 63, 64, 65, 66, 67, 70, 71
                    if (in_array($key, [62, 58, 59, 63, 64, 65, 66, 67, 70, 71, 12])) {
                        if (isset($formFields[$key])) {
                            $formField = $formFields[$key];
                            if ($formField) {
                                $responses[$formField->label] = $value;

                                //claculate scores
                                // IT Enabled-6.15, 62
                                if ($key == 62) {
                                    $score = count($value);

                                    //add the score to the responses and name it 'it_enabled'
                                    $responses['it_enabled_score'] = $score;
                                }

                                // Specialised software->6.11, 58
                                if ($key == 58) {
                                    //check if the value is 'Yes'
                                    if ($value == 'Yes') {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }

                                    //add the score to the responses and name it 'uses_specialised_software_score'
                                    $responses['uses_specialised_software_score'] = $score;

                                }

                                // Specialised software->6.12, 59
                                if ($key == 59) {
                                    //if $value is not null
                                    if ($value) {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }
                                    //add the score to the responses and name it 'uses_specialised_software_score'
                                    $responses['specialised_software_score'] = $score;
                                }

                                // work practices->6.16, 63
                                if ($key == 63) {
                                    //score
                                    $score = count($value);
                                    //add the score to the responses and name it 'work_practices_score'
                                    $responses['work_practices_score'] = $score;
                                }

                                // services are broken down->6.17, 64
                                if ($key == 64) {
                                    //if $value is yes
                                    if ($value == 'Yes') {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }

                                    //add the score to the responses and name it 'services_broken_down_score'
                                    $responses['are_services_broken_down_score'] = $score;
                                }

                                // services are broken down->6.18, 65
                                if ($key == 65) {
                                    //if $value is not null
                                    if ($value) {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }

                                    //add the score to the responses and name it 'services_broken_down_score'
                                    $responses['services_broken_down_score'] = $score;
                                }

                                // online businesses->6.19, 66
                                if ($key == 66) {
                                    //if $value is yes
                                    if ($value == 'Yes') {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }

                                    //add the score to the responses and name it 'online_businesses_score'
                                    $responses['is_online_businesses_score'] = $score;
                                }

                                // online businesses->6.20, 67
                                if ($key == 67) {
                                    $score = count($value);

                                    //add the score to the responses and name it 'online_businesses_score'
                                    $responses['online_businesses_score'] = $score;

                                }

                                // Involvement in staff capacity building->6.23, 70
                                if ($key == 70) {
                                    //if $value is yes
                                    if ($value == 'Yes') {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }

                                    //add the score to the responses and name it 'staff_capacity_building_score'
                                    $responses['do_staff_capacity_building_score'] = $score;

                                }

                                // Involvement in staff capacity building->6.24, 71
                                if ($key == 71) {
                                    //if $value is not null
                                    if ($value) {
                                        $score = 1;
                                    } else {
                                        $score = 0;
                                    }

                                    //add the score to the responses and name it 'staff_capacity_building_score'
                                    $responses['staff_capacity_building_score'] = $score;
                                }
                            }

                        }
                    }
                }

                //total score
                $responses['total_score'] = $responses['it_enabled_score'] + $responses['uses_specialised_software_score'] + $responses['specialised_software_score'] + $responses['work_practices_score'] + $responses['are_services_broken_down_score'] + $responses['services_broken_down_score'] + $responses['is_online_businesses_score'] + $responses['online_businesses_score'] + $responses['do_staff_capacity_building_score'] + $responses['staff_capacity_building_score'];
                $rankingData[] = $responses;
            }

            // Sort the ranking data by total score in descending order
            usort($rankingData, function ($a, $b) {
                return $b['total_score'] <=> $a['total_score'];
            });
            // Return the aggregated data
            return view('reports.rankings', compact('uuid', 'rankingData', 'minimum_points'));

        } catch (\Exception $e) {
            // Return a more readable error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateMinimumPoints(Request $request)
    {
        try {
            //get the minimum points
            $minimum_points = $request->minimum_points;

            //update the minimum points
            DB::table('ranking_settings')->update(['minimum_points' => $minimum_points]);

            return response()->json(['success' => 'Minimum points updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating minimum points']);
        }
    }


}
