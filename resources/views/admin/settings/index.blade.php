@extends('layouts.app')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@section('content')
{{!empty($app_name) ? $app_name->value : 'NO'}}
<div class="col-12">
    <form action="{{ route('admin.'.$entity.'.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <x-card-header-list :records='$records' />
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $record)
                                <tr>
                                    <input type="hidden" name="settings[{{$record->id}}]" />
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->key }}</td>
                                    <td width="20%"><input type="text" name="settings[{{$record->id}}][value]" value="{{ $record->value }}" class="form-control form-control-sm" required /></td>
                                    <input type="hidden" name="settings[{{$record->id}}][config]" value="{{ $record->key }}" />
                                </tr>
                            @endforeach

                            <x-no-records :count="$records->count()" :colspan="$colspan ?? 10" />
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <x-paginator :records='$records' />
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-save-button />
            </div>
        </div>
    </form>
</div>
@endsection
