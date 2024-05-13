<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'auther_name', 'price', 'descreption', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favoriteBy()
    {
        return $this->belongsToMany(User::class,'favorite','book_id','user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rate::class);
    }
}

