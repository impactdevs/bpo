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
        </div>
    </div>

    {{-- form container --}}
<div class="bg-white shadow-md rounded-lg p-6">
    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf

        <!-- Support Requirements -->
        <div id="support-requirements">
            <!-- Initial support requirement field -->
            <div class="support-requirement grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="support_description" class="block text-sm font-medium text-gray-600">What support would you require? (please specify)</label>
                    <input type="text" name="support_description[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Support" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-support-requirement hidden">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-4">
            <button type="button" id="add-support-requirement" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
        </div>

        <!-- Internet Service Challenges -->
        <div id="internet-challenges">
            <!-- Initial challenge field -->
            <div class="internet-challenge grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="challenge_description" class="block text-sm font-medium text-gray-600">What challenges have you experienced in the last 12 months relating to the internet services you use?</label>
                    <input type="text" name="challenge_description[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Challenge" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-internet-challenge hidden">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-4">
            <button type="button" id="add-internet-challenge" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
        </div>

        <!-- Training Institutions -->
        <div id="training-institutions">
            <!-- Initial training institution field -->
            <div class="training-institution grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="training_institution" class="block text-sm font-medium text-gray-600">What institutions or entities delivered the training?</label>
                    <input type="text" name="training_institution[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Training Institution" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-training-institution hidden">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-4">
            <button type="button" id="add-training-institution" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
        </div>

        <!-- Power Sources -->
        <div id="power-sources">
            <!-- Initial power source field -->
            <div class="power-source grid grid-cols-1 md:grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label for="power_source" class="block text-sm font-medium text-gray-600">What is your primary source(s) of power in the order of importance? (e.g., National Grid, Solar)</label>
                    <input type="text" name="power_source[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Specify Power Source" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-power-source hidden">
                        Remove
                    </button>
                </div>
            </div>
        </div>
        <div class="flex justify-end mb-4">
            <button type="button" id="add-power-source" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add</button>
        </div>

        <!-- Enterprise Training Needs -->
        <div id="enterprise-training-needs">
            <div class="grid grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Are there specific enterprise training needs you would require?</label>
                    <div class="flex items-center">
                        <input type="radio" id="enterprise_training_yes" name="enterprise_training_needs" value="yes">
                        <label for="enterprise_training_yes" class="ml-2">YES</label>
                        <input type="radio" id="enterprise_training_no" name="enterprise_training_needs" value="no">
                        <label for="enterprise_training_no" class="ml-2">NO</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Fields for Enterprise Training Needs -->
        <div id="enterprise-training-needs-fields">
            <!-- Template for training need field -->
            <div class="enterprise-training-need grid grid-cols-1 md:grid-cols-2 gap-6 mb-3 hidden">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Training Need</label>
                    <input type="text" name="enterprise_training_need[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Enter Training Need" required>
                </div>
                <div class="flex items-center">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-enterprise-training-need">Remove</button>
                </div>
            </div>
        </div>

        <div class="flex justify-end mb-4">
            <button type="button" id="add-enterprise-training-need" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add Training Need</button>
        </div>

        <!-- Incentives and Support -->
        <div id="incentives-support">
            <div class="grid grid-cols-2 gap-6 mb-3">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Are there any incentives that you know of being given to companies within the outsourcing sector (to realize growth of the sector)?</label>
                    <div class="flex items-center">
                        <input type="radio" id="incentives_yes" name="incentives_support" value="yes">
                        <label for="incentives_yes" class="ml-2">YES</label>
                        <input type="radio" id="incentives_no" name="incentives_support" value="no">
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
                    <label class="block text-sm font-medium text-gray-600">Incentive Description</label>
                    <textarea name="incentive_description[]" rows="3" class="form-textarea w-full border rounded-md shadow-sm" placeholder="Enter Incentive Description" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm remove-incentive">Remove</button>
                </div>
            </div>
        </div>

        <div class="flex justify-end mb-4">
            <button type="button" id="add-incentive" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add Incentive</button>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 text-center">
            <button type="submit" class="btn bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm">
                Submit
            </button>
        </div>
    </form>
</div>

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
    });
</script>


    {{-- form container --}}


    {{-- orginization form --}}
    <!-- Professional or Industry Organizations -->
<div class="bg-white shadow-md rounded-lg p-6 mb-6">
    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        <!-- 2.1 Is the entity/company registered with any professional or industry organization? -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-600">Is the entity/company registered with any professional or industry organization?</label>
            <div class="mt-2 space-y-2">
                <div class="flex items-center">
                    <input id="registered_yes" name="registered_organization" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="yes">
                    <label for="registered_yes" class="ml-3 block text-sm font-medium text-gray-700">YES</label>
                </div>
                <div class="flex items-center">
                    <input id="registered_no" name="registered_organization" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" value="no">
                    <label for="registered_no" class="ml-3 block text-sm font-medium text-gray-700">NO</label>
                </div>
            </div>
        </div>

        <!-- 2.2 If YES, name the organization(s): -->
        <div id="organization-fields" class="hidden">
            <div id="uganda-organizations">
                <label class="block text-sm font-medium text-gray-600">Uganda Organizations:</label>
                <div class="organization-list mb-3">
                    <div class="mb-2">
                        <input type="text" name="uganda_organizations[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Organization Name" required>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="add-uganda-organization" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add Uganda Organization</button>
                </div>
            </div>

            <div id="international-organizations">
                <label class="block text-sm font-medium text-gray-600">International Organizations:</label>
                <div class="organization-list mb-3">
                    <div class="mb-2">
                        <input type="text" name="international_organizations[]" class="form-input w-full border rounded-md shadow-sm" placeholder="Organization Name" required>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="add-international-organization" class="btn bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm">Add International Organization</button>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 text-center">
            <button type="submit" class="btn bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm">
                Submit
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
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

    {{-- organization form --}}
</x-app-layout>
