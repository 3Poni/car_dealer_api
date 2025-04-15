<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CreditProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Бренды и модели авто
        $brands = [
            'Toyota' => ['Corolla', 'Camry', 'RAV4'],
            'BMW' => ['X5', 'M3', '320i'],
            'Tesla' => ['Model S', 'Model 3', 'Model X'],
        ];

        foreach ($brands as $brandName => $models) {
            $brand = CarBrand::create(['name' => $brandName]);

            foreach ($models as $modelName) {
                $model = CarModel::create([
                    'name' => $modelName,
                    'brand_id' => $brand->id,
                ]);

                // Добавляем по машине на каждую модель
                Car::create([
                    'brand_id' => $brand->id,
                    'model_id' => $model->id,
                    'photo' => 'photos/' . strtolower(str_replace(' ', '_', $modelName)) . '.jpg',
                    'price' => rand(150000, 800000)
                ]);
            }
        }

        // Кредитные программы
        $credits = [
            ['title' => 'Стандартный кредит', 'interest_rate' => 10.50],
            ['title' => 'Льготная программа', 'interest_rate' => 7.25],
            ['title' => 'Семейный авто', 'interest_rate' => 6.00],
        ];

        foreach ($credits as $credit) {
            CreditProgram::create($credit);
        }
    }
}
