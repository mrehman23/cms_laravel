<?php

use App\User;
use Kd\Kdladmin\Models\AuthItem;
use Kd\Kdladmin\Models\AuthItemChild;
use Kd\Kdladmin\Models\Assignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Auth Item Seeds
        $array = [];
        $kd_auth_items = [
            ['name' => 'adm_user_management', 'type' => 2, 'description' => NULL, 'user_dashboard' => NULL],
            ['name' => 'general_permissions', 'type' => 2, 'description' => 'contain all general permissions', 'user_dashboard' => NULL],
            ['name' => 'super_permission', 'type' => 2, 'description' => NULL, 'user_dashboard' => NULL],
            ['name' => 'admin_permissions', 'type' => 2, 'description' => 'Admin User permissions...', 'user_dashboard' => NULL],
            ['name' => 'setting_permissions', 'type' => 2, 'description' => NULL, 'user_dashboard' => NULL],
            ['name' => 'pages_permissions', 'type' => 2, 'description' => NULL, 'user_dashboard' => NULL],
            ['name' => 'templates_edit_permisisons', 'type' => 2, 'description' => NULL, 'user_dashboard' => NULL],
            ['name' => 'posts_permissions', 'type' => 2, 'description' => 'User can create / update posts', 'user_dashboard' => NULL],
        ];
        foreach ($kd_auth_items as $item) {
            $item = (Object) $item;
            if(!AuthItem::where('name', $item->name)->first()){
                $data = [
                    'name' => $item->name,
                    'type' => $item->type,
                    'description' => $item->description,
                    'user_dashboard' => $item->user_dashboard,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $array[] = $data;
            }
        }
        if(count($array)) {
            AuthItem::insert($array);
        }

        //Auth Item Child Seeds
        $array = [];
        $kd_auth_item_child = [
            ['parent' => 'adm_user_management',	'child' => 'kd.assignment.assign'],
            ['parent' => 'adm_user_management',	'child' => 'kd.assignment.index'],
            ['parent' => 'adm_user_management',	'child' => 'kd.assignment.revoke'],
            ['parent' => 'adm_user_management',	'child' => 'kd.assignment.view'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.assign'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.create'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.delete'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.edit'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.index'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.remove'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.store'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.update'],
            ['parent' => 'adm_user_management',	'child' => 'kd.permission.view'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.activate'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.create'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.delete'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.edit'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.index'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.store'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.update'],
            ['parent' => 'adm_user_management',	'child' => 'kd.user.view'],
            ['parent' => 'general_permissions',	'child' => 'admin.change.password.form'],
            ['parent' => 'general_permissions',	'child' => 'home'],
            ['parent' => 'general_permissions',	'child' => 'logout'],
            ['parent' => 'general_permissions',	'child' => 'admin.change.password'],
            ['parent' => 'super_permission',	'child' => 'admin.home'],
            ['parent' => 'super_permission',	'child' => 'adm_user_management'],
            ['parent' => 'super_permission',	'child' => 'general_permissions'],
            ['parent' => 'super_permission',	'child' => 'setting_permissions'],
            ['parent' => 'setting_permissions',	'child' => 'admin.settings.index'],
            ['parent' => 'setting_permissions',	'child' => 'admin.settings.store'],
            ['parent' => 'super_permission',	'child' => 'pages_permissions'],
            ['parent' => 'pages_permissions',	'child' => 'admin.pages.create'],
            ['parent' => 'pages_permissions',	'child' => 'admin.pages.edit'],
            ['parent' => 'pages_permissions',	'child' => 'admin.pages.index'],
            ['parent' => 'pages_permissions',	'child' => 'admin.pages.store'],
            ['parent' => 'pages_permissions',	'child' => 'admin.pages.update'],
            ['parent' => 'pages_permissions',	'child' => 'admin.pages.delete'],
            ['parent' => 'templates_edit_permisisons',	'child' => 'admin.templates.index'],
            ['parent' => 'super_permission',	'child' => 'templates_edit_permisisons'],
            ['parent' => 'templates_edit_permisisons',	'child' => 'admin.templates.edit'],
            ['parent' => 'templates_edit_permisisons',	'child' => 'admin.templates.update'],
            ['parent' => 'admin_permissions',	'child' => 'admin.pages.create'],
            ['parent' => 'admin_permissions',	'child' => 'admin.pages.delete'],
            ['parent' => 'admin_permissions',	'child' => 'admin.pages.edit'],
            ['parent' => 'admin_permissions',	'child' => 'admin.pages.index'],
            ['parent' => 'admin_permissions',	'child' => 'admin.pages.store'],
            ['parent' => 'admin_permissions',	'child' => 'admin.pages.update'],
            ['parent' => 'admin_permissions',	'child' => 'admin.settings.index'],
            ['parent' => 'admin_permissions',	'child' => 'admin.settings.store'],
            ['parent' => 'admin_permissions',	'child' => 'admin.templates.edit'],
            ['parent' => 'admin_permissions',	'child' => 'admin.templates.index'],
            ['parent' => 'admin_permissions',	'child' => 'admin.templates.update'],
            ['parent' => 'admin_permissions',	'child' => 'admin.home'],
            ['parent' => 'admin_permissions',	'child' => 'adm_user_management'],
            ['parent' => 'posts_permissions',	'child' => 'admin.posts.create'],
            ['parent' => 'posts_permissions',	'child' => 'admin.posts.delete'],
            ['parent' => 'posts_permissions',	'child' => 'admin.posts.edit'],
            ['parent' => 'posts_permissions',	'child' => 'admin.posts.index'],
            ['parent' => 'posts_permissions',	'child' => 'admin.posts.store'],
            ['parent' => 'posts_permissions',	'child' => 'admin.posts.update'],
            ['parent' => 'admin_permissions',	'child' => 'posts_permissions'],
            ['parent' => 'super_permission',	'child' => 'posts_permissions'],
        ];
        foreach ($kd_auth_item_child as $item) {
            $item = (Object) $item;
            if(!AuthItemChild::where(['parent' => $item->parent, 'child' => $item->child])->first()){
                $data = [
                    'parent' => $item->parent,
                    'child' => $item->child,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $array[] = $data;
            }
        }
        if(count($array)) {
            AuthItemChild::insert($array);
        }

        //User Seeds
        $array = [];
        $kd_users = [
            ['name' => 'Mati', 'email' => 'mati@gmail.com', 'password' => '123456'],
        ];
        foreach ($kd_users as $item) {
            $item = (Object) $item;
            if(!User::where('email',$item->email)->first()){
                $data = [
                    'name' => $item->name,
                    'email' => $item->email,
                    'password' => Hash::make($item->password),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $array[] = $data;
            }
        }
        if(count($array)) {
            User::insert($array);
        }

        //Auth Assignment Seeds
        $array = [];
        $kd_users = [
            ['item_name' => 'adm_user_management', 'user_id' => 1],
            ['item_name' => 'general_permissions', 'user_id' => 1],
            ['item_name' => 'super_permission', 'user_id' => 1],
        ];
        foreach ($kd_users as $item) {
            $item = (Object) $item;
            if(!Assignment::where(['item_name' => $item->item_name, 'user_id' => $item->user_id])->first()){
                $data = [
                    'item_name' => $item->item_name,
                    'user_id' => $item->user_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $array[] = $data;
            }
        }
        if(count($array)) {
            Assignment::insert($array);
        }


    }
}
