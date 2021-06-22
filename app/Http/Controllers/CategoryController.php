<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return new CategoryCollection(Category::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        return Category::create($request->all());
    }

    public function show($Category)
    {
        return new CategoryResource(Category::find($Category)->setAttribute('go_back', env('APP_URL') . '' . request()->segments()[0] . '/' . request()->segments()[1]));
    }

    public function update(Request $request, Category $Category)
    {
        return Category::all()->find($Category)->update($request->except('_token'));
    }

    public function destroy($Category)
    {
        return Category::destroy($Category);
    }

}
