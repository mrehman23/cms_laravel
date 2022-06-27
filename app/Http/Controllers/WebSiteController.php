<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PagesService;
use Illuminate\Support\Facades\Route;

class WebSiteController extends Controller
{
    protected $entity, $router, $service, $routerService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new PagesService();
        // $this->middleware('auth');
    }

    public function __invoke()
    {
        $slug=request()->segment(1);
        $record = $this->service->fetchBySlug($slug);
        return view('page', compact('slug','record'));
    }


    public function index()
    {
        return view('home');
    }

    // public function about()
    // {
    //     dd(Route::getCurrentRoute()->getActionName());
    //     $record = $this->service->fetchBySlug(Route::getCurrentRoute()->getActionName());
    //     dd($record);
    //     return view('pages.about');
    // }

    // public function services()
    // {
    //     return view('pages.services');
    // }

    // public function contact()
    // {
    //     return view('pages.contact');
    // }
}
