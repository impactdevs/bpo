<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Charts Section -->
            <div class="bg-white dark:bg-gray-800 mt-8 p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Size of Companies</h3>
                {!! $sizeOfCompaniesChart->container() !!}
            </div>

            <div class="bg-white dark:bg-gray-800 mt-8 p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Adoption of Technologies</h3>
                {!! $adoptionOfTechnologiesChart->container() !!}
            </div>

            <div class="bg-white dark:bg-gray-800 mt-8 p-6 rounded-lg shadow-sm">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Trends Over Time</h3>
                {!! $trendsOverTimeChart->container() !!}
            </div>
        </div>
    </div>

    <!-- Include the chart scripts -->
    {!! $sizeOfCompaniesChart->script() !!}
    {!! $adoptionOfTechnologiesChart->script() !!}
    {!! $trendsOverTimeChart->script() !!}
</x-app-layout>
