<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BPO Data Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: flex-start height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
    </style>
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

    <script>
        $(document).ready(function() {


            //show swal alert
            @if (session('success'))
                swal({
                    title: "Success!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    button: "OK",
                });
            @elseif (session('error'))
                swal({
                    title: "Error!",
                    text: "{{ session('error') }}",
                    icon: "error",
                    button: "OK",
                });
            @endif

        });
    </script>
</body>

</html>
