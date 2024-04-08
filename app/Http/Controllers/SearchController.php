<?php

namespace App\Http\Controllers;

use App\Enums\Countries;
use App\Http\Requests\SearchJobRequest;
use App\Models\JobPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function __construct(
        private JobPost $jobPost,
    ) {
    }

    public function __invoke(SearchJobRequest $request): View|Factory
    {

        $validated = $request->validated();

        $query = $this->buildQuery($validated);

        $jobs = $query->get();

        return view('home', ['jobs' => $jobs]);
    }

    private function buildQuery(array $validated): Builder
    {
        $query = JobPost::select();

        if (isset($validated['keywords']) && $validated['keywords']) {
            $query = $query->where('description', 'like', "%{$validated['keywords']}%");
        }

        if (isset($validated['country']) && $validated['country']) {
            $query->whereCountry(Countries::from($validated['country']));
        }

        return $query->orderBy('created_at', 'desc')->take(5);
    }
}
