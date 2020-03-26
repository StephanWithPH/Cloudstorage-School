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
                            <li class="list-group-item p-1"><a class="btn btn-info w-100 text-white">Share</a></li>
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

        {{--$('.fileupload').on('submit', function(event){--}}
        {{--    event.preventDefault();--}}

        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    console.log('uploading');--}}

        {{--    var formData = new FormData($(".fileupload")[0]);--}}
        {{--    console.log(formData)--}}
        {{--    /* Submit form data using ajax*/--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ action('FileController@store') }}",--}}
        {{--        method: 'post',--}}
        {{--        data: formData,--}}
        {{--        processData : false,--}}
        {{--        dataType: 'JSON',--}}
        {{--        contentType: false,--}}
        {{--        cache: false,--}}
        {{--        success: function(response){--}}
        {{--            //--------------------------}}
        {{--            console.log('uploaded');--}}

        {{--            $('.fileupload').trigger('reset');--}}
        {{--            // setTimeout(function(){--}}
        {{--            //     $('#res_message').hide();--}}
        {{--            //     $('#msg_div').hide();--}}
        {{--            // },10000);--}}
        {{--            //----------------------------}}
        {{--        }});--}}

        {{--});--}}

        // AJAX Calls

    </script>
@endsection
