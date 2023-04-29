<?php

namespace App\Http\Services;

use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostsService {

    protected $model;
    public function __construct()
    {
        $this->model = new Posts();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $query = $this->model;
        return $query->with($relations)->orderBy('category_id')->orderBy('weight')->paginate($pagination);
    }

    public function fetch($id,$relations = [])
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function fetchBySlug($slug)
    {
        return $this->model->where('slug', $slug)->where('lan',getSelectedLang())->first();
    }

    public function create($data)
    {
        extract($data);
        $imagePath = (!empty($feature_image) ? $this->uploadImages($feature_image) : '');
        $record = $this->model;
        $record->name = $name;
        // $record->slug = $slug;
        $record->slug = Str::slug($name);
        $record->category_id = $category_id;
        $record->lan = $lan;
        $record->short_description = $short_description;
        $record->description = $content;
        $record->image = $imagePath;
        $record->weight = $weight;
        $record->created_by = (!empty(Auth::user()->id) ? Auth::user()->id : 9999);
        $record->created_at=Carbon::now();
        $record->status=$status??1;
        $record->save();
        if(!empty($tags[0])) {
            $record->postTags()->sync($tags);
        } else {
            $record->postTags()->sync([]);
        }
        return $record;
    }

    public function update($data)
    {
        extract($data);
        $record = $this->model->find($id);
        $imagePath = (!empty($feature_image) ? $this->uploadImages($feature_image) : '');
        $record->name = $name;
        // $record->slug = $slug;
        $record->slug = Str::slug($name);
        $record->category_id = $category_id;
        $record->lan = $lan;
        $record->short_description = $short_description;
        $record->description = $content;
        if(!empty($imagePath)) {
            $record->image = $imagePath;
        }
        $record->weight = $weight;
        $record->updated_by = (!empty(Auth::user()->id) ? Auth::user()->id : 9999);
        $record->updated_at=Carbon::now();
        $record->status=$status??1;
        $record->save();
        if(!empty($tags[0])) {
            $record->postTags()->sync($tags);
        } else {
            $record->postTags()->sync([]);
        }
        return $record;
    }


    public function uploadImages($feature_image)
    {
        return Storage::disk('public')->put('posts', $feature_image);
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        $res = $record->delete();
        return $res;
    }
}
