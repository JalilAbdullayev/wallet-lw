<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'order',
        'status'
    ];

    protected function casts(): array {
        return [
            'status' => 'boolean'
        ];
    }
}
