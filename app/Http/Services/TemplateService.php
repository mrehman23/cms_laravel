<?php

namespace App\Http\Services;

use App\Models\Pages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class TemplateService {

    protected $model;
    public function __construct()
    {
        $this->model = new Pages();
    }

    public function fetch($file)
    {
        return Storage::disk('templates')->get($file.'.blade.php');
    }

    public function update($data,$file)
    {
        extract($data);
        $data =  Storage::disk('templates')->put($file.'.blade.php',$content);
        $this->resetPageContentCache($file,$content);
        return $data;
    }

    private function resetPageContentCache($file,$cdata) {
        Cache::forever($file.'-page', $cdata);
    }

    public function getTemplateList() {
        $template = [];
        $files = Storage::disk('templates')->files('',true);
        foreach($files as $file) {
            if(strpos($file,'_bck') !== false) {
                continue;
            }
            $template[]=str_replace("/",".",str_replace(".blade.php","",$file));
        }
        return $template;
    }
}
