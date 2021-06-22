<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'author_id'=> Author::all()->random()->id,
            'categories_id'=> Category::all()->random()->id,
            'publish_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['disponible','en_cours_d_appro','non_edite'])
        ];
    }
}
