<?php

namespace App\Models\Notion;

class Article
{

    public static function fromJson(array $json): self
    {
        return new Article();
    }
    
}
