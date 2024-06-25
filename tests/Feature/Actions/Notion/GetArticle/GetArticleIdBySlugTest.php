<?php

namespace Tests\Feature\Actions\Notion\GetArticle;

use App\Actions\Notion\GetArticle\CallFindArticleBySlugApi;
use App\Actions\Notion\GetArticle\GetArticleIdBySlug;
use App\Actions\Notion\GetArticle\NoSuchSlugExistsException;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleSlugCache;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class GetArticleIdBySlugTest extends TestCase
{
    public function test_invoke_returns_page_id_from_cache(): void
    {
        $slugStr = 'test-slug';
        $pageId = 'testId';

        // mock cache
        $articleSlugCacheMock = Mockery::mock(
            ArticleSlugCache::class,
            function (MockInterface $mock) use ($slugStr, $pageId) {
                $slug = new Slug($slugStr, $pageId);
                $mock->shouldReceive('has')
                    ->with($slugStr)
                    ->andReturn(true);
                $mock->shouldReceive('get')
                    ->with($slugStr)
                    ->andReturn($slug);
            }
        );

        // mock API, but this won't be used
        $getPageMock = Mockery::mock(CallFindArticleBySlugApi::class);

        $getArticleIdBySlug = new GetArticleIdBySlug(
            $articleSlugCacheMock, $getPageMock,
        );

        $result = $getArticleIdBySlug->__invoke($slugStr);

        $this->assertEquals($pageId, $result);
    }

    public function test_invoke_returns_page_id_by_calling_CallFindArticleBySlugApi(): void
    {
        $slugStr = 'test-slug';
        $pageId = 'testId';

        // mock no cache
        $articleSlugCacheMock = Mockery::mock(
            ArticleSlugCache::class,
            function (MockInterface $mock) use ($slugStr, $pageId) {
                $slug = new Slug($slugStr, $pageId);
                $mock->shouldReceive('has')
                    ->with($slugStr)
                    ->andReturn(false);
            }
        );

        // mock API respponse
        $getPageMock = Mockery::mock(
            CallFindArticleBySlugApi::class, function (MockInterface $mock) use ($pageId) {
                $json = <<<JSON
                    {
                        "results": [
                            {"id": "{$pageId}"}
                        ]
                    }
                JSON;

                $mock->shouldReceive('__invoke')
                    ->andReturn($json);
            }
        );

        $getArticleIdBySlug = new GetArticleIdBySlug(
            $articleSlugCacheMock, $getPageMock,
        );

        $result = $getArticleIdBySlug->__invoke($slugStr);

        $this->assertEquals($pageId, $result);
    }

    public function test_invoke_returns_exception_if_slug_doesnt_exist(): void
    {
        $slugStr = 'test-slug';
        $pageId = 'testId';

        // no cache
        $articleSlugCacheMock = Mockery::mock(
            ArticleSlugCache::class,
            function (MockInterface $mock) use ($slugStr, $pageId) {
                $slug = new Slug($slugStr, $pageId);
                $mock->shouldReceive('has')
                    ->with($slugStr)
                    ->andReturn(false);
            }
        );

        // mock API returns no resluts
        $getPageMock = Mockery::mock(
            CallFindArticleBySlugApi::class, function (MockInterface $mock) {
                $json = <<<'JSON'
                    { "results": [] }
                JSON;

                $mock->shouldReceive('__invoke')
                    ->andReturn($json);
            }
        );

        $getArticleIdBySlug = new GetArticleIdBySlug(
            $articleSlugCacheMock, $getPageMock,
        );

        // assert exception
        $this->expectException(NoSuchSlugExistsException::class);
        $this->expectExceptionMessage("The specified blog: {$slugStr} doesn't exist.");
        $result = $getArticleIdBySlug->__invoke($slugStr);

    }
}
