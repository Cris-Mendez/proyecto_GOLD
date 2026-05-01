<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * El nombre del modelo asociado con el factory.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Definir el estado de los datos predeterminados del modelo.
     *
     * @return array
     */
    public function definition(): array
    {

    return [
        'nombre' => fake()->word(),
        'referencia' => fake()->unique()->bothify('REF-###'),
        'precio' => fake()->numberBetween(10000, 500000),
        'cantidad' => fake()->numberBetween(1, 100),
        'descripcion' => fake()->sentence(),
    ];
}
}
