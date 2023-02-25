<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $guarded = false;
    protected $table = 'products';

    // image_url
    public function getImageUrlAttribute() {
        return asset(Storage::url($this->path));
    }

    public function order() {
        return $this->hasMany(Order::class, 'product_id', 'id');
    }
}
