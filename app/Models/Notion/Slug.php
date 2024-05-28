<?php

namespace App\Models\Notion;

class Slug
{
    public function __construct(
        public string $slug,
        public string $pageId,
    ) {
    }

    public static function fromJsonArray(array $jsonArray): self
    {

        $slugStr = $jsonArray['properties']['slug']['rich_text'][0]['plain_text'];
        $pageId = $jsonArray['id'];

        return new self($slugStr, $pageId);
    }
}
