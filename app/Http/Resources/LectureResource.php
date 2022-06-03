<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        if ($request->isMethod('post') && $this->users()->exists()) {
            $data['users'] = UserCollection::collection($this->users);
        }
        return $data;
    }
}
