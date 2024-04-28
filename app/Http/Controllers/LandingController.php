<?php

namespace App\Http\Controllers;

use App\Models\JobPost;

class LandingController extends Controller
{
    public function __invoke()
    {
        $count = JobPost::active()->count();
        return view('home', ["count" => $count]);
    }
}
