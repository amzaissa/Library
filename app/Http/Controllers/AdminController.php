<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function __construct()
    {
       
         $this->middleware('permission:show all books|create book|edit book|delete book', ['only' => ['index','show']]);
         $this->middleware('permission:create book', ['only' => ['create','store']]);
         $this->middleware('permission:edit book', ['only' => ['edit','update']]);
         $this->middleware('permission:delete book', ['only' => ['destroy']]);
    }

    public function index() 
    {
     if(Auth::user()->role_name == ['admin']){
            
            $book = Book::all();
            $category = Category::all();
             return view('admin.index',compact('book','category'));
         }   
         return redirect()->route('home'); 
    }
    public function create()
    {
        $category = Category::all();
        $book = Book::all();
        return view('admin.Addbook',compact('book','category'));
    }

    public function store(Request $request)
    {
       
   
       $book= Book::create([
            'name'        => $request->name,
            'auther_name' =>$request->auther_name,
            'descreption'        => $request->descreption,
            'price'       => $request->price,
            'category_id' => $request->category,
        ]);
       
        return redirect()->route('dashboard.index');
    }
    public function show(string $id)
    {
        $book = Book::find($id);

        return view('admin.rate',compact('book'));
    }
    public function edit(string $id)
    {
        $book = Book::find($id);
        $category = Category::all();
        return view('admin.editBook',compact('book','category'));
    }
    public function update(UpdateBookRequest $request,string $id)
    {
        $validated = $request->validated();
        $book = Book::find($id);
       
        $book->update([
            'name' => $request->name??$request->name,
            'auther_name' => $request->auther_name??$request->auther_name,
            'price' => $request->price??$request->price,
            'descreption' => $request->descreption??$request->descreption,
            'category_id' => $request->category??$request->category
        ]);
        return redirect()->route('dashboard.index');
    }
    public function destroy(string $id)
    {
        $book = Book::find($id);
        
        $book->delete();
        return redirect()->route('dashboard.index');

    }
    public function rate(string $id)
    {
        $book = Book::find($id);
        return view('admin.rate',compact('book'));
    }
    public function addRate(Request $request,string $id)
    {
        $user = Auth::user();
        $book = Book::find($id);
        $rate = new Rate();
        $rate->create([
            'user_id'=> $user->id,
            'book_id'=>$book->id,
            'rate' => $request->rate,
        ]);
        return redirect()->route('dashboard.index');
    }
    

   
}
