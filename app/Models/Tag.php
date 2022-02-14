<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, ApiTrait;

    protected $guarded = ['id'];

    // Relationships

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
