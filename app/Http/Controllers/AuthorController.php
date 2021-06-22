<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::with('books')->get();
        return new AuthorCollection($authors);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'firstname' => 'required',
           'lastname' => 'required',
           'birthdate' => 'required|date'
        ]);

        $author = Author::create($request->all());
        return new AuthorResource($author);
    }

    public function show(Author $author)
    {
        $authors = Author::with('books')->get()->find($author)->setAttribute('go_back', env('APP_URL') . '' . request()->segments()[0] . '/' . request()->segments()[1]);
        return new AuthorResource($authors);
    }

    public function update(Request $request, Author $author)
    {
        Author::all()->find($author)->update($request->except('_token'));
        return new AuthorResource(Author::all()->find($author));
    }

    public function destroy($author)
    {
        return Author::destroy($author);
    }

}
