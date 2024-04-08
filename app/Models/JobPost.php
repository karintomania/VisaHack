<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;


    public function scopeOfCountry(Builder $query, string $country): void
    {
        $query->where("country", $country);
    }

    public function getPlainDescription():string
    {
        $description = $this->description;
        $regex= '/\<\/?.+?\>/';
        $plain = preg_replace($regex, '', $description);

        $plain = str_replace("`", "", $plain);
        
        return $plain;
    }
}
