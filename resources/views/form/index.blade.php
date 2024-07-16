<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:400,500,600&display=swap" rel="stylesheet" />

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- include bootstrap icons in node modules --}}
    <!-- In your <head> tag -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewire('notifications')
    @filamentStyles
    @vite('resources/css/app.css')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="intro row justify-content-center mt-5">
                    <div class="col-12">
                        {{-- logo --}}
                        <div class="text-center">
                            <img src="{{ asset('assets/imgs/logo.jpg') }}" alt="logo" width="100">
                        </div>
                    </div>

                    <div class="col-12">
                        {{-- logo --}}
                        <div class="text-center">
                            <h6>Introdution</h6>
                            <p class="lead">
                                Please make sure that you have agreed to the terms and conditions before submitting the
                                form. We shall not be held responsible for any false information provided.
                                And also, please make sure that you have read the instructions carefully before filling
                                the form. The data provided will be used for the purpose of research and will be kept
                                confidential.
                                <strong>Ensure to submit before closing your browser, else you risk loosing whatever you
                                    will have filled in the form. This form will require your 25-30 minutes</strong>
                            </p>
                        </div>
                    </div>

                    <div class="col-12">
                        {{-- logo --}}
                        <div class="text-center">
                            @auth
                                <p><strong>Logged in as {{ auth()->user()->name }}</strong></p>
                            @endauth

                            @guest
                                <p><strong>Not logged in</strong></p>
                            @endguest
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> BPO Data collection</h5>
                        <form method="POST" action="{{ route('entries.store') }}" accept-charset="UTF-8"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <ol type="A">
                                <li>Introduction</li>
                                <x-forms.input label="Interviewer's Name" type="text" name="name" id="name"
                                    placeholder="Enter your name" />
                                <x-forms.input label="Date of Interview" type="date" name="date_of_interview"
                                    id="date_of_interview" />
                                <p><strong>Location of Interview</strong></p>
                                <x-forms.input label="Sub-county/Division:" type="text" name="sub_county"
                                    id="sub_county" placeholder="Enter your Sub County" />
                                <x-forms.input label="District:" type="text" name="district" id="district"
                                    placeholder="Enter your District" />
                                <x-forms.input label="Region:" type="text" name="region" id="region"
                                    placeholder="Enter your Region" />
                                <x-forms.input label="Respondent's Name" type="text" name="respondent_name"
                                    id="respondent_name" placeholder="Enter your Respondent Name" />
                                <x-forms.input label="Respondent's Organization" type="text"
                                    name="respondent_organization" id="respondent_organization"
                                    placeholder="Enter your Respondent Organization" />
                                <x-forms.input label="Respondent's Title" type="text" name="respondent_title"
                                    id="respondent_title" placeholder="Enter Respondent Title" />
                                <x-forms.radio question="Gender of Proprietor/Director" name="proprietor_gender"
                                    id="proprietor_gender" :options="[
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ]" />
                                <x-forms.input label="Respondent's Contact Number" type="text"
                                    name="respondent_contact_number" id="respondent_contact_number"
                                    placeholder="Enter Respondent Contact Number" />
                                <x-forms.input label="Respondent's Email Address" type="email"
                                    name="respondent_email_address" id="respondent_email_address"
                                    placeholder="Enter Respondent Email Address" />

                                <x-forms.radio question="Gender of Respondent" name="respondent_gender"
                                    id="respondent_gender" :options="[
                                        'male' => 'Male',
                                        'female' => 'Female',
                                    ]" />

                                <li>Legal and Administrative Compliance</li>
                                <p>This section, checks if the entity qualified or disqualified to be considered as an
                                    Outsourcing or IT ENABLED Entity for purposes of this study</p>
                                <x-forms.radio question="Is the entity registered?" name="registered_entity"
                                    id="registered_entity" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" />
                                <x-forms.radio question="If YES, Category/Type of Registration (check all that apply):"
                                    name="type_of_registration" id="type_of_registration" :options="[
                                        'single' => 'Single Member Company',
                                        'limited' => 'Limited Liability Company',
                                        'cooperative' => 'Cooperative (URSB/Registrar of Cooperatives)',
                                    ]" />

                                <x-forms.input label="(Still If YES), when was the company established" type="date"
                                    name="date_of_establishment" id="date_of_establishment" />

                                <p><strong>
                                        Administrative Compliance
                                    </strong></p>

                                <x-forms.radio
                                    question="Is the entity/company registered with any professional or industry organization?"
                                    name="professional_or_industry_organization"
                                    id="professional_or_industry_organization" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />

                                <x-forms.radio question="Do you have a valid certificate?" name="valid_certificate"
                                    id="valid_certificate" :options="[
                                        'yes, seen' => 'Yes, seen',
                                        'Yes, not seen/expired' => 'Yes, not seen/expired',
                                        'No' => 'No',
                                    ]" />

                                <x-forms.checkbox question="What support have you received? (check all that apply)"
                                    name="support_received" id="support_received" :options="[
                                        'Advocacy' => 'Advocacy',
                                        'Training' => 'Training',
                                        'Networking Meetings' => 'Networking Meetings',
                                        'Access to Funding and Grants' => 'Access to Funding and Grants',
                                        'None of these' => 'None of these',
                                    ]" />

                                <p><strong>IT Enabled Services Checker</strong></p>
                                <p><strong>Use of digitization of services</strong></p>

                                <x-forms.radio question="Do you use specialized software to provide your services?"
                                    name="specialized_software" id="specialized_software" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />

                                <x-forms.checkbox
                                    question="Do you do any of the following as part of your business processes(Tick)"
                                    name="business_processes" id="business_processes" :options="[
                                        'Analog to Digital eg Paper to Digital' =>
                                            'Analog to Digital eg Paper to Digital',
                                        'Automation' => 'Automation',
                                        'Digital Workflows' => 'Digital Workflows',
                                        'Data Management' => 'Data Management',
                                        'Cloud Computing' => 'Cloud Computing',
                                        'Enhanced Customer Interaction' => 'Enhanced Customer Interaction',
                                        'Cloud Computing' => 'Cloud Computing',
                                        'Data Analytics and Business Intelligence' =>
                                            'Data Analytics and Business Intelligence',
                                        'Security and Compliance' => 'Security and Compliance',
                                        'Innovation and Agility' => 'Innovation and Agility',
                                        'Integration of IT systems' => 'Integration of IT systems',
                                    ]" />

                                <p>
                                    <strong>Use of codification of services</strong>
                                </p>
                                <p>
                                    <strong>Do You have any of the following processes;</strong>
                                </p>

                                <x-forms.checkbox
                                    question="Do you do any of the following as part of your business processes(Tick)"
                                    name="processes" id="processes" :options="[
                                        'Knowledge Management processes' => 'Knowledge Management processes',
                                        'Standard Operating Procedures (SOPs)' =>
                                            'Standard Operating Procedures (SOPs)',
                                        'Documentation' => 'Documentation',
                                        'Best Practices and Guidelines' => 'Best Practices and Guidelines',
                                        'Data Codification' => 'Data Codification',
                                    ]" />

                                <x-forms.radio
                                    question="Are you registered  on any online platform to facilitate trade and enable you provide your services?"
                                    name="registered_online" id="registered_online" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />

                                <p>Employees</p>

                                <p>What is the current total number of full-time employees in your company?</p>
                                <x-forms.input label="Number of Management/Technical staff" type="number"
                                    name="technical_staff" id="technical_staff"
                                    placeholder="Enter Number of Management/Technical staff" />

                                <x-forms.input label="Support" type="number" name="support_staff"
                                    id="support_staff" placeholder="Enter Number of Support staff" />

                                <x-forms.input label="Female Staff" type="number" name="female_staff"
                                    id="female_staff" placeholder="Enter Number of Female Staff" />

                                <x-forms.input label="Male Staff" type="number" name="male_staff" id="male_staff"
                                    placeholder="Enter Number of Male Staff" />

                                <x-forms.checkbox question="Where do you operate your business?"
                                    name="business_location" id="business_location" :options="[
                                        'Office' => 'Office',
                                        'Home based' => 'Home based',
                                    ]" />

                                <p><strong>Internet Connectivity</strong></p>
                                <x-forms.radio question="Do you have internet connectivity?"
                                    name="internet_connectivity" id="internet_connectivity" :options="[
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    ]" />

                                <x-forms.radio question="If YES, what type of internet connectivity do you have?"
                                    name="internet_connectivity_type" id="internet_connectivity_type"
                                    :options="[
                                        'Fiber Optic' => 'Fiber Optic',
                                        'DSL(GSM Phone)' => 'DSL(GSM Phone)',
                                        'Satellite' => 'Satellite',
                                        'Wifi' => 'Wifi',
                                    ]" />

                                <x-forms.radio question="Do you have backup power supply?" name="backup_power_supply"
                                    id="backup_power_supply" :options="[
                                        'Yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />

                                <p>
                                    <strong>If YES, what is the capacity of your backup power supply (in KVAs)?
                                    </strong>
                                </p>

                                <x-forms.input label="Solar " type="text" name="solar" id="solar"
                                    placeholder="Solar" />

                                <x-forms.input label="UPS (Uninterruptible Power Supply) " type="text"
                                    name="ups" id="ups"
                                    placeholder="UPS (Uninterruptible Power Supply) " />

                                <x-forms.input label="Generator" type="text" name="generator" id="generator"
                                    placeholder="Generator" />

                                <p>
                                    <strong>Hardware</strong>
                                </p>

                                <x-forms.checkbox
                                    question="What are the main types of hardware used in your operations? (e.g., Servers,
                                        Desktops, Laptops): (multiple choice)"
                                    name="hardware_types" id="hardware_types" :options="[
                                        'Servers ' => 'Servers ',
                                        'Desktops' => 'Desktops',
                                        'Laptops' => 'Laptops',
                                        'UPS (Uninterruptible Power Supply) ' => 'UPS (Uninterruptible Power Supply) ',
                                        'Generator' => 'Generator',
                                    ]" />



                                <x-forms.radio
                                    question="In the last 4 years, hava your staff attended any training aimed at improving skills in outsourcing IT-Enabled Services?"
                                    name="any_training_attended" id="any_training_attended" :options="[
                                        'Yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />

                                <x-forms.radio question="How would you rank the effectiveness of those trainings?"
                                    name="atraining_effectiveness" id="atraining_effectiveness" :options="[
                                        '1 = Very effective' => '1 = Very effective',
                                        '2 = Extremely helpful' => '2 = Extremely helpful',
                                        '3 = Slightly helpful' => '3 = Slightly helpful',
                                        '4 = Not helpful' => '4 = Not helpful',
                                    ]" />

                                <p>
                                    <strong>Enterprise Training Needs</strong>


                                </p>

                                <x-forms.radio
                                    question="Are there specific enterprise training needs you would require?"
                                    name="training_needs" id="training_needs" :options="[
                                        'Yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />

                                <p>
                                    What is the age group of your employees? Group them according to employable ages(as
                                    per employment ages in Uganda)
                                </p>

                                <x-forms.input label="18-24" type="number" name=" 18-24" id="18-24" />

                                <x-forms.input label="25 - 34" type="number" name="25 - 34" id="25 - 34" />

                                <x-forms.input label="34 - 54" type="number" name="34 - 54" id="34 - 54" />

                                <x-forms.input label="55 - 64" type="number" name="55 - 64" id="55 - 64" />

                                <x-forms.radio
                                    question="Are there any incentives that you know of being given to companies within the outsourcing sector (to realize growth of the sector)?"
                                    name="known_incentives" id="known_incentives" :options="[
                                        'Yes' => 'Yes',
                                        'no' => 'Yes',
                                    ]" />
                                <!-- Support Requirements -->
                                <div id="support-requirements">
                                    <!-- Initial support requirement field -->
                                    <div class="support-requirement grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                                        <div class="mb-4">
                                            <label for="support_description"
                                                class="block text-sm font-medium text-gray-600">What support would you
                                                require? (please specify)</label>
                                            <input type="text" name="support_description[]"
                                                class="form-input w-full border rounded-md shadow-sm"
                                                placeholder="Specify Support" required>
                                        </div>
                                        <div class="flex items-center">
                                            <button type="button"
                                                class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-support-requirement hidden">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mb-4">
                                    <button type="button" id="add-support-requirement"
                                        class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
                                </div>

                                <!-- Internet Service Challenges -->
                                <div id="internet-challenges">
                                    <!-- Initial challenge field -->
                                    <div class="internet-challenge grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                                        <div class="mb-4">
                                            <label for="challenge_description"
                                                class="block text-sm font-medium text-gray-600">What challenges have
                                                you experienced in the last 12 months relating to the internet services
                                                you use?</label>
                                            <input type="text" name="challenge_description[]"
                                                class="form-input w-full border rounded-md shadow-sm"
                                                placeholder="Specify Challenge" required>
                                        </div>
                                        <div class="flex items-center">
                                            <button type="button"
                                                class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-internet-challenge hidden">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mb-4">
                                    <button type="button" id="add-internet-challenge"
                                        class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
                                </div>

                                <!-- Training Institutions -->
                                <div id="training-institutions">
                                    <!-- Initial training institution field -->
                                    <div class="training-institution grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                                        <div class="mb-4">
                                            <label for="training_institution"
                                                class="block text-sm font-medium text-gray-600">What institutions or
                                                entities delivered the training?</label>
                                            <input type="text" name="training_institution[]"
                                                class="form-input w-full border rounded-md shadow-sm"
                                                placeholder="Specify Training Institution" required>
                                        </div>
                                        <div class="flex items-center">
                                            <button type="button"
                                                class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-training-institution hidden">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mb-4">
                                    <button type="button" id="add-training-institution"
                                        class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
                                </div>

                                <!-- Power Sources -->
                                <div id="power-sources">
                                    <!-- Initial power source field -->
                                    <div class="power-source grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                                        <div class="mb-4">
                                            <label for="power_source"
                                                class="block text-sm font-medium text-gray-600">What is your primary
                                                source(s) of power in the order of importance? (e.g., National Grid,
                                                Solar)</label>
                                            <input type="text" name="power_source[]"
                                                class="form-input w-full border rounded-md shadow-sm"
                                                placeholder="Specify Power Source" required>
                                        </div>
                                        <div class="flex items-center">
                                            <button type="button"
                                                class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-power-source hidden">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end mb-4">
                                    <button type="button" id="add-power-source"
                                        class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
                                </div>

                                <!-- Enterprise Training Needs -->
                                <div id="enterprise-training-needs">
                                    <div class="grid grid-cols-2 gap-6 mb-3">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-600">Are there specific
                                                enterprise training needs you would require?</label>
                                            <div class="flex items-center">
                                                <input type="radio" id="enterprise_training_yes"
                                                    name="enterprise_training_needs" value="yes">
                                                <label for="enterprise_training_yes" class="ml-2">YES</label>
                                                <input type="radio" id="enterprise_training_no"
                                                    name="enterprise_training_needs" value="no">
                                                <label for="enterprise_training_no" class="ml-2">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Fields for Enterprise Training Needs -->
                                <div id="enterprise-training-needs-fields">
                                    <!-- Template for training need field -->
                                    <div
                                        class="enterprise-training-need grid grid-cols-1 md:grid-cols-2 gap-6 mb-3 hidden">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-600">Training
                                                Need</label>
                                            <input type="text" name="enterprise_training_need[]"
                                                class="form-input w-full border rounded-md shadow-sm"
                                                placeholder="Enter Training Need" required>
                                        </div>
                                        <div class="flex items-center">
                                            <button type="button"
                                                class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-enterprise-training-need">Remove</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mb-4">
                                    <button type="button" id="add-enterprise-training-need"
                                        class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add
                                        Training Need</button>
                                </div>

                                <!-- Incentives and Support -->
                                <div id="incentives-support">
                                    <div class="grid grid-cols-2 gap-6 mb-3">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-600">Are there any
                                                incentives that you know of being given to companies within the
                                                outsourcing sector (to realize growth of the sector)?</label>
                                            <div class="flex items-center">
                                                <input type="radio" id="incentives_yes" name="incentives_support"
                                                    value="yes">
                                                <label for="incentives_yes" class="ml-2">YES</label>
                                                <input type="radio" id="incentives_no" name="incentives_support"
                                                    value="no">
                                                <label for="incentives_no" class="ml-2">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic Fields for Incentives -->
                                <div id="incentives-fields">
                                    <!-- Template for incentives field -->
                                    <div class="incentives grid grid-cols-1 gap-6 mb-3 hidden">
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-600">Incentive
                                                Description</label>
                                            <textarea name="incentive_description[]" rows="3" class="form-textarea w-full border rounded-md shadow-sm"
                                                placeholder="Enter Incentive Description" required></textarea>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button"
                                                class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-incentive">Remove</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mb-4">
                                    <button type="button" id="add-incentive"
                                        class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add
                                        Incentive</button>
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-6 text-center">
                                    <button type="submit"
                                        class="btn bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm">
                                        Submit
                                    </button>
                                </div>

                                <!-- 2.1 Is the entity/company registered with any professional or industry organization? -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-600">Is the entity/company
                                        registered with any professional or industry organization?</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input id="registered_yes" name="registered_organization" type="radio"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                                value="yes">
                                            <label for="registered_yes"
                                                class="ml-3 block text-sm font-medium text-gray-700">YES</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="registered_no" name="registered_organization" type="radio"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                                value="no">
                                            <label for="registered_no"
                                                class="ml-3 block text-sm font-medium text-gray-700">NO</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2.2 If YES, name the organization(s): -->
                                <div id="organization-fields" class="hidden">
                                    <div id="uganda-organizations">
                                        <label class="block text-sm font-medium text-gray-600">Uganda
                                            Organizations:</label>
                                        <div class="organization-list mb-3">
                                            <div class="mb-2">
                                                <input type="text" name="uganda_organizations[]"
                                                    class="form-input w-full border rounded-md shadow-sm"
                                                    placeholder="Organization Name" required>
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button" id="add-uganda-organization"
                                                class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add
                                                Uganda Organization</button>
                                        </div>
                                    </div>

                                    <div id="international-organizations">
                                        <label class="block text-sm font-medium text-gray-600">International
                                            Organizations:</label>
                                        <div class="organization-list mb-3">
                                            <div class="mb-2">
                                                <input type="text" name="international_organizations[]"
                                                    class="form-input w-full border rounded-md shadow-sm"
                                                    placeholder="Organization Name" required>
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button" id="add-international-organization"
                                                class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add
                                                International Organization</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-6 text-center">
                                    <button type="submit"
                                        class="btn bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm">
                                        Submit
                                    </button>
                                </div>
                            </ol>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            // Add new support requirement
            $('#add-support-requirement').click(function() {
                var supportRequirementHtml = `
            <div class="support-requirement grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="support_description" class="block text-sm font-medium text-gray-600">What support would you require? (please specify)</label>
                    <input type="text" name="support_description[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Support" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-support-requirement">Remove</button>
                </div>
            </div>`;
                $('#support-requirements').append(supportRequirementHtml);
                toggleSupportRemoveButtons();
            });

            // Add new internet challenge
            $('#add-internet-challenge').click(function() {
                var internetChallengeHtml = `
            <div class="internet-challenge grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="challenge_description" class="block text-sm font-medium text-gray-600">What challenges have you experienced in the last 12 months relating to the internet services you use?</label>
                    <input type="text" name="challenge_description[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Challenge" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-internet-challenge">Remove</button>
                </div>
            </div>`;
                $('#internet-challenges').append(internetChallengeHtml);
                toggleChallengeRemoveButtons();
            });

            // Add new training institution
            $('#add-training-institution').click(function() {
                var trainingInstitutionHtml = `
            <div class="training-institution grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="training_institution" class="block text-sm font-medium text-gray-600">What institutions or entities delivered the training?</label>
                    <input type="text" name="training_institution[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Training Institution" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-training-institution">Remove</button>
                </div>
            </div>`;
                $('#training-institutions').append(trainingInstitutionHtml);
                toggleTrainingInstitutionRemoveButtons();
            });

            // Add new power source
            $('#add-power-source').click(function() {
                var powerSourceHtml = `
            <div class="power-source grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="power_source" class="block text-sm font-medium text-gray-600">What is your primary source(s) of power in the order of importance? (e.g., National Grid, Solar)</label>
                    <input type="text" name="power_source[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Power Source" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-power-source">Remove</button>
                </div>
            </div>`;
                $('#power-sources').append(powerSourceHtml);
                togglePowerSourceRemoveButtons();
            });

            // Add new enterprise training need field if "YES" is selected
            $('#add-enterprise-training-need').click(function() {
                var enterpriseTrainingNeedHtml = `
            <div class="enterprise-training-need grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Training Need</label>
                    <input type="text" name="enterprise_training_need[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Enter Training Need" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-enterprise-training-need">Remove</button>
                </div>
            </div>`;
                $('#enterprise-training-needs-fields').append(enterpriseTrainingNeedHtml);
                toggleEnterpriseTrainingNeedRemoveButtons();
            });

            // Add new incentive field if "YES" is selected
            $('#add-incentive').click(function() {
                var incentiveHtml = `
            <div class="incentives grid grid-cols-1 gap-6 mb-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Incentive Description</label>
                    <textarea name="incentive_description[]" rows="3" class="form-textarea w-full border rounded-md shadow-sm" placeholder="Enter Incentive Description" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-incentive">Remove</button>
                </div>
            </div>`;
                $('#incentives-fields').append(incentiveHtml);
                toggleIncentiveRemoveButtons();
            });

            // Toggle remove buttons based on the number of support requirements
            function toggleSupportRemoveButtons() {
                var supportRequirementsCount = $('.support-requirement').length;
                if (supportRequirementsCount > 1) {
                    $('.remove-support-requirement').removeClass('hidden');
                } else {
                    $('.remove-support-requirement').addClass('hidden');
                }
            }

            // Toggle remove buttons based on the number of internet challenges
            function toggleChallengeRemoveButtons() {
                var challengeCount = $('.internet-challenge').length;
                if (challengeCount > 1) {
                    $('.remove-internet-challenge').removeClass('hidden');
                } else {
                    $('.remove-internet-challenge').addClass('hidden');
                }
            }

            // Toggle remove buttons based on the number of training institutions
            function toggleTrainingInstitutionRemoveButtons() {
                var trainingInstitutionCount = $('.training-institution').length;
                if (trainingInstitutionCount > 1) {
                    $('.remove-training-institution').removeClass('hidden');
                } else {
                    $('.remove-training-institution').addClass('hidden');
                }
            }

            // Toggle remove buttons based on the number of power sources
            function togglePowerSourceRemoveButtons() {
                var powerSourceCount = $('.power-source').length;
                if (powerSourceCount > 1) {
                    $('.remove-power-source').removeClass('hidden');
                } else {
                    $('.remove-power-source').addClass('hidden');
                }
            }

            // Toggle remove buttons based on the number of enterprise training needs
            function toggleEnterpriseTrainingNeedRemoveButtons() {
                var enterpriseTrainingNeedCount = $('.enterprise-training-need').length;
                if (enterpriseTrainingNeedCount > 1) {
                    $('.remove-enterprise-training-need').removeClass('hidden');
                } else {
                    $('.remove-enterprise-training-need').addClass('hidden');
                }
            }

            // Toggle remove buttons based on the number of incentives
            function toggleIncentiveRemoveButtons() {
                var incentiveCount = $('.incentives').length;
                if (incentiveCount > 1) {
                    $('.remove-incentive').removeClass('hidden');
                } else {
                    $('.remove-incentive').addClass('hidden');
                }
            }

            // Remove support requirement
            $(document).on('click', '.remove-support-requirement', function() {
                $(this).closest('.support-requirement').remove();
                toggleSupportRemoveButtons();
            });

            // Remove internet challenge
            $(document).on('click', '.remove-internet-challenge', function() {
                $(this).closest('.internet-challenge').remove();
                toggleChallengeRemoveButtons();
            });

            // Remove training institution
            $(document).on('click', '.remove-training-institution', function() {
                $(this).closest('.training-institution').remove();
                toggleTrainingInstitutionRemoveButtons();
            });

            // Remove power source
            $(document).on('click', '.remove-power-source', function() {
                $(this).closest('.power-source').remove();
                togglePowerSourceRemoveButtons();
            });

            // Remove enterprise training need
            $(document).on('click', '.remove-enterprise-training-need', function() {
                $(this).closest('.enterprise-training-need').remove();
                toggleEnterpriseTrainingNeedRemoveButtons();
            });

            // Remove incentive
            $(document).on('click', '.remove-incentive', function() {
                $(this).closest('.incentives').remove();
                toggleIncentiveRemoveButtons();
            });

            // Show or hide enterprise training needs fields based on selection
            $('input[name="enterprise_training_needs"]').change(function() {
                var value = $(this).val();
                if (value === 'yes') {
                    $('#enterprise-training-needs-fields').removeClass('hidden');
                } else {
                    $('#enterprise-training-needs-fields').addClass('hidden');
                    $('.enterprise-training-need').remove();
                }
            });

            // Show or hide incentives fields based on selection
            $('input[name="incentives_support"]').change(function() {
                var value = $(this).val();
                if (value === 'yes') {
                    $('#incentives-fields').removeClass('hidden');
                } else {
                    $('#incentives-fields').addClass('hidden');
                    $('.incentives').remove();
                }
            });

            // Initialize remove buttons visibility
            toggleSupportRemoveButtons();
            toggleChallengeRemoveButtons();
            toggleTrainingInstitutionRemoveButtons();
            togglePowerSourceRemoveButtons();
            toggleEnterpriseTrainingNeedRemoveButtons();
            toggleIncentiveRemoveButtons();


            // Show organization fields if YES is selected
            $('input[name="registered_organization"]').change(function() {
                var value = $(this).val();
                if (value === 'yes') {
                    $('#organization-fields').removeClass('hidden');
                } else {
                    $('#organization-fields').addClass('hidden');
                    $('.organization-list').empty(); // Clear any existing organization entries
                }
            });

            // Add new Uganda organization field
            $('#add-uganda-organization').click(function() {
                var ugandaOrganizationHtml = `
            <div class="mb-2">
                <input type="text" name="uganda_organizations[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Organization Name" required>
            </div>`;
                $('#uganda-organizations .organization-list').append(ugandaOrganizationHtml);
            });

            // Add new International organization field
            $('#add-international-organization').click(function() {
                var internationalOrganizationHtml = `
            <div class="mb-2">
                <input type="text" name="international_organizations[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Organization Name" required>
            </div>`;
                $('#international-organizations .organization-list').append(internationalOrganizationHtml);
            });
        });
    </script>
</body>

</html>
