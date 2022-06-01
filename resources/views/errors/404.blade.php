@extends('errors.master')

@section('title', 'Not Found')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9 mt-5">
            <div class="card o-hidden border-0 my-5">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center p-5" style="min-height: 100%">
                            <img src="{{asset('kd/logo.png')}}"  height="75" alt="{{ config()->get('app.name') }}" />
                            <hr>
                            <h1 class="h4 text-gray-900 mb-4">Not Found</h1>
                        </div>
                    </div>
                </div>
                <div class="card-footer px-5">
                    <a href="{{ url()->previous() }}" class="btn btn-block btn-primary">GO BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
