<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DummyModelRequest;
use App\Http\Resources\DummyModelResource;
use App\Repositories\DummyModelRepository;

class DummyClass extends Controller
{
    /** @var class $dummyModelRepository contains the REST methods of DummyModel */
    private $dummyModelRepository;

    /**
     * Constructor function
     *
     * DummyModelRepository $dummyModelRepository
     */
    public function __construct(DummyModelRepository $dummyModelRepository)
    {
        $this->dummyModelRepository = $dummyModelRepository;
    }

    /**
     * Retrieves paginated data
     *
     * @param Request $request
     * @return Collection[]
     * @throws \Exception
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', null);
            $search = ["term" => $request->query('term', null)];

            return DummyModelResource::collection($this->dummyModelRepository->all($search, $perPage));
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new DummyModel
     *
     * @param Request $request
     * @return DummyModel[]
     * @throws \Exception
     */
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

    /**
     * Retrieves a DummyModel
     *
     * @param number $id
     * @return DummyModel
     * @throws \Exception
     */
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

    /**
     * Updates a DummyModel
     *
     * @param DummyModelRequest $request
     * @param number $id
     * @return DummyModel
     * @throws \Exception
     */
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

    /**
     * Delete a DummyModel
     *
     * @param number $id
     * @return DummyModel
     * @throws \Exception
     */
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
