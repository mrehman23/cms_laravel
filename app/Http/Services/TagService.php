<?php

namespace App\Http\Services;

use App\Models\Tags;
use Illuminate\Support\Str;

class TagService {

    protected $model;
    public function __construct()
    {
        $this->model = new Tags();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $query = $this->model;
        return $query->with($relations)->orderBy('weight')->paginate($pagination);
    }

    public function tagsLov() {
        return $this->model->pluck('name','id');
    }

    public function fetch($id)
    {
        return $this->model->findOrFail($id);
    }

    public function fetchBySlug($slug)
    {
        return $this->model->where('slug', $slug)->where('lan',getSelectedLang())->first();
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->name = $name;
        $record->slug = Str::slug($name);
        $record->lan = $lan;
        $record->save();
        return $record;
    }

    public function update($data)
    {
        extract($data);
        $record = $this->model->find($id);
        $record->name = $name;
        $record->slug = Str::slug($name);
        $record->lan = $lan;
        $record->save();
        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        $res = $record->delete();
        return $res;
    }
}
