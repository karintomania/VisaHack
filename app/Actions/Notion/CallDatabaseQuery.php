<?php


namespace App\Actions\Notion;

use Illuminate\Support\Facades\Http;

class CallDatabaseQuery
{

    public function __invoke()
    {
        $url = config('services.notion.base_url')."/databases/a5dfa8ae-154e-4b26-a043-391a90cac6c6/query";

        $body = [
            "filter" => [
                "property" => "is_public",
                "checkbox" => [
                    "equals" => true
                ]
            ],
            "sorts" => [
                [
                    "property" => "published_at",
                    "direction" => "descending"
                ]
            ]
        ];

        $header = [
            "Notion-Version" => config("services.notion.api_version"),
            "Authorization" => sprintf("Bearer %s", config('services.notion.api_key')),
        ];

        $response = Http::withHeaders($header)->post($url, $body);

        return $response;
    }
    
}
