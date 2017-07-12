<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Car;
use App\Repositories\Contracts\CarRepositoryInterface;

class CarController extends Controller
{
    /**
     * Cars repository
     * @var CarRepositoryInterface
     */
    protected $carsRepository;

    /**
     * @param CarRepositoryInterface $carsRepository
     */
    public function __construct(CarRepositoryInterface $carsRepository)
    {
        $this->carsRepository = $carsRepository;
    }

    /**
     * Get and show the list of all cars with certain data fields
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $fields = [
            'id',
            'model',
            'year',
            'color',
            'price',
        ];
        $data = [];

        foreach ($this->carsRepository->getAll() as $car) {
            $data[] = $car->toArray($fields);
        }
        return response()->json($data);
    }

    /**
     * Store a newly created car in repository
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $storeData = $request->toArray();
        $car = new Car($storeData);
        $newData = $this->carsRepository->store($car);

        return response()->json($newData);
    }

    /**
     * Get and show the detailed information about the car by its id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $car = $this->carsRepository->getById($id);

        if ($car === null) {
            return response()->json([
                'message' => "The car with ID #$id not found",
            ], 404);
        }
        return response()->json($car);
    }

    /**
     * Update the specified resource in storage
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $storeData = $request->toArray();
        $car = $this->carsRepository->getById($id);

        if ($car === null) {
            return response()->json([
                'message' => "The car with ID #$id not found",
            ], 404);
        }

        $car->fromArray($storeData);
        $data = $this->carsRepository->update($car);

        return response()->json($data);
    }

    /**
     * Remove the specified car from repository
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $oldCount = count($this->carsRepository->getAll());
        $newCount = count($this->carsRepository->delete($id));

        if ($newCount === $oldCount) {
            return response()->json([
                'message' => "The car with ID #$id doesn't exist",
            ], 404);
        }
        return response('Ok', 200);
    }
}
