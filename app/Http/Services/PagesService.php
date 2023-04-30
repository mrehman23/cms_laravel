<?php

namespace App\Http\Services;

use App\Models\Pages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
        $categoriesService = new CategoryService();
        $categorySlug = $this->pageCategoryMapping($slug);
        $records = new \stdClass();
        if(!empty($categorySlug)) {
            if(is_array($categorySlug)) {
                foreach($categorySlug as $cslug) {
                    $records->$cslug = $categoriesService->fetchBySlug($cslug,['posts','posts.postTags']);
                }

            } else {
                $records->$categorySlug = $categoriesService->fetchBySlug($categorySlug,['posts','posts.postTags']);
            }
        }
        $pageData = $this->model->where('slug', $slug)->where('lan',getSelectedLang())->first();
        if(!empty($pageData)) {
            $pageData->categories = $records;
        }
        return $pageData;
    }

    public function pageCategoryMapping($slug) {
        $arr = ['news-events'=>['news','events'],'brands'=>'brands'];
        return (!empty($arr[$slug]) ? $arr[$slug] : null);
    }

    public function fetchPagesForMenu()
    {
        return $this->model->select('id','name','slug','lan','heading','weight')->where(['status'=>1,'menu_visible'=>1,'lan'=>getSelectedLang()])->orderBy('weight')->get();
    }

    public function create($data)
    {
        extract($data);
        $record = $this->model;
        $record->name = $name;
        $record->slug = $slug;
        $record->heading = $heading;
        $record->template = $template;
        $record->lan = $lan;
        $record->content = $content;
        $record->menu_visible = isset($menu_visible) ? 1 : 0;
        $record->weight = $weight;
        $record->save();
        $this->resetPagesMenuCache();
        return $record;
    }

    public function update($data)
    {
        extract($data);
        $record = $this->model->find($id);
        $record->name = $name;
        $record->slug = $slug;
        $record->heading = $heading;
        $record->template = $template;
        $record->lan = $lan;
        $record->content = $content;
        $record->menu_visible = isset($menu_visible) ? 1 : 0;
        $record->weight = $weight;
        $record->save();
        $this->resetPagesMenuCache();
        return $record;
    }

    public function delete($id)
    {
        $record = $this->fetch($id);
        $res = $record->delete();
        $this->resetPagesMenuCache();
        return $res;
    }

    private function resetPagesMenuCache() {
        Cache::forever('pages-menu-list-'.getSelectedLang(), $this->fetchPagesForMenu());
    }

    public function getTemplateList() {
        $template = [];
        $files = Storage::disk('templates')->files('',true);
        foreach($files as $file) {
            $template[]=str_replace("/",".",str_replace(".blade.php","",$file));
        }
        return $template;
    }
}
