<?php

namespace Tests\Feature\Repository;

use Illuminate\Support\Facades\Cache;
use App\Repository\Notion\ArticleLinkCache;
use Tests\TestCase;

class ArticleLinkCacheTest extends TestCase
{

    public function test_ArticleLinkCache_stores_and_gets(): void
    {
        
        $json = <<<JSON
        {
            "test": "test value"
        }
        JSON;

        $cache = new ArticleLinkCache();
        $page = 1;

        $this->assertFalse($cache->has($page));

        $cache->store($json);

        $this->assertTrue($cache->has($page));
        
        $cachedJson= $cache->get($page);

        $this->assertEquals($json, $cachedJson);
    }
}
