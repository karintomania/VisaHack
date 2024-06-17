<?php

namespace App\Actions\Notion\GetArticleLinks;

use App\Models\Notion\ArticleLink;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleLinkCache;
use App\Repository\Notion\ArticleSlugCache;

class FetchArticleLinks
{
    public function __construct(
        private CallArticleLinksApi $api,
        private ArticleLinkCache $linkCache,
        private ArticleSlugCache $slugCache,
    ) {
    }

    public function __invoke(): array
    {
        $links = $this->linkCache->has()
            ? $this->linkCache->get()
            : $this->getLinks();

        return $links;

    }

    /**
     * @return ArticleLink[]
     */
    private function getLinks(): array
    {
        $links = $this->api->__invoke();

        return $links;
    }

}
