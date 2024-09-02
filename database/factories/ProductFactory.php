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
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
        ];
    }
}
