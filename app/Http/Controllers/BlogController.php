<?php

namespace App\Http\Controllers;

use App\Actions\Notion\FetchArticle;
use App\Actions\Notion\FetchArticleLinks;

class BlogController extends Controller
{
    public function __construct(
        private FetchArticleLinks $fetchArticleLinks,
        private FetchArticle $fetchArticle,
    ) {
    }

    public function index()
    {
        $articleLinks = $this->fetchArticleLinks->__invoke();

        return view('blog/links', ['links' => $articleLinks]);
    }

    public function article(string $slug)
    {
        $html = $this->fetchArticle->__invoke($slug);

        return view('blog/article', ['html' => $html]);
    }
}
