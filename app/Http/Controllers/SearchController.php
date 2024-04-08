<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Enums\Countries;
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
        $country = Countries::GB;
        $keywords = "python";

        /** @var Collection|JobPost[] $jobs */
        $jobs = JobPost::whereCountry($country)
                    ->where('description', 'like', "%php%")
                    ->orderBy('created_at', 'desc')
                   ->take(5)
                   ->get();;

        return view('home', ["jobs" => $jobs]);
    }
}
