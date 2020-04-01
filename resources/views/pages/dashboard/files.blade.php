@extends('app')
@section('title', "CloudHub | Dashboard")
@section('body')
    <div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold text-center">{{ __('language.files') }}</h1>
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
            <div class="col">
                <form method="POST" action="{{action('FileController@store')}}" class="fileupload" enctype="multipart/form-data">
                    @csrf
                    <input name="fileuploaded" type="file" class="dropify" data-height="200" />
                </form>

            </div>
        </div>
        <div class="row">
            @forelse(Auth::user()->files->where('deleted', 0) as $file)
                <div class="col-md-6 col-lg-4  col-12 mt-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('img/noimage.svg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $file->name }}</h5>
{{--                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-1"><a class="btn btn-primary w-100 text-white" href="{{ action('FileController@get', $file->id) }}">Download</a></li>
                            <li class="list-group-item p-1">
                                @if(!Auth::user()->email_verified_at)
                                    <a class="btn btn-info w-100 text-white" href="{{ route('verification.notice') }}">Share</a>
                                @else
                                    <a class="btn btn-info w-100 text-white" data-toggle="collapse" href="#collapse{{$file->id}}" role="button" aria-expanded="false" aria-controls="collapse{{$file->id}}">Share</a>
                                @endif
                                <div class="collapse mt-2" id="collapse{{$file->id}}">
                                    @php
                                    $noshares = true;
                                    @endphp

                                    @forelse($file->shares as $fileshares)
                                        @if($fileshares->pivot->deleted == false)
                                            @php
                                            $noshares = false
                                            @endphp
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col text-center">{{$fileshares->email}}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger w-100 text-white" href="{{ action('FileController@removeSharedOwner', [$file->id, $fileshares->id]) }}">Delete fileshare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                        @php
                                            $noshares = true
                                        @endphp
                                    @endforelse
                                    @if($noshares)
                                        <p class="text-center mt-4">This file hasn't been shared yet!</p>
                                    @endif
                                    <form action="{{ action('FileController@addSharedOwner') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="fileId" value="{{ $file->id }}"/>
                                        <input type="email" name="userEmail" class="form-control w-100 mt-1 mb-1" placeholder="Fill in an email address"/>
                                        <button class="btn btn-success w-100 text-white" type="submit">Add share</button>
                                    </form>
                                </div>
                            </li>
                            <li class="list-group-item p-1"><a class="btn btn-danger w-100 text-white" href="{{ action('FileController@remove', $file->id) }}">Delete</a></li>
                        </ul>
                    </div>
                </div>
            @empty
                <div class="col mt-3">
                    <div class="alert alert-info text-center" role="alert">
                        {{ __('language.nofiles') }}
                    </div>
                </div>
            @endforelse
        </div>


    </div>

    <script type="text/javascript" src="{{ URL::asset('js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
        // select the file input (using a id would be faster)
        $('input[type=file]').change(function() {
            $('.fileupload').submit();
        });

    </script>
@endsection
