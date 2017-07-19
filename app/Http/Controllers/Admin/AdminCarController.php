<?php
namespace App\Http\Controllers\Admin;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Contracts\CarRepositoryInterface;

/**
 * Class AdminCarController
 * @package App\Http\Controllers\ADmin
 */
class AdminCarController extends Controller
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
            $data[] = array_only($car->toArray(), $fields);
        }
        return response()->json($data);
    }

    /**
     * Store a newly created car in the repository
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $storeData = $request->only([
            'model',
            'year',
            'mileage',
            'registration_number',
            'color',
            'price',
        ]);
        $car = new Car($storeData);
        $newData = $this->carsRepository->store($car);

        return response()->json($newData);
    }

    /**
     * Get and show the full information about the car by its id
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
     * Update the specified car in the repository
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $storeData = $request->only([
            'model',
            'year',
            'mileage',
            'registration_number',
            'color',
            'price',
        ]);

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
     * Remove the specified car from the repository
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        $car = $this->carsRepository->getById($id);
        if ($car === null) {
            return response()->json([
                'message' => "The car with ID #$id doesn't exist",
            ], 404);
        }

        $this->carsRepository->delete($id);

        return response('Ok', 200);
    }
}
