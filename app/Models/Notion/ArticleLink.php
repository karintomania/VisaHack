<?php

namespace App\Models\Notion;

use Carbon\CarbonImmutable;

class ArticleLink
{
    public function __construct(
        public string $id,
        public string $excerpt,
        public string $title,
        public string $url,
        public CarbonImmutable $publishedAt,
    ) {
    }

    public static function fromJsonData(array $data): self
    {
        $id = $data['id'];

        $properties = $data['properties'];
        $excerpt = data_get($properties, 'excerpt.rich_text.0.plain_text');
        $title = data_get($properties, 'title.title.0.plain_text');
        $slug = data_get($properties, 'slug.rich_text.0.plain_text');
        $url = (string) url('/blogs/'.$slug);
        $publishedAtStr = data_get($properties, 'published_at.date.start');
        $publishedAt = CarbonImmutable::parse($publishedAtStr);

        return new ArticleLink(
            $id,
            $excerpt,
            $title,
            $url,
            $publishedAt,
        );
    }
}
