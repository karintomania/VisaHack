<?php

namespace App\Http\Controllers;

use App\Actions\Notion\FetchArticleLinks;

class BlogController extends Controller
{
    public function __construct(
        private FetchArticleLinks $fetchArticleLinks
    ) {
    }

    public function index()
    {
        $articleLinks = $this->fetchArticleLinks->__invoke();

        return view('blogs', ['links' => $articleLinks]);
    }

    public function article(string $slug)
    {
        $articleLinks = $this->fetchArticleLinks->__invoke();

        return view('blogs', ['links' => $articleLinks]);
    }

}
