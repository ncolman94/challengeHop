<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get(int $id)
    {
        return $this->model->find($id);
    }


    public function save(Model $model)
    {
        $model->save();
        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
        return $model;
    }
}
