<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(): JsonResponse
    {
        $cars = Car::with('brand:id,name')
        ->get(['id', 'brand_id', 'photo', 'price']);

        $response = $cars->map(function ($car) {
            return [
                'id' => $car->id,
                'brand' => [
                    'id' => $car->brand->id,
                    'name' => $car->brand->name,
                ],
                'photo' => $car->photo,
                'price' => $car->price,
            ];
        });

        return response()->json($response);
    }

    public function show(int $id): JsonResponse
    {
        $car = Car::with(['brand:id,name', 'model:id,name'])
            ->select('id', 'brand_id', 'model_id', 'photo', 'price')
            ->find($id);

        if (!$car) {
            return response()->json([], 404);
        }

        return response()->json([
            'id' => $car->id,
            'brand' => [
                'id' => $car->brand->id,
                'name' => $car->brand->name,
            ],
            'model' => [
                'id' => $car->model->id,
                'name' => $car->model->name,
            ],
            'photo' => $car->photo,
            'price' => $car->price,
        ]);
    }
}
