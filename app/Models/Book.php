<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id','name','author_id', 'categories_id', 'publish_date', 'status'];
    protected $guarded = [];

    protected $casts = [
        'id' => 'string'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function author(){
        return $this->belongsTo('App\Models\Author');
    }

    public function categories(){
        return $this->belongsTo('App\Models\Category');
    }
}
