<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index(){
        return Book::all();
    }

    function show($id){
        return Book::find($id);
    }

    function store(Request $request){
        $request->validate([
            'title'=> 'required',
            'author'=> 'required',
            'price'=> ['required', 'numeric'],
        ]);

        return Book::create($request->all());
    }
    function update(Request $request, $id){
        $book= Book::find($id);
        $request->validate([
            'title'=> 'sometimes|required',
            'author'=> 'sometimes|required',
            'price'=> ['required', 'numeric', 'sometimes'],
        ]);
        $book->update($request->all());
        return  $book;
    }

    function destroy($id){
        return Book::destroy($id);
    }

    function search($title)
    {
       return Book::where('title','like','%'.$title.'%')->get();
    }

    function filter($author){
        return Book::where('author','like','%'.$author.'%')->get();
    }
}
