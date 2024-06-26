<?php

namespace App\Actions\Notion\GetArticle;

use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleSlugCache;

class GetArticleIdBySlug
{
    public function __construct(
        readonly private ArticleSlugCache $cache,
        readonly private CallFindArticleBySlugApi $api,
    ) {
    }

    /**
     * @return string page id
     *
     * @throw NoSuchSlugExistsException
     */
    public function __invoke(string $slugStr): string
    {
        if ($this->cache->has($slugStr)) {
            // retrive slug from cache
            $slug = $this->cache->get($slugStr);

            $pageId = $slug->pageId;

        } else {
            // call API to get page id
            $json = $this->api->__invoke($slugStr);

            $data = json_decode($json, true);

            $pageId = data_get($data, 'results.0.id');

            if (! $pageId) {
                // return 404 if API doesn't return page
                throw new NoSuchSlugExistsException($slugStr);
            }

            $this->cacheSlug($pageId, $slugStr);
        }

        return $pageId;
    }

    private function cacheSlug(string $pageId, string $slugStr): void
    {
        $slug = new Slug($slugStr, $pageId);
        $this->cache->store($slug);
    }
}
