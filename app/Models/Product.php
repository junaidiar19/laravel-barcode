<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'name', 'qty', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // filter
    public function scopeFilter($query, $params)
    {
        if (isset($params['q'])) {
            $query->where('kode', 'like', '%' . $params['q'] . '%');
        }

        return $query;
    }
}
