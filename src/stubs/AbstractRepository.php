<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /** @var Model */
    protected $model;

    /**
     * Constructor
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find model by id
     *
     * @param number $id
     * @return Model|Collection|Builder|Builder[]
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }
}
