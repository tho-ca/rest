<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DummyModelRequest;
use App\Http\Resources\DummyModelResource;
use App\Repositories\DummyModelRepository;

class DummyClass extends Controller
{
    private $dummyModelRepository;

    public function __construct(DummyModelRepository $dummyModelRepository)
    {
        $this->dummyModelRepository = $dummyModelRepository;
    }

    public function index(Request $request)
    {
        try {

            $per_page = $request->query('per_page', null);
            $search = ["term" => $request->query('term', null)];

            return DummyModelResource::collection($this->dummyModelRepository->all($search, $per_page));
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
            $model = $this->dummyModelRepository->save($request);

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
            $model = $this->dummyModelRepository->find($id);

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
            $model = $this->dummyModelRepository->save($request, $id);

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
            $model = $this->dummyModelRepository->delete($id);

            return new DummyModelResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }
}
