@extends('layouts.app')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@section('content')
<div class="col-12">
    <div class="card shadow mb-4">
        <form action="{{ route('admin.'.$entity.'.update',$id) }}" method="POST">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @csrf
                    <div class="col-md-12 form-group required">
                        <label for="content">Content</label>
                        <textarea type="text" name="content" class="form-control form-control-sm @error('content') is-invalid @enderror" required style="min-height:600px;" >{{ old('content') ?? $content }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-save-button />
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
