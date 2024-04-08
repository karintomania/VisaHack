<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class SearchController extends Controller
{

    public function __construct(
        private JobPost $jobPost,
    ){}

    function __invoke(): View|Factory
    {
        $country = 'GB';

        /** @var Collection|JobPost[] $jobs */
        $jobs = JobPost::ofCountry($country)
                    ->orderBy('created_at', 'desc')
                   ->take(5)
                   ->get();;

        return view('home', ["jobs" => $jobs]);
    }
}
