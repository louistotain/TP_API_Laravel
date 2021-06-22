<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->go_back != null){
            return [
                'link' => env('APP_URL') . 'api/categories/' . $this->id,
                'uuid' => $this->id,
                'name' => $this->name,
                'go_back' => $this->go_back
            ];
        }else{
            return [
                'link' => env('APP_URL') . 'api/categories/' . $this->id,
                'uuid' => $this->id,
                'name' => $this->name
            ];
        }
    }
}

