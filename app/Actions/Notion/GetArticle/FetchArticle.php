<?php

namespace App\Actions\Notion\GetArticle;


class FetchArticle
{
    public function __construct(
        readonly private GetArticleIdBySlug $getArticleIdBySlug,
        readonly private CallGetArticle $getArticle,
        readonly private ConvertArticleToHtml $converter,
    ) {
    }

    public function __invoke(string $slugStr): string
    {

        $pageId = $this->getPageIdBySlug->__invoke($slugStr);
        $json = $this->getPage->__invoke($pageId);
        $html = $this->converter->convert($json);

        return $html;
    }

}
