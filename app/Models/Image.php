<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, ApiTrait;

    protected $guarded = ['id'];

    // Relationships

    public function imageable()
    {
        return $this->morphTo();
    }
}
