<?php
namespace App\Services;

class SearchAndSort
{
    public function execute($request, $model)
    {
        if (!empty($request['search']) && !empty($request['sort_by'])) {
            $data = $model::searchQuery($request['search'])->orderBy($request['sort_by']);
        } elseif (!empty($request['search'])) {
            $data = $model::searchQuery($request['search']);
        } elseif (!empty($request['sort_by'])) {
            $data = $model::orderBy($request['sort_by']);
        } else {
            $data = $model;
        }
        return $data->paginate(10);
    }
}
