<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(1)->create();
        $user->first()->createToken('admin', ['read', 'update', 'create', 'delete'])->plainTextToken;
        $user->first()->createToken('editor', ['read', 'update', 'create'])->plainTextToken;

        Category::factory(4)->create();
        Author::factory(3)->create();
        Book::factory(9)->create();
    }
}
