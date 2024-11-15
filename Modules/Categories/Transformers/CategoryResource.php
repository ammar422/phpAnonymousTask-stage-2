<?php

namespace Modules\Category\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Article\Transformers\ArticleResource;

class CategoryResource extends JsonResource
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
                    'name' => $this->translate('en')?->name,
                    'description' => $this->translate('en')?->description,
                ],
                'ar' => [
                    'name' => $this->translate('ar')?->name,
                    'description' => $this->translate('ar')?->description,
                ],
            ],
            'slug' => $this->slug,
            'status' => $this->status,
            'articles_count' => $this->when($this->articles_count !== null, $this->articles_count),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            'deleted_at' => $this->deleted_at?->format('Y-m-d H:i:s'),
            'articles' => ArticleResource::collection($this->whenLoaded('articles')),
        ];
    }
}
