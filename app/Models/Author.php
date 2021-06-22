<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id','firstname','lastname', 'birthdate', 'death_date'];
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

        static::deleting(function($author) {
            $author->books()->delete();
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

    public function books(){
        return $this->HasMany('App\Models\Book');
    }
}
