@extends('layouts.app')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@section('content')
<div class="col-12">
    <div class="card shadow mb-4">
        <form id="result" method="post" action="{{ route('admin.'.$entity.'.update') }}"  enctype="multipart/form-data">
            @csrf
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update</h4>
            </div>
            @include('admin.posts._form',['ftype'=>'edit'])
        </form>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{asset('kdassets/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'content');
</script>
@endsection
