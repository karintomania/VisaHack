<?php

namespace App\Actions\Notion;

use Illuminate\Support\Facades\Http;

class CallDatabaseQuery
{
    public function __construct(
        private readonly GetNotionRequestHeader $getNotionRequestHeader
    ) {
    }

    public function __invoke(): string
    {
        $url = config('services.notion.database_query_url');

        $header = $this->getNotionRequestHeader->__invoke();
        $body = $this->getRequestBody();

        $response = Http::withHeaders($header)->post($url, $body);

        return $response->body();
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
