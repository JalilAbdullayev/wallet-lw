<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model {
    use SoftDeletes;

    protected $table = 'subcategories';

    protected $fillable = [
        'title',
        'slug',
        'order',
        'status',
        'category_id',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function operations(): HasMany {
        return $this->hasMany(Operation::class);
    }

    protected function casts(): array {
        return [
            'status' => 'boolean',
        ];
    }
}
