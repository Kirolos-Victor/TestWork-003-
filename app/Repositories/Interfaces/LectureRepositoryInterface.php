<?php
namespace App\Repositories\Interfaces;

interface LectureRepositoryInterface
{
    public function index($searchAndSort, $request);

    public function store($request);

    public function update($request, $user);

    public function destroy($user);

    public function attachUser($lecture, $request);
}
