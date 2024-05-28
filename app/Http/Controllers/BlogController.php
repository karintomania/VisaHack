<?php

namespace App\Http\Controllers;

use App\Actions\Notion\FetchArticleLinks;
use App\Models\JobPost;

class BlogController extends Controller
{
    public function __construct(
    private FetchArticleLinks $fetchArticleLinks
    ){}

    public function index()
    {
        $articleLinks = $this->fetchArticleLinks->__invoke();
        return view('blogs', ["links" => $articleLinks]);
    }
}
