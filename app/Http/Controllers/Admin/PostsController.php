<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\{CategoryService, PostsService, RouterService, TagService};
use App\Http\Middleware\PaginationParse;
use App\Http\Requests\Posts;
use Illuminate\Support\Facades\{DB, Log};

class PostsController extends Controller
{
    protected $entity, $router, $service, $categoryService, $tagService, $routerService;

    public function __construct(){
        $this->entity = 'posts';
        $this->router = 'admin.posts.index';
        $this->service = new PostsService();
        $this->categoryService = new CategoryService();
        $this->tagService = new TagService();
        $this->routerService = new RouterService();
        $this->middleware(PaginationParse::class)->only('index');
    }

    public function index()
    {
        $entity = $this->entity;
        $records = $this->service->list(['category','postTags']);
        return view('admin.'.$this->entity.'.index', compact('entity', 'records'));
    }

    public function create()
    {
        $entity = $this->entity;
        $records = $this->service->list();
        $categoryLov = $this->categoryService->categoryLov();
        $tagLov = $this->tagService->tagsLov();
        return view('admin.'.$this->entity.'.create', compact('entity', 'records','categoryLov','tagLov'));
    }

    public function store(Posts $request)
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
        return $this->routerService->redirect($this->router, $error, $message);
    }

    public function edit($id)
    {
        $entity = $this->entity;
        $record = $this->service->fetch($id,['postTags']);
        $categoryLov = $this->categoryService->categoryLov();
        $tagLov = $this->tagService->tagsLov();
        return view('admin.'.$this->entity.'.edit', compact('entity', 'record','categoryLov','tagLov'));
    }

    public function update(Posts $request)
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
        return $this->routerService->redirect($this->router, $error, $message);
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
