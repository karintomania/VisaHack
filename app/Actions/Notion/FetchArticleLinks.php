<?php

namespace App\Actions\Notion;

use App\Models\Notion\ArticleLink;

class FetchArticleLinks
{
    public function __construct(
        private CallDatabaseQuery $cdq
    ){}

    public function __invoke()
    {
        $jsonData = $this->cdq->__invoke();

        $links = [];

        foreach ($jsonData['results'] as $articleData) {
            $articleLink = ArticleLink::fromJsonData($articleData);
            $links[] = $articleLink;
        }

        return $links;
        
    }
    
}
