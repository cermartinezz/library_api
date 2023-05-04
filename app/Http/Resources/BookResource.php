<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'slug'  => $this->slug,
            'number_of_copies' => $this->copies_count ?? 0,
            'copies' => $this->copies ?? [],
            'author' => $this->author ? [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ] : [],
            'genre'  => $this->genre ? [
                'id' => $this->genre->id,
                'name' => $this->genre->name,
            ] : []
        ];
    }
}
