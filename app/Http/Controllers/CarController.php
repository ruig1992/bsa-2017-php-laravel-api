<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Helpers\CarDataHelper;
use App\Repositories\Contracts\CarRepositoryInterface;

class CarController extends Controller
{
    use CarDataHelper;

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
     * @return Response
     */
    public function index(): Response
    {
        $data = [];
        foreach ($this->carsRepository->getAll() as $car) {
            $data[] = $this->getDataByFields($car, [
                'id',
                'model',
                'color',
                'year',
                'price',
            ]);
        }
        return response()->json($data);
    }

    /**
     * Get and show the detailed information about the car by its id
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
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
