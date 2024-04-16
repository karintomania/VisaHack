<?php

namespace App\Models;

use App\Enums\Countries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    public function scopeCountry(Builder $query, Countries $country): void
    {
        $query->where('country', $country->value);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }

    protected function country(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Countries::from($value),
            set: fn (Countries $value) => $value->value,
        );
    }

    public function getPlainDescription(): string
    {
        $description = $this->description;
        $regex = '/\<\/?.+?\>/';
        $plain = preg_replace($regex, '', $description);

        $plain = str_replace('`', '', $plain);

        return $plain;
    }
}
