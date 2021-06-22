<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.Z
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'firstname' => $this->faker->name,
            'lastname' => $this->faker->name,
            'birthdate' =>  $this->faker->dateTimeBetween('1941-01-01', '2003-01-01'),
            'death_date' =>  $this->faker->randomElement([$this->faker->dateTimeBetween('2003-01-01', '2021-01-01'),null])
        ];
    }
}
