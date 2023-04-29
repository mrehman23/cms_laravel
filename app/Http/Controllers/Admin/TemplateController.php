<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\{TemplateService, RouterService};
use Illuminate\Http\Request;
use App\Http\Middleware\PaginationParse;

class TemplateController extends Controller
{
    protected $entity, $router, $service, $routerService;

    public function __construct(){
        $this->entity = 'templates';
        $this->router = 'admin.templates.index';
        $this->service = new TemplateService();
        $this->routerService = new RouterService();
        $this->middleware(PaginationParse::class)->only('index');
    }

    public function index()
    {
        $entity = $this->entity;
        $templates = $this->service->getTemplateList();
        return view($this->router, compact('entity', 'templates'));
    }

    public function edit($id)
    {
        $entity = $this->entity;
        $content = $this->service->fetch($id);
        return view('admin.'.$this->entity.'.edit', compact('entity', 'id', 'content'));
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            $record = $this->service->update($data,$id);
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
        }
        return $this->routerService->redirect($this->router,$error, $message);
    }
}
