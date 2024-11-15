<?php

namespace Modules\Article\Transformers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\CategoryResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'translations' => [
                'en' => [
                    'title' => $this->translate('en')?->title,
                    'content' => $this->translate('en')?->content,
                ],
                'ar' => [
                    'name' => $this->translate('ar')?->title,
                    'content' => $this->translate('ar')?->content,
                ],
            ],
            'category_id' => $this->category_id,
            'author_id' => $this->author_id,
            'slug' => $this->slug,
            'status' => $this->status,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'author' => new UserResource($this->whenLoaded('author')),
        ];
    }
}
