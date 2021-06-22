<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        if ($this->books()->get()->count() == 0){
            return [
                'link' => env('APP_URL').'api/authors/'.$this->id,
                'uuid' => $this->id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'birthdate' => $this->birthdate,
                'death_date' => $this->death_date,
                'books' => null,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'go_back' => $this->go_back
            ];
        }

        if($this->go_back != null){
            return [
                'link' => env('APP_URL').'api/authors/'.$this->id,
                'uuid' => $this->id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'birthdate' => $this->birthdate,
                'death_date' => $this->death_date,
                'books' => new BookCollection($this->whenLoaded('books')),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'go_back' => $this->go_back
            ];
        }else{
            return [
                'link' => env('APP_URL').'api/authors/'.$this->id,
                'uuid' => $this->id,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'birthdate' => $this->birthdate,
                'death_date' => $this->death_date,
                'books' => new BookCollection($this->whenLoaded('books')),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ];
        }
    }
}
