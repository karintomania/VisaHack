<?php

namespace App\Repository\Notion;

use App\Models\Notion\ArticleLink;
use Illuminate\Support\Facades\Cache;

class ArticleLinkCache
{
    public const KEY = 'notion_article_link_cache_page_%d';

    public const LIFETIME_SECONDS = 12 * 60 * 60; // 12 hours

    public function has(int $page = 1): bool
    {
        $key = $this->getKey($page);
        $has = Cache::has($key);

        return $has;
    }

    /**
     * @param int $page
     * @return ArticleLink[] $links
     */
    public function get(int $page = 1): array
    {
        $key = $this->getKey($page);
        $json = Cache::get($key);

        return $json;
    }

    /**
     * @param ArticleLink[] $links
     * @param int $page
     */
    public function store(array $links, int $page = 1): void
    {
        $key = $this->getKey($page);
        Cache::put($key, $json, self::LIFETIME_SECONDS);

    }

    private function getKey(int $page): string
    {
        return sprintf(self::KEY, $page);
    }
}
