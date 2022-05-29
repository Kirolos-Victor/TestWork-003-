<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index($searchAndSort, $request)
    {
        return $searchAndSort->execute($request, $this->user);
    }

    public function store($request)
    {
        return $this->user::create($request->validated());
    }

    public function update($request, $user)
    {
        return $user->update($request->validated());
    }

    public function destroy($user)
    {
        return $user->delete();
    }

    public function attachLecture($user, $request)
    {
        if (!$user->lectures()->where('lecture_id', '=', $request->lecture_id)->exists()) {
            return $user->lectures()->attach($request->lecture_id);
        }
    }
}
