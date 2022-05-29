<?php
namespace App\Repositories;

use App\Models\Lecture;
use App\Repositories\Interfaces\LectureRepositoryInterface;

class LectureRepository implements LectureRepositoryInterface
{
    protected $lecture;

    public function __construct(Lecture $lecture)
    {
        return $this->lecture = $lecture;
    }

    public function index($searchAndSort, $request)
    {
        return $searchAndSort->execute($request, $this->lecture);
    }

    public function store($request)
    {
        return $this->lecture::create($request->validated());
    }

    public function update($request, $lecture)
    {
        return $lecture->update($request->validated());
    }

    public function destroy($lecture)
    {
        return $lecture->delete();
    }

    public function attachUser($lecture, $request)
    {
        if (!$lecture->users()->where('user_id', '=', $request->user_id)->exists()) {
            return $lecture->users()->attach($request->user_id);
        }
    }
}
