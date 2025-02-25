<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function commentable(): MorphTo
    {

        return $this->morphTo();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('replies');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
