<?php

namespace App\Repository\Notion;

use Illuminate\Support\Facades\Cache;
use App\Models\Notion\Slug;

class ArticleSlugCache{

    public const KEY = "notion_article_slug_%d";
    public const LIFETIME_SECONDS = 12 * 60 * 60; // 12 hours

    public function has(string $slugStr): bool
    {
        $key = $this->getKey($slugStr);
        $has = Cache::has($key);
        return $has;
    }

    public function get(string $slugStr): Slug
    {
        $key = $this->getKey($slugStr);
        $slug = Cache::get($key);
        return $slug;
    }

    /**
     * @return void
     */
    public function store(Slug $slug): void
    {
        $key = $this->getKey($slug->slug);
        Cache::put($key, $slug, self::LIFETIME_SECONDS);

    }

    private function getKey(string $slugStr): string
    {
        return sprintf(self::KEY, $slugStr);
    }
    
}
