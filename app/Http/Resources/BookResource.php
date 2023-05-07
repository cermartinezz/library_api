<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use JsonSerializable;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $total_of_copies = $this->copies_count ?? 0;
        $total_rented_copies = $this->rented_copies_count ?? 0;
        $total_available_copies = $total_of_copies - $total_rented_copies;

        $copies = $this->copies ?? [];
        $rented_copies = $this->rentedCopies ?? [];
        $checkouts = $this->allCheckouts ?? [];
        $available_copies = $this->availableCopies($rented_copies,$copies);

        $author = $this->author ? [
            'id' => $this->author->id,
            'name' => $this->author->name,
        ] : [];
        $genre = $this->genre ? [
            'id' => $this->genre->id,
            'name' => $this->genre->name,
        ] : [];


        return [
            'id'                        => $this->id,
            'title'                     => $this->title,
            'slug'                      => $this->slug,
            'total_of_copies'           => $total_of_copies,
            'total_available_copies'    => $total_available_copies,
            'total_rented_copies'       => $total_rented_copies,
            'checkouts'                 => $checkouts->toArray(),
            'available_copies'          => $available_copies->toArray(),
            'rented_copies'             => $rented_copies->toArray(),
            'author'                    => $author,
            'genre'                     => $genre
        ];
    }

    private function availableCopies(Collection $rented_copies, Collection $copies): Collection
    {
        $rented_copies = $rented_copies->map(fn($checkout) => $checkout->book_copy_id )->toArray();

        return $copies->filter(function($copy)  use ($rented_copies) {
            return !in_array($copy->id,$rented_copies);
        });
    }
}
