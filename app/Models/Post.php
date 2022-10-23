<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * fillable attributes
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'slug', 'description', 'publication_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
