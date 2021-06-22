<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->go_back != null){
            return [
                'link' => env('APP_URL').'api/books/'.$this->id,
                'uuid' => $this->id,
                'name' => $this->name,
                'category' => new CategoryResource(Category::all()->find($this->categories_id)),
                'author' => new AuthorResource($this->whenLoaded('author')),
                'publish_date' => $this->publish_date,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'go_back' => $this->go_back
            ];
        }else{
            return [
                'link' => env('APP_URL').'api/books/'.$this->id,
                'uuid' => $this->id,
                'name' => $this->name,
                'category' => new CategoryResource(Category::all()->find($this->categories_id)),
                'author' => new AuthorResource($this->whenLoaded('author')),
                'publish_date' => $this->publish_date,
                'status' => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ];
        }
    }
}
