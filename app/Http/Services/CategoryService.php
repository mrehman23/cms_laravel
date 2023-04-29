<?php

namespace App\Http\Services;

use App\Models\Categories;
use Illuminate\Support\Str;

class CategoryService {

    protected $model;
    public function __construct()
    {
        $this->model = new Categories();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $query = $this->model;
        return $query->with($relations)->orderBy('weight')->paginate($pagination);
    }

    public function categoryLov() {
        return $this->model->orderBy('weight')->pluck('name','id');
    }

    public function fetch($id)
    {
        return $this->model->findOrFail($id);
    }

    public function fetchBySlug($slug, $relations = array())
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
        $record->weight = $weight;
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
        $record->weight = $weight;
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
