<?php

namespace App\Listeners\Notion;

use App\Events\Notion\ArticleLinksRetrieved;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleSlugCache;

class CacheSlugs
{
    public function __construct(
        readonly private ArticleSlugCache $slugCache,
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleLinksRetrieved $event): void
    {
        $json = $event->json;

        $jsonData = json_decode($json, true);

        foreach ($jsonData['results'] as $articleLink) {
            $slug = Slug::fromJsonArray($articleLink);

            if (! $this->slugCache->has($slug->slug)) {
                $this->slugCache->store($slug);
            }
        }
    }
}
