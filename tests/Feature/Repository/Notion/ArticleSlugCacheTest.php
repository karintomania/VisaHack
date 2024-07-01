<?php

namespace Tests\Feature\Repository\Notion;

use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleSlugCache;
use Tests\TestCase;

class ArticleSlugCacheTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_SlugCache_stores_slug(): void
    {

        $slugStr = 'test-slug';
        $pageId = '12345';
        $slug = new Slug($slugStr, $pageId);

        $cache = new ArticleSlugCache();

        $this->assertFalse($cache->has($slugStr));

        $cache->store($slug);

        $this->assertTrue($cache->has($slugStr));

        $cachedSlug = $cache->get($slugStr);

        $this->assertEquals($slug->slug, $cachedSlug->slug);
        $this->assertEquals($slug->pageId, $cachedSlug->pageId);

    }
}
