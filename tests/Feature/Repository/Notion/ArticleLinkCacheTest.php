<?php

namespace Tests\Feature\Repository;

use Illuminate\Support\Facades\Cache;
use App\Repository\Notion\ArticleLinkCache;
use Tests\TestCase;

class ArticleLinkCacheTest extends TestCase
{

    /**
     * A basic test example.
     */
    public function test_has_returns_true_if_cached(): void
    {
        Cache::shouldReceive('has')
            ->once()
            ->with(
                sprintf(ArticleLinkCache::KEY, 1)
            )->andReturn(true);

        $nalc = new ArticleLinkCache();

        $result = $nalc->has();

        $this->assertTrue($result);
    }

    public function test_get_returns_cached_links(): void
    {
        
        $json = <<<JSON
        {
            "test": "test value"
        }
        JSON;

        Cache::shouldReceive('get')
            ->once()
            ->with(
                sprintf(ArticleLinkCache::KEY, 2)
            )->andReturn($json);

        $nal = new ArticleLinkCache();

        $result = $nal->get(2);

        $this->assertEquals($json, $result);
    }
}
