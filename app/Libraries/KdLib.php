<?php
namespace App\Libraries;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Kd\Kdladmin\Models\Assignment;
use Illuminate\Support\Str;

class KdLib {

    public static function getMenu($user_id) {
        $assignment=new Assignment();
        $uroutelist=$assignment->getUserRoutes($user_id);
        $menu = [];
        $parent_navigation=\App\Models\AdminMenu::where(['status'=>1,'is_visible'=>'Y','parent_id'=>'0'])->orderBy('sort_by')->get();
        foreach($parent_navigation as $pnavigation) {
            $menu_list=\App\Models\AdminMenu::where(['status'=>1,'is_visible'=>'Y','parent_id'=>$pnavigation->id])->orderBy('sort_by')->get();
            foreach ($menu_list as $value) {
                if(\array_key_exists($value->route_name,$uroutelist)) {
                    $menu[$value->parent_id][$value->id] = $value;
                }
            }

        }
        $parent_menu=[];
        foreach($menu as $key=>$value) {
            $data=\App\Models\AdminMenu::where(['id'=>$key,'is_visible'=>'Y'])->orderBy('sort_by')->first();
            if(!empty($data)) {
                $parent_menu[$key]=$data;
            }
        }
        $menu[0]=$parent_menu;
        $kdLib = new kdLib;
        return $kdLib->create_menu(0,$menu);
    }

    public function create_menu($parent_id,$portal_manu) {
        if(isset($portal_manu[$parent_id])){
            foreach($portal_manu[$parent_id] as $value){
                if(isset($portal_manu[$value->id])){
                    echo '
                        <li class="nav-item '.((Request::segment(2) == $value->url) ? '  active' : '').'">
                            <a class="nav-link menu-link collapsed" href="#sidebar'.Str::slug($value->name).'" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar'.Str::slug($value->name).'">
                                <i class="ri-dashboard-2-line '.$value->icon.'"></i> <span data-key="t-'.Str::slug($value->name).'">'.$value->name.'</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebar'.Str::slug($value->name).'">
                                <ul class="nav nav-sm flex-column">
                    ';
                }
                if(!isset($portal_manu[$value->id])){
                    echo '
                        <li class="nav-item">
                            <a href="'.(($value->route_name != '#')?(Route::has($value->route_name) ? route($value->route_name) : 'NoRoute'):'#').'" class="nav-link" data-key="t-'.Str::slug($value->name).'"> '.$value->name.' </a>
                        </li>';
                }
                $this->create_menu($value->id,$portal_manu);
                if(isset($portal_manu[$value->id])){
                    echo '
                        </ul></div>
                    </li>';
                }
            }
        }
    }
}
