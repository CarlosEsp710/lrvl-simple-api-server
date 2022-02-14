<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, ApiTrait;

    const DRAFT = 1;
    const PUBLISHED = 2;

    protected $guarded = ['id'];

    protected $allowIncluded = ['category', 'user', 'tags', 'images'];

    protected $allowFilter = ['id', 'name', 'slug', 'extract', 'body'];

    protected $allowSort = ['id', 'name', 'slug', 'extract', 'body'];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
