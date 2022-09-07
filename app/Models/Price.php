<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'product_id'];

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value/100,
            set: fn ($value) => $value*100,
        );
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
