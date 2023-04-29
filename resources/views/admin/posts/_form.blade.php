<?php
$ftype=(!empty($ftype) ? $ftype : '');
$id=(!empty($record->id) ? $record->id : 0);
$name=(!empty($record->name) ? $record->name : '');
$category_id=(!empty($record->category_id) ? $record->category_id : 0);
$lan=(!empty($record->lan) ? $record->lan : '');
$weight=(!empty($record->weight) ? $record->weight : 1);
$feature_image=(!empty($record->feature_image) ? $record->feature_image : '');
$postTags=(!empty($record->postTags) ? $record->postTags : []);
$short_description=(!empty($record->short_description) ? $record->short_description : '');
$content=(!empty($record->description) ? $record->description : '');
$status=(!empty($record->status) ? $record->status : 1);
?>
<div class="card-body">
    <div class="row">
        @csrf
        <input type="hidden" name="id" value="{{$id}}" />
        <div class="col-md-3 form-group required">
            <label for="name">Title</label>
            <input type="text" name="name" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{(!empty($name) ? $name : old('name'))}}" required />
            @include('admin.components.form-error', ['key' => 'name'])
        </div>

        <div class="col-md-2 form-group required">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control form-control-sm @error('category_id') is-invalid @enderror">
                <option value="">--Select--</option>
                @foreach ($categoryLov as $key => $category)
                    <option value="{{$key}}" {{isSelected($key,$category_id)}}>{{$category}}</option>
                @endforeach
            </select>
            @include('admin.components.form-error', ['key' => 'template'])
        </div>

        <div class="col-md-1 form-group required">
            <label for="lan">Lanuage</label>
            <select name="lan" class="form-control form-control-sm @error('lan') is-invalid @enderror" value="{{ old('lan') }}" required >
                @foreach (['en'=>'English','ar'=>'Arabic'] as $key => $language)
                    <option value="{{$key}}" {{isSelected($key,$lan)}}>{{$language}}</option>
                @endforeach
            </select>
            @include('admin.components.form-error', ['key' => 'lan'])
        </div>

        <div class="col-md-1 form-group required">
            <label for="weight">Weight</label>
            <input type="number" name="weight" class="form-control form-control-sm @error('weight') is-invalid @enderror" value="{{(!empty($weight) ? $weight : old('weight'))}}" required />
            @include('admin.components.form-error', ['key' => 'weight'])
        </div>

        <div class="col-md-2 form-group required">
            <label for="feature_image">Feature Image</label>
            <input type="file" name="feature_image" class="form-control form-control-sm @error('feature_image') is-invalid @enderror" value="{{ old('feature_image') }}" />
            @include('admin.components.form-error', ['key' => 'feature_image'])
        </div>

        <div class="col-md-2 form-group required">
            <label for="tags">Tag</label>
            <select name="tags[]" class="form-control form-control-sm @error('tags') is-invalid @enderror" >
                <option value="">Select</option>
                @foreach ($tagLov as $key => $tag)
                    @php
                        $selectedKey = 0;
                        foreach ($postTags as $postTag) {
                            if($postTag->pivot->tags_id==$key) {
                                $selectedKey = $postTag->pivot->tags_id;
                            }
                        }
                    @endphp
                    <option value="{{$key}}" {{isSelected($key,$selectedKey)}}>{{$tag}}</option>
                @endforeach
            </select>
            @include('admin.components.form-error', ['key' => 'tags'])
        </div>

        <div class="col-md-12 form-group required">
            <label for="short_description">Short Description</label>
            <input type="text" name="short_description" class="form-control form-control-sm @error('short_description') is-invalid @enderror" value="{{(!empty($short_description) ? $short_description : old('short_description'))}}" />
            @include('admin.components.form-error', ['key' => 'short_description'])
        </div>

        <div class="col-md-12 form-group required">
            <label for="content">description</label>
            <textarea type="text" name="content" class="form-control form-control-sm @error('content') is-invalid @enderror" required >{{(!empty($content) ? $content : old('content'))}}</textarea>
            @include('admin.components.form-error', ['key' => 'content'])
        </div>
    </div>
</div>
<div class="card-footer">
    <x-save-button />
</div>
