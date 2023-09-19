<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    public function definition()
    {
        return [
            'id' => fake()->unique()->uuid(),
            'nama' => fake()->name(),
            'deskripsi' => fake()->realText(),
            'qty' => mt_rand(10, 100),
            'tgl_masuk' => fake()->date(),
        ];
    }
}
