<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function index($request);

    public function store($request);

    public function update($request, $user);

    public function destroy($user);

    public function attachLecture($user, $request);
}
