<?php

namespace App\Http\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService {

    protected $model;
    public function __construct()
    {
        $this->model = new Setting();
    }

    public function list($relations = array(), $params = array())
    {
        extract($params);
        $pagination = session()->get('pagination') ?? 10;
        $query = $this->model;

        return $query->with($relations)->paginate($pagination);
    }

    public function fetchAllKeys()
    {
        return $this->model->get();
    }

    public function fetch($id)
    {
        return $this->model->findOrFail($id);
    }

    public function fetchByKey($key)
    {
        return $this->model->where('key', $key)->first();
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->title = $title;
        $record->key = $key;
        $record->value = $value;
        $record->save();

        return $record;
    }

    public function edit($data, $id)
    {
        extract($data);
        $record = $this->fetch($id);
        $record->title = $title;
        $record->value = $value;
        $record->save();

        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        return $record->delete();
    }

    public function all()
    {
        return $this->model->get();
    }

    public function fetchByKeys(array $keys)
    {
        return $this->model->whereIn('key', $keys)->get();
    }

    public function bulkEdit($data)
    {
        extract($data);
        foreach ($settings as $key => $val) {
            extract($val);
            $record = $this->model->select('id', 'key', 'value')->where('id', $key)->first();
            $record->value = $value;
            $record->save();
            Cache::forever('settings-'.$config, $value);
        }
    }

    public function fetchValueByKey($key){
        return $this->model->where('key', $key)->first()->value;
    }

    public function fetchLogo(){
        $key = 'settings-web-logo';
        return Cache::remember($key, 10800, function () use($key){
            return $this->fetchValueByKey(str_replace('settings-', '', $key));
        });
    }
}
