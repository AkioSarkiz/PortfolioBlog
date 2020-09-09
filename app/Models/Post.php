<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;

class Post extends Eloquent
{
    protected $fillable = [
        'title', 'id_author', 'content', 'description', 'media',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function hasCover(): bool
    {
        return is_array($this->media) && array_key_exists('cover', $this->media) && $this->media['cover'] !== null;
    }
}
