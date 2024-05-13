<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show all books|show all categories|show books of category', ['only' => ['browse','show','filterByCategory']]);
  
    }
    public function browse()
    {
        
        $books = Book::all();
        return response()->json(['books' => $books]);
    }
    public function show(string $id)
    {
        $book = Book::find($id);
        return response()->json(['book' => $book]);
    }

    public function filterByCategory(Request $request)
    {
        $category = Category::all();
        $book = Book::where('name','LIKE','%'.$request->search.'%')->
        orwhere('category_id','LIKE','%'.$request->search.'%')->get();
        return response()->json(['books' => $book]);
    }
}
