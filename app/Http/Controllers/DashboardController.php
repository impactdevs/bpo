<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart; // Include the generated chart class
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart; // Include LarapexChart facade
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
            $office_locations = $this->office_locations();
            $home_based_locations = $this->home_based_locations();
            $male_ceos = $this->ceo_male();
            $female_ceos = $this->ceo_female();
            $by_industry_segment = $this->entities_by_industry_segment();
            // Separate the keys and values for the chart
            $labels = $by_industry_segment->keys()->toArray();
            $data = $by_industry_segment->values()->toArray();
            return view('dashboard', compact('entries', 'registered', 'office_locations', 'home_based_locations', 'male_ceos', 'female_ceos', 'labels', 'data'));
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

}
