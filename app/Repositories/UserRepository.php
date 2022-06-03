<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\SearchAndSort;

class UserRepository implements UserRepositoryInterface
{
    protected $user;
    protected $searchAndSort;

    public function __construct(SearchAndSort $searchAndSort, User $user)
    {
        $this->user = $user;
        $this->searchAndSort = $searchAndSort;
    }

    public function index($request)
    {
        return $this->searchAndSort->execute($request, $this->user);
    }

    public function store($request)
    {
        return $this->user::create($request);
    }

    public function update($request, $user)
    {
        return $user->update($request);
    }

    public function destroy($user)
    {
        return $user->delete();
    }

    public function attachLecture($user, $request)
    {
        if (!$user->lectures()->where('lecture_id', $request['lecture_id'])->exists()) {
            return $user->lectures()->attach($request['lecture_id']);
        }
    }
}
