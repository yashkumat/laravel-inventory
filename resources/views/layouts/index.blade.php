<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Store Name') }}</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <section class="home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center align-items-center mt-5 p-3" >
                        <div class="card">
                            <div class="card-header">
                                <h1>{{ config('app.name', 'Store Name') }}</h1>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ env('AUTHOR_NAME', 'Author Name') }}</h5>
                                <p class="card-text">Address Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, asperiores similique? Voluptas impedit eos nam soluta, dolorum sequi assumenda sint.</p>
                                <a href="tel:+91{{env('PHONE_NUMBER', 'Author Name')}}" class="btn btn-outline-primary mx-2">Call <i class="fa-solid fa-phone mx-1"></i></a>
                                <a href="https://wa.me/+91{{env('PHONE_NUMBER', 'Author Name')}}" class="btn btn-outline-primary mx-2">Whatsapp <i class="fa-brands fa-whatsapp mx-1"></i></a>
                                <a href="https://goo.gl/maps/7oiSE67Zhg2m6azj9" class="btn btn-outline-primary mx-2">Google Maps <i class="fa-solid fa-location mx-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-end">
                        <a href="/login">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>