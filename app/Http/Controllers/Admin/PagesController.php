<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\{PagesService, RouterService};
use App\Http\Requests\Pages;
use App\Http\Middleware\PaginationParse;
use Illuminate\Support\Facades\{DB, Log, Request};

class PagesController extends Controller
{
    protected $entity, $router, $service, $routerService;

    public function __construct(){
        $this->entity = 'pages';
        $this->router = 'admin.pages.index';
        $this->service = new PagesService();
        $this->routerService = new RouterService();
        $this->middleware(PaginationParse::class)->only('index');
    }

    public function index()
    {
        $entity = $this->entity;
        $records = $this->service->list();
        return view('admin.'.$this->entity.'.index', compact('entity', 'records'));
    }

    public function create()
    {
        $entity = $this->entity;
        $records = $this->service->list();
        return view('admin.'.$this->entity.'.create', compact('entity', 'records'));
    }

    public function store(Pages $request)
    {
        $data = $request->validated();
        $message = 'Record successfully created.';
        $error = false;

        try {
            DB::beginTransaction();
            $record = $this->service->create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }

        return $this->routerService->redirectBack($error, $message);
    }

    public function edit($id)
    {
        $entity = $this->entity;
        $record = $this->service->fetch($id);
        return view('admin.'.$this->entity.'.edit', compact('entity', 'record'));
    }

    public function update(Pages $request)
    {
        $data = $request->validated();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            DB::beginTransaction();
            $record = $this->service->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }

        return $this->routerService->redirectBack($error, $message);
    }

    public function delete($id)
    {
        $message = 'Record successfully Deleted.';
        $error = false;

        try {
            DB::beginTransaction();
            $record = $this->service->delete($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }

        return $this->routerService->redirectBack($error, $message);
    }
}
