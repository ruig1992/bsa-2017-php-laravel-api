<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\Contracts\CarRepositoryInterface;

/**
 * Class CarController
 * @package App\Http\Controllers
 */
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
            $data[] = array_only($car->toArray(), $fields);
        }
        return response()->json($data);
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
}
