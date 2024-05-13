<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show book|show all categories', ['only' => ['index']]);
       
         $this->middleware('permission:add to favorite|rate book', ['only' => ['addToFavorites','rateBook']]);
    }
    public function index()
    {
        $books = Book::all();

        return response()->json(['books' => $books]);
    }
    
    public function filterByCategory(Request $request)
    {
        
        $category = Category::all();
        $book = Book::where('name','LIKE','%'.$request->search.'%')->
        orwhere('category_id','LIKE','%'.$request->search.'%')->get();
        return response()->json(['books' => $book]);
    //     $searchTerm = $request->search;

    // $books = Book::where('name', 'LIKE', "%$searchTerm%")
    //              ->orWhere('category_id', $searchTerm)
    //              ->get();

    // return response()->json(['books' => $books]);
    }

    public function addToFavorites(Request $request, Book $book)
    {
       
        $user = $request->user();
    
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
       
        if ($user->favoriteBooks()->where('book_id', $book->id)->exists()) {
            return response()->json(['message' => 'This book is already in your favorites']);
        }
    
        
        $user->favoriteBooks()->attach($book);
    
        return response()->json(['message' => 'Book added to favorites']);
    }
    public function rateBook(Request $request,Book $book)
    {
        $user = $request->user();
    
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if ($user->ratings()->where('book_id', $book->id)->exists()) {
            return response()->json(['message' => 'you alreading rate this book']);
        }
        $user->ratings()->create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'rate' => $request->rating,
        ]);
        return response()->json('you rate this book');

    }
}
