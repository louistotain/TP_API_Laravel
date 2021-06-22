<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return [
                'authors' => env('APP_URL') . 'api/authors',
                'books' => env('APP_URL') . 'api/books',
                'categories' => env('APP_URL') . 'api/categories',
            ];
        } else {
            abort('404');
        }
    }
}
