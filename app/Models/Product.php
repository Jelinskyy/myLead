<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false) 
            $query->where('name', 'like', '%' . $filters['search'] . '%')
            ->orWhere('description', 'like', '%' . $filters['search'] . '%');
    }

    public function prices(){
        return $this->hasMany(Price::class, 'product_id');
    }
}
