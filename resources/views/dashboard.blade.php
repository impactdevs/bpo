<x-app-layout>
    <div class="py-6">
        <div id="spinner" class="flex justify-center items-center h-48">
            <!-- You can use any spinner animation you prefer -->
            <div class="animate-spin rounded-full h-24 w-24 border-t-4 border-blue-500"></div>
        </div>

        {{--  --}}
        <div class="content-wrapper" style="display: none;">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $entries }}</h1>
                                <p class="mb-0">Entries</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="card h-100 text-center bg-light shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h1 class="h1">{{ $registered }}</h1>
                                <p class="mb-0">Registered Entities</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                // stop the spinner and shw the content
                $('#spinner').hide();
                $('.content-wrapper').show();
            });
        </script>
    @endpush
    </div>
</x-app-layout>
