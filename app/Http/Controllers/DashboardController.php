<?php

namespace App\Http\Controllers;

use App\Models\Entry;


class DashboardController extends Controller
{
    public function index()
    {
        // get all entries
        $entries = $this->entries();
        $registered = $this->registered_entities();
        $office_locations = $this->office_locations();
        $home_based_locations = $this->home_based_locations();
        $male_ceos = $this->ceo_male();
        $female_ceos = $this->ceo_female();
        $by_industry_segment = $this->entities_by_industry_segment();
        // Separate the keys and values for the chart
        $labels = $by_industry_segment->keys()->toArray();
        $data = $by_industry_segment->values()->toArray();
        $by_business_process = $this->entities_by_business_processes();
        $labels2 = $by_business_process->keys()->toArray();
        $data2 = $by_business_process->values()->toArray();
        // work practices
        $by_work_practice = $this->work_practices();
        // Prepare data for the pie chart
        $labels3 = $by_work_practice->keys()->toArray();
        $data3 = $by_work_practice->values()->toArray();

        //broken process
        $broken = $this->broken_process();
        //registered online
        $registered_online = $this->registered_online();

        //main clients
        $main_clients = $this->main_clients();

        //prepare data for the pie chart
        $labels4 = $main_clients->keys()->toArray();
        $data4 = $main_clients->values()->toArray();

        //academic qualifications
        $academicQualifications = $this->academicQualifications();

        //prepared the dat for plotting in order of management and support staff
        $labels5 = array_keys($academicQualifications['management']);
        $data5 = array_values($academicQualifications['management']);
        $labels6 = array_keys($academicQualifications['support']);
        $data6 = array_values($academicQualifications['support']);
        return view('dashboard', compact(
            'entries',
            'registered',
            'office_locations',
            'home_based_locations',
            'male_ceos',
            'female_ceos',
            'labels',
            'data',
            'labels2',
            'data2',
            'labels3',
            'data3',
            'broken',
            'registered_online',
            'labels4',
            'data4',
            'labels5',
            'data5',
            'labels6',
            'data6'
        ));
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

    public function broken_process()
    {
        // get all entries
        $broken = Entry::whereJsonContains('responses->64', 'Yes')->count();

        return $broken;
    }

    public function registered_online()
    {
        // get all entries
        $registered_online = Entry::whereJsonContains('responses->66', 'Yes')->count();

        return $registered_online;
    }

    public function office_locations()
    {
        // get all entries
        $office_locations = Entry::whereJsonContains('responses->28', 'Office')->count();

        return $office_locations;
    }

    public function home_based_locations()
    {
        // get all entries
        $home_based_locations = Entry::whereJsonContains('responses->28', 'Home based')->count();

        return $home_based_locations;
    }

    public function ceo_male()
    {
        $cem = Entry::whereJsonContains('responses->13', 'Male')->count();

        return $cem;
    }

    public function ceo_female()
    {
        $cef = Entry::whereJsonContains('responses->13', 'Female')->count();

        return $cef;
    }

    public function entities_by_industry_segment()
    {
        // Get the responses and decode the JSON
        $entries = Entry::select('responses->25 as industry_segment')->get();

        // Initialize an empty array to hold the individual segments
        $segments = [];

        // Loop through the entries and extract individual segments
        foreach ($entries as $entry) {
            // Decode the JSON string into an array
            $industrySegments = json_decode($entry->industry_segment);

            // Add each segment to the segments array
            if (is_array($industrySegments)) {
                foreach ($industrySegments as $segment) {
                    $segments[] = $segment;
                }
            }
        }

        // Count occurrences of each segment
        $by_industry_segment = collect($segments)->countBy();

        return $by_industry_segment;
    }

    public function entities_by_business_processes()
    {
        // Get the responses and decode the JSON
        $entries = Entry::select('responses->62 as business_process')->get();

        // Initialize an empty array to hold the individual segments
        $processes = [];

        // Loop through the entries and extract individual segments
        foreach ($entries as $entry) {
            // Decode the JSON string into an array
            $businessProcess = json_decode($entry->business_process);

            // Add each segment to the segments array
            if (is_array($businessProcess)) {
                foreach ($businessProcess as $process) {
                    $processes[] = $process;
                }
            }
        }

        // Count occurrences of each segment
        $by_business_process = collect($processes)->countBy();

        return $by_business_process;
    }

    public function work_practices()
    {
        // Get the responses and decode the JSON
        $entries = Entry::select('responses->63 as work_practice')->get();

        // Initialize an empty array to hold the individual segments
        $practice = [];

        // Loop through the entries and extract individual segments
        foreach ($entries as $entry) {
            // Decode the JSON string into an array
            $workPractice = json_decode($entry->work_practice);

            // Add each segment to the segments array
            if (is_array($workPractice)) {
                foreach ($workPractice as $process) {
                    $practice[] = $process;
                }
            }
        }

        // Count occurrences of each segment
        $by_work_practice = collect($practice)->countBy();

        return $by_work_practice;
    }

    public function main_clients()
    {
        // Get the responses and decode the JSON
        $entries = Entry::select('responses->27 as main_clients')->get();

        // Initialize an empty array to hold the individual segments
        $client = [];

        // Loop through the entries and extract individual segments
        foreach ($entries as $entry) {
            // Decode the JSON string into an array
            $mainClients = json_decode($entry->main_clients);

            // Add each segment to the segments array
            if (is_array($mainClients)) {
                foreach ($mainClients as $clientele) {
                    $client[] = $clientele;
                }
            }
        }

        // Count occurrences of each segment
        $by_work_practice = collect($client)->countBy();

        return $by_work_practice;
    }

    public function sizeOfTheCompany()
    {
        // Define thresholds for company sizes
        $smallThreshold = 10; // Companies with 10 or fewer employees are considered 'Small'
        $mediumThreshold = 20; // Companies with more than 10 but up to 20 employees are 'Medium'

        // Initialize counters for each company size category
        $smallCount = 0;
        $mediumCount = 0;
        $largeCount = 0;

        // Get entries with the number of male and female employees
        $entries = Entry::select('responses->32 as male_staff', 'responses->33 as female_staff')->get();

        foreach ($entries as $entry) {
            // Convert JSON strings to integers, default to 0 if they are null or not set
            $maleStaffCount = (int) ($entry->male_staff ?? 0);
            $femaleStaffCount = (int) ($entry->female_staff ?? 0);

            // Calculate the total number of employees
            $totalEmployees = $maleStaffCount + $femaleStaffCount;

            // Classify the company based on the total number of employees
            if ($totalEmployees <= $smallThreshold) {
                $smallCount++;
            } elseif ($totalEmployees <= $mediumThreshold) {
                $mediumCount++;
            } else {
                $largeCount++;
            }
        }

        // Prepare data for the pie chart
        $labels = ['Small', 'Medium', 'Large'];
        $data = [$smallCount, $mediumCount, $largeCount];

        // Return data as a JSON response
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function academicQualifications()
    {
        // Initialize arrays to hold qualifications for management and support staff
        $managementQualifications = [];
        $supportQualifications = [];

        // Get entries for management staff qualifications (keys 34 to 38)
        for ($i = 34; $i <= 38; $i++) {
            $managementEntries = Entry::select("responses->$i as qualification", "id")->get();

            // Group qualifications for management staff
            foreach ($managementEntries as $entry) {
                $qualification = $entry->qualification;
                if ($qualification) {
                    $managementQualifications[] = $qualification;
                }
            }
        }

        // Get entries for support staff qualifications (keys 39 to 43)
        for ($i = 39; $i <= 43; $i++) {
            $supportEntries = Entry::select("responses->$i as qualification", "id")->get();

            // Group qualifications for support staff
            foreach ($supportEntries as $entry) {
                $qualification = $entry->qualification;
                if ($qualification) {
                    $supportQualifications[] = $qualification;
                }
            }
        }

        // Count occurrences of qualifications
        $managementQualificationsCount = array_count_values($managementQualifications);
        $supportQualificationsCount = array_count_values($supportQualifications);

        // Return the results
        return [
            'management' => $managementQualificationsCount,
            'support' => $supportQualificationsCount,
        ];
    }



}
