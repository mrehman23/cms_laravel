@extends('layouts.app')

@section('title', Str::title($entity))

@section('page-heading', Str::title($entity))

@section('content')
<div class="col-12">
    <div class="card shadow mb-4">
        <form action="{{ route('admin.'.$entity.'.update') }}" method="POST">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @csrf
                    <input type="hidden" name="id" value="{{$record->id}}" />
                    <div class="col-md-3 form-group required">
                        <label for="name">Page Name</label>
                        <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') ?? $record->name }}" required />
                        @include('admin.components.form-error', ['key' => 'name'])
                    </div>

                    <div class="col-md-3 form-group required">
                        <label for="heading">Page Heading</label>
                        <input type="text" name="heading" class="form-control form-control-sm @error('heading') is-invalid @enderror" value="{{ old('heading') ?? $record->heading }}" required />
                        @include('admin.components.form-error', ['key' => 'heading'])
                    </div>

                    <div class="col-md-2 form-group required">
                        <label for="template">Page Template</label>
                        <select name="template" class="form-control form-control-sm @error('template') is-invalid @enderror" value="{{ old('template') }}">
                            <option value="">--Select--</option>
                            @foreach ($templates as $template)
                                <option value="{{$template}}" {{isSelected($template,$record->template)}}>{{$template}}</option>
                            @endforeach
                        </select>
                        @include('admin.components.form-error', ['key' => 'template'])
                    </div>

                    <div class="col-md-2 form-group required">
                        <label for="lan">Lanuage</label>
                        <select name="lan" class="form-control form-control-sm @error('lan') is-invalid @enderror" value="{{ old('lan') }}" required >
                            <option value="en">Englist</option>
                            <option value="ar">Arabic</option>
                        </select>
                        @include('admin.components.form-error', ['key' => 'lan'])
                    </div>

                    <div class="col-md-1 form-group required">
                        <label for="weight">Weight</label>
                        <input type="number" name="weight" class="form-control form-control-sm @error('weight') is-invalid @enderror" value="{{ old('weight') ?? $record->weight }}" required />
                        @include('admin.components.form-error', ['key' => 'weight'])
                    </div>

                    <div class="col-md-1 form-group required">
                        <label for="menu_visible">Menu Visible</label>
                        <input type="checkbox" name="menu_visible" class="form-control form-control-sm @error('menu_visible') is-invalid @enderror" value="1" {{ old('menu_visible') ?? ($record->menu_visible ? "checked" : '') }} />
                        @include('admin.components.form-error', ['key' => 'menu_visible'])
                    </div>

                    <div class="col-md-12 form-group required">
                        <label for="content">Content</label>
                        <textarea type="text" name="content" class="form-control form-control-sm @error('content') is-invalid @enderror" required >{{ old('content') ?? $record->content }}</textarea>
                        @include('admin.components.form-error', ['key' => 'content'])
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
<script src="{{asset('kdassets/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'content');
</script>
@endsection
