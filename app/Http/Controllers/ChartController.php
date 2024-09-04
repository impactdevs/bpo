<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class ChartController extends Controller
{
    //
    public function dashboard()
    {
        $sizeOfCompaniesChart = LarapexChart::setTitle('Size of Companies')
            ->setType('pie')
            ->setLabels(['Small', 'Medium', 'Large'])
            ->setDataset([30, 50, 20]); // Dummy data for example

        $adoptionOfTechnologiesChart = LarapexChart::setTitle('Adoption of Technologies')
            ->setType('bar')
            ->setXAxis(['Cloud Computing', 'Automation', 'Data Analytics'])
            ->setDataset([
                [
                    'name' => 'Adoption Rate (%)',
                    'data' => [60, 75, 50]
                ]
            ]);

        $trendsOverTimeChart = LarapexChart::setTitle('Growth of Registered Entities Over Time')
            ->setType('line')
            ->setXAxis(['January', 'February', 'March', 'April', 'May'])
            ->setDataset([
                [
                    'name' => 'Registered Entities',
                    'data' => [100, 120, 140, 160, 180]
                ]
            ]);

        return view('dashboard', compact('sizeOfCompaniesChart', 'adoptionOfTechnologiesChart', 'trendsOverTimeChart'));
    }
}
