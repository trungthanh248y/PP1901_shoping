<?php

namespace App\Repositories\Eloquents;

use App\Contracts\RepositoryInterface;

abstract class ElequentRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel();

    public function setModel()
    {
         $this->model=app()->make(
             $this->getModel()
         );//app()->make tạo ra
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->orderBy('id','desc')->get();
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $arr)
    {
        return $this->model->create($arr);
    }

    public function delete($id)
    {
        $temp = $this->find($id);
        if($temp)
        {
            $temp->delete();
            return true;
        }
        return false;
    }

    public function update($id, array $arr)
    {
        $temp=$this->find($id);
        if($temp)
        {
            $temp->update($arr);
            return $temp;
        }
        return false;
    }
}
