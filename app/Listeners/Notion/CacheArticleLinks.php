<?php

namespace App\Listeners\Notion;

use App\Events\Notion\ArticleLinksRetrieved;
use App\Models\Notion\ArticleLink;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleLinkCache;
use App\Repository\Notion\ArticleSlugCache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CacheArticleLinks
{
    /**
     * Create the event listener.
     */
    public function __construct(
        readonly private ArticleLinkCache $cache,
    ){}

    /**
     * Handle the event.
     */
    public function handle(ArticleLinksRetrieved $event): void
    {
        $links = $event->links;
        $this->cache->store($links);

    }

}
