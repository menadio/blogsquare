<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, Sluggable;

    public const SORTABLE_FIELDS = ['Publication Date' => 'publication_date'];

    public const SORT_DIRECTIONS = [
        'Ascending' => 'asc',
        'Descending' => 'desc'
    ];

    /**
     * fillable attributes
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'description', 'publication_date'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
