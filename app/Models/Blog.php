<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner',
        'blogcat_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function blogcat()
    {
        return $this->belongsTo(Blogcat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
