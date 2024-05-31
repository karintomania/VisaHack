<?php

namespace App\Actions\Notion;

use App\Repository\Notion\ArticleSlugCache;

class FetchArticle
{
    public function __construct(
        private CallGetPage $getPage,
        private ArticleSlugCache $cache,
        private ConvertPageToHtml $converter,
    ) {
    }

    public function __invoke(string $slugStr): string
    {

        if ($this->cache->has($slugStr)) {

            $slug = $this->cache->get($slugStr);
            $json = $this->getPage->__invoke($slug->pageId);

            $html = $this->converter->convert($json);

            return $html;
        } else {
            // TODO: handle when slug is not cached
            return '<p>This article is not found.</p>';
        }

    }
}
