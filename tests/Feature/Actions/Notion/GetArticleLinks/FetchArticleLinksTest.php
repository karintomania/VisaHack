<?php

namespace Tests\Feature\Actions\Notion\GetArticleLinks;

use App\Actions\Notion\GetArticleLinks\CallArticleLinksApi;
use App\Actions\Notion\GetArticleLinks\FetchArticleLinks;
use App\Models\Notion\ArticleLink;
use App\Repository\Notion\ArticleLinkCache;
use App\Repository\Notion\ArticleSlugCache;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class FetchArticleLinksTest extends TestCase
{
    public function test_invoke_returns_links_from_api_when_no_cache(): void
    {

        $callDbMock = Mockery::mock(
            CallArticleLinksApi::class, function (MockInterface $mock) {
                $links = $this->generateTestLinks();
                $mock->shouldReceive('__invoke')
                    ->andReturn($links);
            }
        );

        $articleLinkCacheMock = Mockery::mock(
            ArticleLinkCache::class, function (MockInterface $mock) {
                $mock->shouldReceive('has')
                    ->andReturn(false);
                $mock->shouldReceive('store');
            }
        );

        $articleSlugCacheMock = Mockery::mock(ArticleSlugCache::class);

        $fetch = new FetchArticleLinks($callDbMock, $articleLinkCacheMock, $articleSlugCacheMock);
        $result = $fetch();

        $this->assertEquals(2, count($result));

        $this->assertEquals('888c4ff9-2287-45c7-aa05-bc995e69bcb5', $result[0]->id);
        $this->assertEquals('This is a test article.', $result[0]->excerpt);
        $this->assertEquals('Test Article', $result[0]->title);
        $this->assertEquals('http://localhost/blogs/test-article', $result[0]->url);
        $this->assertEquals('2024-05-13', $result[0]->publishedAt->format('Y-m-d'));

        $this->assertEquals('adab3620-eae0-4de0-bf05-54361155b300', $result[1]->id);
        $this->assertEquals('This is a test article 2.', $result[1]->excerpt);
        $this->assertEquals('Test Article 2', $result[1]->title);
        $this->assertEquals('http://localhost/blogs/test-article-2', $result[1]->url);
        $this->assertEquals('2024-05-14', $result[1]->publishedAt->format('Y-m-d'));
    }


    /**
     * @return ArticleLink[]
     */
    private function generateTestLinks(): array
    {
        $json = file_get_contents(dirname(__FILE__).'/article_links.json');

        $jsonData = json_decode($json, true);

        $links = array_map(
            fn ($articleData) => ArticleLink::fromJsonData($articleData),
            $jsonData['results']
        );

        return $links;

    }
}
