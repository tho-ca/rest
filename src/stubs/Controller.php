<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DummyModelRequest;
use App\Http\Resources\DummyModelResource;
use App\Repositories\DummyModelRepository;

class DummyClass extends Controller
{
    public function index(Request $request)
    {
        try {
            $values = new DummyModelRepository();

            $per_page = $request->query('per_page', null);
            $search = ["term" => $request->query('term', null)];

            return DummyModelResource::collection($values->all($search, $per_page));
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function store(DummyModelRequest $request)
    {
        try {
            $model = (new DummyModelRepository)->save($request);

            return response()->json(new DummyModelResource($model), 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $model = (new DummyModelRepository)->find($id);

            return new DummyModelResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function update(DummyModelRequest $request, $id)
    {
        try {
            $model = (new DummyModelRepository)->save($request, $id);

            return new DummyModelResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $model = (new DummyModelRepository)->delete($id);

            return new DummyModelResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }
}
