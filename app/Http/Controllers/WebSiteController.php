<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\{RouterService,PagesService};
use App\Mail\ContactForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        $this->routerService = new RouterService();
    }

    public function __invoke()
    {
        $slug=request()->segment(2);
        $record = $this->service->fetchBySlug($slug);
        return view('pages.page', compact('slug','record'));
    }


    public function index()
    {
        $record = $this->service->fetchBySlug('news-events');
        return view('pages.home_'.getSelectedLang(),compact('record'));
    }

    public function contact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|string|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|max:255',
        ]);
        $message = 'Email has been send. You\'ll receive response soon.';
        $error = false;
        try {
            Mail::to(config('app.mail_to'))->send(new ContactForm($data));
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }
        return $this->routerService->redirectBack($error, $message);
    }
}
