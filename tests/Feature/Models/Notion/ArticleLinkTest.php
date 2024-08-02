<?php

namespace Tests\Feature\Models\Notion;

use App\Models\Notion\ArticleLink;
use Tests\TestCase;

class ArticleLinkTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $json = file_get_contents(dirname(__FILE__).'/article_link_test.json');
        $data = json_decode($json, true);

        $link = ArticleLink::fromJsonData($data['results'][0]);

        $this->assertEquals('888c4ff9-2287-45c7-aa05-bc995e69bcb5', $link->id);
        $this->assertEquals('Test Article', $link->title);
        $this->assertEquals('This is a test article.', $link->excerpt);
        $this->assertEquals('http://localhost/blogs/test-article', $link->url);
        $this->assertEquals('2024-05-13', $link->publishedAt->format('Y-m-d'));
    }
}
