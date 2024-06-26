<?php

namespace App\Actions\Notion\GetArticle;

class FetchArticle
{
    public function __construct(
        readonly private GetArticleIdBySlug $getArticleIdBySlug,
        readonly private CallArticleApi $getArticle,
        readonly private ConvertPageToHtml $convert,
    ) {
    }

    public function __invoke(string $slugStr): string
    {

        $pageId = $this->getArticleIdBySlug->__invoke($slugStr);
        $json = $this->getArticle->__invoke($pageId);
        $html = $this->convert->__invoke($json);

        return $html;
    }
}
