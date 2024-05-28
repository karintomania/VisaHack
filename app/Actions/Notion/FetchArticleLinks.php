<?php

namespace App\Actions\Notion;

use App\Models\Notion\ArticleLink;
use App\Repository\Notion\ArticleLinkCache;
use Illuminate\Http\Client\Response;

class FetchArticleLinks
{
    public function __construct(
        private CallDatabaseQuery $cdq,
        private ArticleLinkCache $articleLinkCache,
    ){}

    public function __invoke(): array
    {
        $json = $this->articleLinkCache->has()
            ? $this->articleLinkCache->get()
            : $this->getLinksAndCache();

        $jsonData = json_decode($json, true);
        $links = [];

        foreach ($jsonData['results'] as $articleData) {
            $articleLink = ArticleLink::fromJsonData($articleData);
            $links[] = $articleLink;
        }

        return $links;
        
    }


    private function getLinksAndCache(): string
    {
         $json = $this->cdq->__invoke();

         // cache $json 
         $this->articleLinkCache->store($json);

         return $json;
    }
    
}
