<?php

namespace Tests\Feature\Actions\Notion;

use App\Actions\Notion\{CallDatabaseQuery, FetchArticleLinks};
use App\Repository\Notion\ArticleLinkCache;
use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;

class FetchArticleLinksTest extends TestCase
{
    public function test_invoke_returns_database(): void
    {

        $callDbMock = Mockery::mock(
            CallDatabaseQuery::class, function (MockInterface $mock) {
                $json = file_get_contents(dirname(__FILE__) . "/article_links.json");
                $mock->shouldReceive('__invoke')
                   ->andReturn($json);
            }
        );

        $articleLinkCacheMock = Mockery::mock(
            ArticleLinkCache::class, function (MockInterface $mock) {
                $mock->shouldReceive('has')
                   ->andReturn(false);
                $mock->shouldReceive('store');
            }
        );


        $fetch = new FetchArticleLinks($callDbMock, $articleLinkCacheMock);
        $result = $fetch();

        $this->assertEquals(2, count($result));

        $this->assertEquals("888c4ff9-2287-45c7-aa05-bc995e69bcb5" ,$result[0]->id);
        $this->assertEquals("This is a test article." ,$result[0]->excerpt);
        $this->assertEquals("Test Article" ,$result[0]->title);
        $this->assertEquals("http://localhost/blogs/test-article" ,$result[0]->url);
        $this->assertEquals("2024-05-13", $result[0]->publishedAt->format("Y-m-d"));

        $this->assertEquals("adab3620-eae0-4de0-bf05-54361155b300" ,$result[1]->id);
        $this->assertEquals("This is a test article 2." ,$result[1]->excerpt);
        $this->assertEquals("Test Article 2" ,$result[1]->title);
        $this->assertEquals("http://localhost/blogs/test-article-2" ,$result[1]->url);
        $this->assertEquals("2024-05-14", $result[1]->publishedAt->format("Y-m-d"));
    }
}
