<?php

namespace App\Http\Resources\Api\Blog\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Трансформація ресурсу в масив.
     */
    public function toArray(Request $request): array
    {
        // $this вказує на поточний об'єкт моделі BlogPost
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'content_raw'    => $this->content_raw, // Потрібно для сторінки [id].vue
            'is_published'   => (bool) $this->is_published,
            'published_at' => $this->published_at ? \Carbon\Carbon::parse($this->published_at)->format('Y-m-d H:i:s') : null,

            'user_id'        => $this->user_id,
            'category_id'    => $this->category_id,

            'user' => [
                'id'   => $this->user_id,
                'name' => $this->user?->name ?? 'Анонім',
            ],
            'category' => [
                'id'    => $this->category_id,
                'title' => $this->category?->title ?? 'Без категорії',
            ],
        ];
    }
}
