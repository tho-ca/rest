<?php

namespace App\Repositories;

use App\Models\DummyModel;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class DummyClass extends AbstractRepository
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(new DummyModel());
    }

    /**
     * Retrieves all DummyModel
     *
     * @param string $search
     * @param number $perPage defaults to null
     * @return Builder|Builder[]
     */
    public function all($search, $perPage = null)
    {
        $query = app(DummyModel::class)->newQuery();

        if ($search['term']) {
            $query->where('name', 'like', '%' . strtoupper($search['term']) . '%');
        }

        if ($perPage) {
            return $query->orderBy('id')->paginate($perPage);
        }

        return $query->orderBy('id')->get();
    }

    /**
     * Retrieves a specific DummyModel by ID
     *
     * @param number $id
     * @return DummyModel
     */
    public function find($id)
    {
        return DummyModel::find($id);
    }

    /**
     * Stores or update a DummyModel
     *
     * @param array $data
     * @param number $id defaults to null
     * @return DummyModel
     */
    public function save($data, $id = null)
    {
        DB::beginTransaction();
        try {
            $model = ($id) ? $this->find($id) : new DummyModel();

            $model->fill($data->all());

            $model->save();

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * Deletes a DummyModel
     *
     * @param number $id
     * @return DummyModel
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $model = $this->find($id);

            $model->delete();

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
}
