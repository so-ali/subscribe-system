<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user', 'website', 'title', 'content'
    ];
    public function website(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Website::class);
    }
}
