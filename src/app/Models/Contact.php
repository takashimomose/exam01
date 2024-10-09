<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    
    protected $fillable = [
        'id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
        'created_at'
    ];

    // 以下ContactモデルにCategoryモデルとのリレーションシップを定義
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // category_idで関連付け
    }
}
