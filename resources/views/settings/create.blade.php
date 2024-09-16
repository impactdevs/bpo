<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Settings') }}
            </h2>
            <a class="btn btn-primary" href="{{ route('settings.create') }}"><i class="bi bi-upload"></i> Add</a>
        </div>
    </x-slot>

    <div class="content-wrapper m-5">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Add an Option</div>
                    <div class="card-body">
                        <a href="{{ url('settings') }}" title="Back"><button class="button2"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        <form method="POST" action="{{ route('settings.store') }}" accept-charset="UTF-8" class="form-horizontal"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('settings.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
