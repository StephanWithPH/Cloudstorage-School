@extends('app')
@section('title', "CloudHub | Dashboard")
@section('body')
    <div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold text-center">{{ __('language.sharedwith') }} {{ Auth::user()->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @if(!Auth::user()->email_verified_at)
            <div class="alert alert-warning text-center" role="alert">
                {{ __('language.noemailverified') }} <a href="#" class="alert-link">{{ __('language.verificationresend') }}</a>
            </div>
        @endif
        @include('flash::message')
        <br/>

        <div class="row">
            @php
            $nofiles = true
            @endphp
            @forelse($sharedfiles as $file)
                @if($file->pivot->deleted == false)
                    @php
                    $nofiles = false
                    @endphp
                    <div class="col-md-6 col-lg-4  col-12 mt-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('img/noimage.svg') }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $file->name }}</h5>
    {{--                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-1"><a class="btn btn-primary w-100 text-white" href="{{ action('FileController@getShared', $file->id) }}">Download</a></li>
                                <li class="list-group-item p-1"><a class="btn btn-danger w-100 text-white" href="{{ action('FileController@removeShared', $file->id) }}">Delete share</a ></li>
                            </ul>
                        </div>
                    </div>
                @endif
            @empty
                @php
                $nofiles = true
                @endphp
            @endforelse
            @if($nofiles)
                <div class="col mt-3">
                    <div class="alert alert-info text-center" role="alert">
                        No one has shared files with you yet!
                    </div>
                </div>
            @endif
        </div>


    </div>
@endsection
