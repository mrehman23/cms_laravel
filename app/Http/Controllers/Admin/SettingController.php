<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\{SettingService, RouterService};
use Illuminate\Http\Request;
use App\Http\Middleware\PaginationParse;

class SettingController extends Controller
{
    protected $entity, $router, $service, $routerService;

    public function __construct(){
        $this->entity = 'settings';
        $this->router = 'admin.settings.index';
        $this->service = new SettingService();
        $this->routerService = new RouterService();
        $this->middleware(PaginationParse::class)->only('index');
    }

    public function index()
    {
        $entity = $this->entity;
        $records = $this->service->list();
        return view($this->router, compact('entity', 'records'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $message = 'Record successfully updated.';
        $error = false;

        try {
            $this->service->bulkEdit($data);
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }

        return $this->routerService->redirect($this->router, $error, $message);
    }
}
