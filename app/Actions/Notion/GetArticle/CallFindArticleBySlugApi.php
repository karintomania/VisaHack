<?php

namespace App\Actions\Notion\GetArticle;

use App\Actions\Notion\GetNotionRequestHeader;
use Illuminate\Support\Facades\Http;

class CallFindArticleBySlugApi
{
    public function __construct(
        readonly private GetNotionRequestHeader $getNotionRequestHeader
    ) {
    }

    public function __invoke(string $slug): string
    {
        $url = config('services.notion.database_query_url');

        $header = $this->getNotionRequestHeader->__invoke();
        $body = $this->getRequestBody($slug);

        $response = Http::withHeaders($header)->post($url, $body);

        return $response->body();
    }

    private function getRequestBody(string $slug): array
    {
        // request body to find a page by slug
        return [
            'filter' => [
                'and' => [
                    [
                        'property' => 'is_public',
                        'checkbox' => [
                            'equals' => true,
                        ],
                    ],
                    [
                        'property' => 'slug',
                        'rich_text' => [
                            'equals' => $slug,
                        ],
                    ],
                ],
            ],
            'sorts' => [
                [
                    'property' => 'published_at',
                    'direction' => 'descending',
                ],
            ],
        ];
    }
}
