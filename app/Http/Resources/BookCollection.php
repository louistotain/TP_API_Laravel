<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->collection->count(),
            'data' => $this->collection,
            'go_back' => $this[0]->whenLoaded('author', env('APP_URL').''.request()->segments()[0])
        ];
    }
}
