<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
