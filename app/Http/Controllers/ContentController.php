<?php

namespace App\Http\Controllers;

use App\Services\BrowserService;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct(
        private BrowserService $browserService
    )
    {    }

    public function index(Request $request)
    {
        $request->validate([
            'url' => ['required', 'url'],
        ]);
        $v = $this->browserService->read($request->get('url'));
        echo $v;
    }
}
