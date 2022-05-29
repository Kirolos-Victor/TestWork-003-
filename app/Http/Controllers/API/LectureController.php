<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Http\Requests\UserRequest;
use App\Models\Lecture;
use App\Repositories\LectureRepository;
use App\Services\SearchAndSort;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    protected $lectureRepository;

    public function __construct(LectureRepository $lectureRepository)
    {
        $this->lectureRepository = $lectureRepository;
    }

    public function index(SearchAndSort $searchAndSort, Request $request)
    {
        $lectures = $this->lectureRepository->index($searchAndSort, $request);
        return responseJson(200, 'success', $lectures);
    }

    public function store(StoreLectureRequest $request)
    {
        $lecture = $this->lectureRepository->store($request);
        return responseJson(200, 'Created successfully', $lecture);
    }

    public function update(UpdateLectureRequest $request, Lecture $lecture)
    {
        $this->lectureRepository->update($request, $lecture);
        return responseJson(200, 'Updated successfully', $lecture);
    }

    public function destroy(Lecture $lecture)
    {
        $this->lectureRepository->destroy($lecture);
        return responseJson(200, 'Deleted successfully', $lecture);
    }

    public function attachUser(UserRequest $request, Lecture $lecture)
    {
        $lecture->load('users');
        $this->lectureRepository->attachUser($lecture, $request);
        return responseJson(200, 'Attached successfully', $lecture);
    }
}
