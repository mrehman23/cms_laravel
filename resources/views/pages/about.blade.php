@extends('layouts.master')
@section('content')
<section id="" class="breadcrumb-section ">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="{{url('/')}}">Home</a>
            </li>
            <li>
                <a href="#">{!!(!empty($record->name) ? $record->name : '')!!}</a>
            </li>
        </ul>
    </div>
</section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{!!(!empty($record->name) ? $record->name : '')!!}</div>

                <div class="card-body">
                    {!!(!empty($record->content) ? $record->content : '')!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
