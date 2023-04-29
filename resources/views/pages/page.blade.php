@extends('layouts.master')

@section('title', Str::title(!empty($record->name) ? $record->name : "-"))

@section('content')
<section>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{url('/')}}" title="">{{__('content.home')}}</a></li>
            <li class="active">{!!(!empty($record->name) ? $record->name : '')!!}</li>
        </ol>
        <h1>{!!(!empty($record->name) ? $record->name : '')!!}</h1>
    </div>
</section>

{!! (!empty($record->content) ? '<section>'.$record->content.'</section>' : null) !!}

@if(!empty($record->template))
    @include('templates.'.$record->template)
@endif
@endsection
