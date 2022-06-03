<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $data['name'] = $this->name;
        $data['email'] = $this->email;
        if ($this->lectures()->exists()) {
            $data['pivot'] = $this->lectures()->get()->pluck('pivot');
        }
        return $data;
    }
}
