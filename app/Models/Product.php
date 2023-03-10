<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const IS_PUBLISHED = true;
    const IS_UNPUBLISHED = false;

    protected $table = 'products';
    protected $guarded = false;

    static function getPublished() {
        return [
          self::IS_PUBLISHED => 'Опубликовано',
          self::IS_UNPUBLISHED => 'Не опубликовано',
        ];
    }

    public function getPublishedTitleAttribute() {
        return self::getPublished()[$this->is_published];
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function getImageUrlAttribute() {
        return url('storage/' . $this->preview_img);
    }
}
