<?php

namespace App\Repositories;

use App\Models\DummyModel;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class DummyClass extends AbstractRepository
{
    public function all($search, $perPage = null)
    {
        $query = app(DummyModel::class)->newQuery();

        if ($search['term']) {
            $query->where('name', 'like', '%' . strtoupper($search['term']) . '%');
        }

        if ($perPage) {
            $query->paginate($perPage);
        }

        return $query->orderBy('id')->get();
    }

    public function find($id)
    {
        return DummyModel::find($id);
    }

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
