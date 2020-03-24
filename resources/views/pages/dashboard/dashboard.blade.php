@extends('app')
@section('title', "CloudHub | Dashboard")
@section('body')
    <div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 70vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold text-center">Welcome {{ Auth::user()->name }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
