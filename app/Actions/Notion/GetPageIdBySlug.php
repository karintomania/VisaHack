<?php

namespace App\Actions\Notion;

use App\Repository\Notion\ArticleSlugCache;

class GetPageIdBySlug{

    public function __construct(
        private ArticleSlugCache $cache,
        private CallGetPageBySlug $callGetPageBySlug,
    ){}


    /**
     * @throw NoSuchSlugExistsException
     */
    public function __invoke(string $slugStr):string
    {
        if ($this->cache->has($slugStr)) {
            $slug = $this->cache->get($slugStr);

            $pageId = $slug->pageId;

        } else {
            $json = $this->callGetPageBySlug->__invoke($slugStr);

            $data = json_decode($json, true);

            $pageId = data_get($data, "results.0.id");

            if (!$pageId) {
                // return 404
                throw new NoSuchSlugExistsException($slugStr);
            }
            
        }

        return $pageId;
    }
    
}
