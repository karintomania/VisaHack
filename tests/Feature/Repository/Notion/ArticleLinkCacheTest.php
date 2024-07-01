<?php

namespace Tests\Feature\Repository\Notion;

use App\Models\Notion\ArticleLink;
use App\Repository\Notion\ArticleLinkCache;
use Tests\TestCase;
use Carbon\CarbonImmutable;

class ArticleLinkCacheTest extends TestCase
{
    public function test_ArticleLinkCache_stores_and_gets(): void
    {

        // create mock articles
        $article1 = new ArticleLink(
            id: "id-1",
            excerpt: "This is excerpt 1.",
            title: "Test Blog 1",
            url: "http://example.com/blog-1",
            publishedAt: CarbonImmutable::createFromFormat(DATE_ATOM, "2024-07-01T00:00:00+00:00")
        );

        $article2 = new ArticleLink(
            id: "id-2",
            excerpt: "This is excerpt 2.",
            title: "Test Blog 2",
            url: "http://example.com/blog-2",
            publishedAt: CarbonImmutable::createFromFormat(DATE_ATOM, "2024-07-02T00:00:00+00:00")
        );
    

        $cache = new ArticleLinkCache();
        $page = 1;

        // it returns false for non stored key
        $this->assertFalse($cache->has($page));

        $cache->store([$article1, $article2]);

        $this->assertTrue($cache->has($page));

        $cached = $cache->get($page);

        $this->assertCount(2, $cached);
        $this->assertEquals($article1->id, $cached[0]->id);
        $this->assertEquals($article2->id, $cached[1]->id);
        $this->assertEquals($article1->excerpt, $cached[0]->excerpt);
        $this->assertEquals($article2->excerpt, $cached[1]->excerpt);
        $this->assertEquals($article1->title, $cached[0]->title);
        $this->assertEquals($article2->title, $cached[1]->title);
        $this->assertEquals($article1->url, $cached[0]->url);
        $this->assertEquals($article2->url, $cached[1]->url);
        $this->assertEquals($article1->publishedAt, $cached[0]->publishedAt);
        $this->assertEquals($article2->publishedAt, $cached[1]->publishedAt);
    }
}
