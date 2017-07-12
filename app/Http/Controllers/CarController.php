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

    public function index()
    {}

    public function show(int $id)
    {}
}
