<?php

namespace App\Actions\Notion;

class GetNotionRequestHeader
{
    public function __invoke(): array
    {
        return [
            'Notion-Version' => config('services.notion.api_version'),
            'Authorization' => sprintf('Bearer %s', config('services.notion.api_key')),
        ];
    }
}
