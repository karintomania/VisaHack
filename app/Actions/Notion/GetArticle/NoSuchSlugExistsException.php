<?php

namespace App\Actions\Notion\GetArticle; 

use \Exception;

class NoSuchSlugExistsException extends Exception
{
    public function __construct(string $slugStr)
    {
       parent::__construct("The specified blog: {$slugStr} doesn't exist."); 
    }
    
}
