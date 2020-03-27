@extends('app')
@section('title', "CloudHub | Home")
@section('body')
<div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 70vh">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 text-center text-lg-left">
                <h1 class="display-4 text-white font-weight-bold">{{ __('language.displaytitle') }}</h1>
            </div>
            <div class="col-lg-6 col-12 text-center text-lg-left">
                <div class="card" style="width: 100%;">
                    <div class="card-body m-3 text-center">
                        <h3 class="card-title text-center text-primary font-weight-bold">{{ __('language.signupnow') }}</h3>
                        <p class="card-text">{{ __('language.signupnow-description') }}</p>
                        <p class="text-muted font-weight-light">{{ __('language.signupnow-orloginwith') }}</p>
                        <div class="text-center">
                            <a class="btn btn-primary btn-lg text-white" href="{{ route('login') }}"><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container w-100">
    <hr class="featurette-divider">
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"></rect><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
        </div>
    </div>
</div>
@endsection
