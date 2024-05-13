<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;

class BooksController extends Controller
{

    function __construct()
    {
       
         $this->middleware('permission:show all products|create product|edit product|delete product', ['only' => ['index','show']]);
         $this->middleware('permission:create product', ['only' => ['create','store']]);
         $this->middleware('permission:edit product', ['only' => ['edit','update']]);
         $this->middleware('permission:delete product', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
         
         
        $book = Book::all();
        return view('products/allProducts',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products/createProduct',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        Book::create([
            'name'        => $request->name,
            'category_id' => $request->category,
            'price'       => $request->price,
            'desc'        => $request->description,
        ]);

        return redirect()->route('products.index')->with('message','added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        return view('products/show_Product',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('products/editProduct',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {
        // dd($request);
        $validated = $request->validated();
        $product = Book::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->desc = $request->description;
        $product->category_id = $request->category;
        $product->save();
        return redirect()->route('products.index')->with('message','added successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Book::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('message','added successfully');

    }
}