<?php

namespace App\Actions\Notion\GetArticleLinks;

use App\Actions\Notion\GetNotionRequestHeader;
use App\Events\Notion\ArticleLinksRetrieved;
use App\Models\Notion\ArticleLink;
use Illuminate\Support\Facades\Http;

class CallArticleLinksApi
{
    public function __construct(
        private readonly GetNotionRequestHeader $getNotionRequestHeader
    ) {
    }

    /**
     * @return ArticleLink[]
     */
    public function __invoke(): array
    {
        $url = config('services.notion.database_query_url');

        $header = $this->getNotionRequestHeader->__invoke();
        $body = $this->getRequestBody();

        $response = Http::withHeaders($header)->post($url, $body);
        $json = $response->body();

        $links = $this->convertJson($json);

        ArticleLinksRetrieved::dispatchIf(! empty($links), $links, $json);

        return $links;
    }

    /**
     * @return ArticleLink[]
     */
    private function convertJson(string $json): array
    {

        $jsonData = json_decode($json, true);

        $links = array_map(
            fn (array $articleData) => ArticleLink::fromJsonData($articleData),
            $jsonData['results']
        );

        return $links;
    }

    private function getRequestBody(): array
    {
        return [
            'filter' => [
                'property' => 'is_public',
                'checkbox' => [
                    'equals' => true,
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
