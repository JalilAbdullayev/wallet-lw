<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model {
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'amount',
        'type',
        'tags',
        'category_id',
        'account_id',
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Subcategory::class, 'category_id');
    }

    public function account(): BelongsTo {
        return $this->belongsTo(Account::class);
    }

    protected function casts(): array {
        return [
            'tags' => 'array',
        ];
    }
}
