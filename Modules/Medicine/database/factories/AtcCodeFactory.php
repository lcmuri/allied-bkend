<?php

namespace Modules\Medicine\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AtcCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Medicine\Models\AtcCode::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

