@extends('layouts.app')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@section('content')
<div class="col-12">
    <form action="{{ route('admin.'.$entity.'.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="col text-right mb-2">
                <a href="{{ route('admin.'.$entity.'.create') }}" class="btn btn-round btn-primary btn-sm text-right"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <x-card-header-list :records='$records' />
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Heading</th>
                                {{-- <th>Content</th> --}}
                                <th>Menu Visible</th>
                                <th>Weight</th>
                                <th>Modified</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                {{-- <th style="width: 100px;">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $record)
                                <tr>
                                    <td>{{ ($key+1) }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->slug }}</td>
                                    <td>{{ $record->heading }}</td>
                                    {{-- <td data-toggle="modal" data-target="#page-modal-{{$record->id}}">{!! Str::limit($record->content, 50, $end='...') !!}</td> --}}
                                    <td>{!! $record->menu_visible ? '<span class="btn btn-success btn-sm">Yes</span>' : '<span class="btn btn-danger btn-sm">No</span>' !!}</td>
                                    <td>{{ $record->weight }}</td>
                                    <td>{{ $record->updated_at }}</td>
                                    <td><a href="javascript:void(0)" data-toggle="modal" data-target="#page-modal-{{$record->id}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                                    <td><a href="{{route('admin.pages.edit',$record->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="{{route('admin.pages.delete',$record->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        <div class="modal fade" id="page-modal-{{$record->id}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ $record->heading }} Page</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">{!! $record->content !!}</div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
