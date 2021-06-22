<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Author $author, Category $category)
    {
        if ($author->id != null) {
            $Books = Book::with('author')->where('author_id', '=', $author->id)->get();
            return new BookCollection($Books);
        }elseif($category->id != null){
            $Books = Book::with('author')->where('categories_id', '=', $category->id)->get();
            return new BookCollection($Books);
        } else {
            $Books = Book::with('author')->get();
            return new BookCollection($Books);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author_id' => 'required',
            'categories_id' => 'required',
            'publish_date' => 'required|date',
            'status' => 'required'
        ]);

        $Books = Book::create($request->all());
        return new BookResource($Books);
    }

    public function show(Author $author, Category $category, Book $book)
    {
        if ($author->id != null) {
            $Books = Book::with('author')->where('author_id', '=', $author->id)->get()->find($book)->setAttribute('go_back', env('APP_URL') . '' . request()->segments()[0] . '/' . request()->segments()[1]);
            return new BookResource($Books);
        }elseif($category->id != null){
            $Books = Book::with('author')->where('categories_id', '=', $category->id)->get()->find($book)->setAttribute('go_back', env('APP_URL') . '' . request()->segments()[0] . '/' . request()->segments()[1]);
            return new BookResource($Books);
        } else {
            $Books = Book::with('author')->get()->find($book)->setAttribute('go_back', env('APP_URL') . '' . request()->segments()[0] . '/' . request()->segments()[1]);
            return new BookResource($Books);
        }
    }

    public function update(Request $request, Book $book)
    {
        Book::all()->find($book)->update($request->except('_token'));
        return new BookResource(Book::all()->find($book));
    }

    public function destroy($book)
    {
        return Book::destroy($book);
    }

}
