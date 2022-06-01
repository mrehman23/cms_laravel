@extends('layouts.master')
@section('content')
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
