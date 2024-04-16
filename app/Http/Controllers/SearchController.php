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

        $jobs = $query->paginate(10)->withQueryString();

        return view('home', ['jobs' => $jobs]);

    }

    private function buildQuery(array $validated): Builder
    {
        $query = JobPost::active();

        if (isset($validated['keywords']) && $validated['keywords']) {
            $keywords = explode(',', $validated['keywords']);
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                $query = $query->where('description', 'like', "%${keyword}%");
            }
        }

        if (isset($validated['country']) && $validated['country']) {
            $query->country(Countries::from($validated['country']));
        }

        return $query->orderBy('created_at', 'desc')->take(5);
    }
}
