@extends('app')
@section('title', "CloudHub | Home")
@section('body')
<div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 70vh">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="display-4 text-white font-weight-bold">Welcome to the future Cloudhub!</h1>
            </div>
            <div class="col-6">
                <div class="card" style="width: 100%;">
                    <div class="card-body m-3 text-center">
                        <h3 class="card-title text-center text-primary font-weight-bold">Sign up now!</h3>
                        <p class="card-text">Sign up using the sign up button at the top.</p>
                        <p class="text-muted font-weight-light">or login with</p>
                        <div class="text-center">
                            <a class="btn btn-primary btn-lg text-white"><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
