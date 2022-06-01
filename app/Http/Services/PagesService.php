<?php

namespace App\Http\Services;

use App\Models\Pages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PagesService {

    protected $model;
    public function __construct()
    {
        $this->model = new Pages();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $query = $this->model;

        return $query->with($relations)->orderBy('weight')->paginate($pagination);
    }

    public function fetch($id)
    {
        return $this->model->findOrFail($id);
    }

    public function fetchBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function fetchPagesForMenu()
    {
        return $this->model->select('id','name','slug','lan','heading','weight')->where(['status'=>1,'menu_visible'=>1])->orderBy('weight')->get();
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->name = $name;
        $record->slug = Str::slug($name);
        $record->heading = $heading;
        $record->lan = $lan;
        $record->content = $content;
        $record->menu_visible = isset($menu_visible) ? 1 : 0;
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
        $record->heading = $heading;
        $record->lan = $lan;
        $record->content = $content;
        $record->menu_visible = isset($menu_visible) ? 1 : 0;
        $record->weight = $weight;
        $record->save();

        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        return $record->delete();
    }

    // public function bulkEdit($data)
    // {
    //     extract($data);
    //     foreach ($settings as $key => $val) {
    //         extract($val);
    //         $record = $this->model->select('id', 'key', 'value')->where('id', $key)->first();
    //         $record->value = $value;
    //         $record->save();
    //         Cache::forever('settings-'.$config, $value);
    //     }
    // }
}
