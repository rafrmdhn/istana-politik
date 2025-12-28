<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'artikels';
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'artikel_id', 'id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'artikel_tags', 'artikel_id', 'tag_id');
    }

    public function additional_authors() {
        return $this->belongsToMany(AdditionalAuthor::class, 'artikel_additional_author', 'artikel_id', 'additional_author_id');
    }

    public function scopeTerbit($q)
    {
        return $q->where('tanggal_posting', '<=', now('Asia/Jakarta'));
    }
}
