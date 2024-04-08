<?php

namespace App\Models;

use App\Enums\Countries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class JobPost extends Model
{
    use HasFactory;


    public function scopwhereCountry(Builder $query, Countries $country): void
    {
        $query->where("country", $country->value);
    }

    protected function country(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Countries::from($value),
            set: fn (Countries $value) => $value->value,
        );
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
