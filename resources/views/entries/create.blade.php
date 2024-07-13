<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $form->name }}</title>
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
                                    will have submitted. this form will require your 25-30 minutes</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $form->name }}</h5>
                        <form method="POST" action="{{ route('entries.store') }}" accept-charset="UTF-8"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('entries.form', ['formMode' => 'create'])


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
