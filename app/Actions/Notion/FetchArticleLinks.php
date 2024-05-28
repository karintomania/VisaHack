<?php

namespace App\Actions\Notion;

use App\Models\Notion\ArticleLink;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleLinkCache;
use App\Repository\Notion\ArticleSlugCache;

class FetchArticleLinks
{
    public function __construct(
        private CallDatabaseQuery $cdq,
        private ArticleLinkCache $linkCache,
        private ArticleSlugCache $slugCache,
    ) {
    }

    public function __invoke(): array
    {
        $json = $this->linkCache->has()
            ? $this->linkCache->get()
            : $this->getLinksAndCache();

        $jsonData = json_decode($json, true);
        $links = [];

        foreach ($jsonData['results'] as $articleData) {
            $articleLink = ArticleLink::fromJsonData($articleData);
            $links[] = $articleLink;
        }

        return $links;

    }

    private function getLinksAndCache(): string
    {
        $json = $this->cdq->__invoke();

        $this->cacheLinkAndSlug($json);

        return $json;
    }

    private function cacheLinkAndSlug(string $json): void
    {
        // cache $json
        $this->linkCache->store($json);

        $jsonData = json_decode($json, true);

        foreach ($jsonData['results'] as $articleData) {
            $slug = Slug::fromJsonArray($articleData);

            if (! $this->slugCache->has($slug->slug)) {
                $this->slugCache->store($slug);
            }
        }

    }
}
