<?php

namespace App\Actions\Notion\GetArticle;

use App\Actions\Notion\GetNotionRequestHeader;
use Illuminate\Support\Facades\Http;

class CallArticleApi
{
    public function __construct(
        readonly private GetNotionRequestHeader $getNotionRequestHeader
    ) {
    }

    public function __invoke(string $id): string
    {
        $url = sprintf(config('services.notion.get_page_url'), $id);

        $header = $this->getNotionRequestHeader->__invoke();

        $response = Http::withHeaders($header)->get($url);

        return $response->body();

        // $json = file_get_contents("/var/www/html/tests/Feature/Actions/Notion/convert_page_test.json");
        // return $json;

    }
}
