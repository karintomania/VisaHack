<?php

namespace Tests\Feature\Actions\Notion;

use App\Actions\Notion\CallDatabaseQuery;
use App\Actions\Notion\CallGetPage;
use App\Actions\Notion\CallGetPageBySlug;
use App\Actions\Notion\ConvertPageToHtml;
use App\Actions\Notion\FetchArticle;
use App\Actions\Notion\FetchArticleLinks;
use App\Actions\Notion\GetPageIdBySlug;
use App\Models\Notion\Slug;
use App\Repository\Notion\ArticleLinkCache;
use App\Repository\Notion\ArticleSlugCache;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class FetchArticleTest extends TestCase
{
    public function test_invoke_returns_page(): void
    {
        $slugStr = "test-slug";
        $pageId = "testId";

        $getPageIdBySlugMock = Mockery::mock(
            GetPageIdBySlug::class,
            function (MockInterface $mock) use ($slugStr, $pageId) {
                $slug = new Slug($slugStr, $pageId);
                $mock->shouldReceive('__invoke')
                    ->with($slugStr)
                    ->andReturn($pageId);
            }
        );

        $getPageMock = Mockery::mock(
            CallGetPage::class, function (MockInterface $mock) use ($pageId) {
                $json = file_get_contents(dirname(__FILE__).'/convert_page_test.json');
                $mock->shouldReceive('__invoke')
                    ->with($pageId)
                    ->andReturn($json);
            }
        );


        $fetch = new FetchArticle(
            $getPageIdBySlugMock,
            $getPageMock,
            app()->make(ConvertPageToHtml::class),
        );

        $result = $fetch($slugStr);

        $expected = <<<'HTML'
        <h1>How to write a test Blog using Notion</h1>
        <p>This is a test article. Let’s try not to use blocks for multiple lines.
        I can use Shift + Enter for that.</p>
        <h2>This is a header 2</h2>
        <h3>This is a header 3</h3>
        <p>This is with <u><b>style</b></u>.</p>
        <p>This is with link: <a href="https://example.com">link to somewhere</a>.</p>
        <ol>
        <li>numbered 1</li>
        <li>numbered 2</li>
        </ol>
        <p></p>
        <ul>
        <li>bulleted 1</li>
        <li>bulleted 2</li>
        </ul>
        <img src="https://fastly.picsum.photos/id/686/800/800.jpg?hmac=YqfsJsRmmHGlApJA9jf_TKx1v4U2N4FPoBzj9rdqilo">

        HTML;

        $this->assertEquals($expected, $result);
    }
}
