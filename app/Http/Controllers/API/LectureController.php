<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureIndexRequest;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\LectureResource;
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

    public function index(LectureIndexRequest $request)
    {
        $lectures = $this->lectureRepository->index($request->validated());
        return responseJson(200, 'success', $lectures);
    }

    public function store(StoreLectureRequest $request)
    {
        $lecture = $this->lectureRepository->store($request->validated());
        return responseJson(200, 'Created successfully', new LectureResource($lecture));
    }

    public function update(UpdateLectureRequest $request, Lecture $lecture)
    {
        $this->lectureRepository->update($request->validated(), $lecture);
        return responseJson(200, 'Updated successfully', new LectureResource($lecture));
    }

    public function destroy(Lecture $lecture)
    {
        $this->lectureRepository->destroy($lecture);
        return responseJson(200, 'Deleted successfully', new LectureResource($lecture));
    }

    public function attachUser(UserRequest $request, Lecture $lecture)
    {
        $this->lectureRepository->attachUser($lecture, $request->validated());
        return responseJson(200, 'Attached successfully', new LectureResource($lecture));
    }
}
