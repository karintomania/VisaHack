<?php

namespace App\Models\Notion;

class Slug
{

    public function __construct(
        public string $slug,
        public string $pageId,
    ){}

}
