<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('complete', function (Builder $builder) {
            $builder->with(['category', 'images']);
        });
    }

    protected static $logAttributes = [
        'sku_code',
        'category_id',
        'name',
        'price',
        'composition',
        'size',
        'stock',
    ];
    protected static $logOnlyDirty = true;

    protected $fillable = [
        'sku_code',
        'category_id',
        'name',
        'price',
        'composition',
        'size',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
