<?php
namespace App\Repositories;

use App\Models\Lecture;
use App\Repositories\Interfaces\LectureRepositoryInterface;
use App\Services\SearchAndSort;

class LectureRepository implements LectureRepositoryInterface
{
    protected $lecture;
    protected $searchAndSort;

    public function __construct(SearchAndSort $searchAndSort, Lecture $lecture)
    {
        $this->lecture = $lecture;
        $this->searchAndSort = $searchAndSort;
    }

    public function index($request)
    {
        return $this->searchAndSort->execute($request, $this->lecture);
    }

    public function store($request)
    {
        return $this->lecture::create($request);
    }

    public function update($request, $lecture)
    {
        return $lecture->update($request);
    }

    public function destroy($lecture)
    {
        return $lecture->delete();
    }

    public function attachUser($lecture, $request)
    {
        if (!$lecture->users()->where('user_id', $request['user_id'])->exists()) {
            return $lecture->users()->attach($request['user_id']);
        }
    }
}
