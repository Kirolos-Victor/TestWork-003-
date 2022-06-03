<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
    public function toArray($request)
    {
        $data['name'] = $this->name;
        if ($this->users()->exists()) {
            $data['pivot'] = $this->users()->get()->pluck('pivot');
        }
        return $data;
    }
}
