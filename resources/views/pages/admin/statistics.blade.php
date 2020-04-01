@extends('app')
@section('title', "CloudHub | Admin Statistics")
@section('body')
    <div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold text-center">{{ __('language.adminstatistics') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 col-12 mt-3">
                <div class="card w-100">
                    {{--                    <img class="card-img-top" src="{{ asset('img/noimage.svg') }}" alt="Card image cap">--}}
                    <div class="card-img-top" style="height:300px">
                        {!! $averageUsersRegistered->container() !!}
                    </div>
                    {!! $averageUsersRegistered->script() !!}
                    <div class="card-body">
                        <p class="card-text">{{ __('language.usersregistered') }} {{ date("Y") }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mt-3">
                <div class="card w-100">
                    {{--                    <img class="card-img-top" src="{{ asset('img/noimage.svg') }}" alt="Card image cap">--}}
                    <div class="card-img-top" style="height:300px">
                        {!! $filesAdded->container() !!}
                    </div>
                    {!! $filesAdded->script() !!}
                    <div class="card-body">
                        <p class="card-text">{{ __('language.filesuploadedpermonth') }} {{ date("Y") }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mt-3">
                <div class="card w-100">
                    <div class="card-img-top vertical-center" style="height: 300px">
                        <h2 class="display-4 text-white font-weight-bold text-center text-primary w-100">{{ App\User::count() }} {{ __('language.userssinglemultiple') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mt-3">
                <div class="card w-100">
                    <div class="card-img-top vertical-center" style="height: 300px">
                        <h2 class="display-4 text-white font-weight-bold text-center text-primary w-100">{{ App\File::where('deleted', false)->count() }} {{ __('language.filessinglemultiple') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mt-3">
                <div class="card w-100">
                    <div class="card-img-top vertical-center" style="height: 300px">
                        <h2 class="display-4 text-white font-weight-bold text-center text-primary w-100">{{ App\User::where('is_admin', true)->count() }} {{ __('language.adminuserssinglemultiple') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
