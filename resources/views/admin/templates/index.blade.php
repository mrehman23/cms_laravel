@extends('layouts.app')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@section('content')
<!--{{!empty($app_name) ? $app_name->value : 'NO'}}-->
<div class="col-12">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $key => $template)
                            <tr>
                                <td>{{ ($key+1) }}</td>
                                <td>{{ $template }}</td>
                                <td width="20%"><a href="{{ route('admin.'.$entity.'.edit',$template) }}">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <x-save-button />
        </div>
    </div>
</div>
@endsection
