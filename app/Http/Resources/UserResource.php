<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['email'] = $this->email;
        if ($request->isMethod('post') && $this->lectures()->exists()) {
            $data['lectures'] = LectureCollection::collection($this->lectures);
        }
        return $data;
    }
}
