<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function sizes(){
        return $this->belongsToMany(Size::class, 'product_size');
    }
    public function scopeProductsFromSpecificUser($query, $userId){
        return $query->where('user_id', $userId);
    }
    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

}
