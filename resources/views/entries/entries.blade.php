<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('List of submitted entries') }}
            </h2>

            {{-- settings button --}}

        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="entriesTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Sub title</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <!-- Initialize DataTable -->
        <script>
            $(document).ready(function() {
                $('#entriesTable').DataTable({
                    "searching": true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ url()->current() }}",
                    "ordering": true,
                    "info": true,
                    "paging": true,
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'title',
                            name: 'title',
                            orderable: false
                        }, // Disable ordering
                        {
                            data: 'subtitle',
                            name: 'subtitle',
                            orderable: false
                        }, // Disable ordering
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    "lengthChange": true, // Ensure the length menu is shown
                    "lengthMenu": [10, 20, 30, 40, 50, 60, 70], // Define options for number of entries to show
                    // Export buttons
                    dom: "Bflrtip",
                    // Style the buttons
                    buttons: [{
                            extend: "csv",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Entries List",
                        },
                        {
                            extend: "excel",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Entries List",
                        },
                        {
                            extend: "pdf",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Entries List",
                            customize: function(doc) {
                                doc.styles.tableHeader.fillColor = '#FFA500';
                            }
                        },
                        {
                            extend: "print",
                            className: "btn btn-warning btn-small text-white",
                            messageTop: "Entries List",
                        },
                    ],
                });
            });
        </script>
    @endpush

</x-app-layout>
