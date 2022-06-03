<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\SearchAndSort;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(UserIndexRequest $request)
    {
        $users = $this->userRepository->index($request->validated());
        return responseJson(200, 'success', $users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->store($request->validated());
        return responseJson(200, 'Created successfully', new UserResource($user));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($request->validated(), $user);
        return responseJson(200, 'Updated successfully', new UserResource($user));
    }

    public function destroy(User $user)
    {
        $this->userRepository->destroy($user);
        return responseJson(200, 'Deleted successfully', new UserResource($user));
    }

    public function attachLecture(LectureRequest $request, User $user)
    {
        $user->load('lectures');
        $this->userRepository->attachLecture($user, $request->validated());
        return responseJson(200, 'Attached successfully', new UserResource($user));
    }
}
