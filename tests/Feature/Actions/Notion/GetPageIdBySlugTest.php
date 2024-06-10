<?php

namespace Tests\Feature\Actions\Notion;

use App\Actions\Notion\CallGetPage;
use App\Actions\Notion\CallGetPageBySlug;
use App\Actions\Notion\ConvertPageToHtml;
use App\Actions\Notion\FetchArticle;
use App\Actions\Notion\GetPageIdBySlug;
use App\Actions\Notion\NoSuchSlugExistsException;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleSlugCache;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class GetPageIdBySlugTest extends TestCase
{
    public function test_invoke_returns_page_id_from_cache(): void
    {
        $slugStr = "test-slug";
        $pageId = "testId";

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

        $getPageMock = Mockery::mock(CallGetPageBySlug::class);


        $fetch = new GetPageIdBySlug(
            $articleSlugCacheMock, $getPageMock, 
        );

        $result = $fetch($slugStr);

        $this->assertEquals($pageId, $result);
    }

    public function test_invoke_returns_page_id_by_calling_CallGetPageBySlug(): void
    {
        $slugStr = "test-slug";
        $pageId = "testId";

        $articleSlugCacheMock = Mockery::mock(
            ArticleSlugCache::class,
            function (MockInterface $mock) use ($slugStr, $pageId) {
                $slug = new Slug($slugStr, $pageId);
                $mock->shouldReceive('has')
                    ->with($slugStr)
                    ->andReturn(false);
            }
        );

        $getPageMock = Mockery::mock(
            CallGetPageBySlug::class, function (MockInterface $mock) use ($pageId) {
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


        $fetch = new GetPageIdBySlug(
            $articleSlugCacheMock, $getPageMock, 
        );

        $result = $fetch($slugStr);

        $this->assertEquals($pageId, $result);
    }

    public function test_invoke_returns_exception_if_slug_doesnt_exist(): void
    {
        $slugStr = "test-slug";
        $pageId = "testId";

        $articleSlugCacheMock = Mockery::mock(
            ArticleSlugCache::class,
            function (MockInterface $mock) use ($slugStr, $pageId) {
                $slug = new Slug($slugStr, $pageId);
                $mock->shouldReceive('has')
                    ->with($slugStr)
                    ->andReturn(false);
            }
        );

        $getPageMock = Mockery::mock(
            // API returns no resluts
            CallGetPageBySlug::class, function (MockInterface $mock) use ($pageId) {
                $json = <<<JSON
                    { "results": [] }
                JSON;

                $mock->shouldReceive('__invoke')
                    ->andReturn($json);
            }
        );


        $fetch = new GetPageIdBySlug(
            $articleSlugCacheMock, $getPageMock, 
        );

        $this->expectException(NoSuchSlugExistsException::class);
        $this->expectExceptionMessage("The specified blog: {$slugStr} doesn't exist.");
        $result = $fetch($slugStr);

    }
}
