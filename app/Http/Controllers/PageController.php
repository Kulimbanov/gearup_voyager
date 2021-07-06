<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where(Page::SLUG, $request->slug)->first();

        return view('page.public')->with([
            'page' => $page,
        ]);
    }
}
