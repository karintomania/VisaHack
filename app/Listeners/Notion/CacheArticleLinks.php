<?php

namespace App\Listeners\Notion;

use App\Events\Notion\ArticleLinksRetrieved;
use App\Repository\Notion\ArticleLinkCache;

class CacheArticleLinks
{
    /**
     * Create the event listener.
     */
    public function __construct(
        readonly private ArticleLinkCache $cache,
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleLinksRetrieved $event): void
    {
        $links = $event->links;
        $this->cache->store($links);

    }
}
