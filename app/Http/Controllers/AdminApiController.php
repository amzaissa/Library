<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminApiController extends Controller
{
   
public function index()
{
    $books = BookResource::collection(Book::all());
    $category = Category::all();
    return response()->json($books);
}
public function store(StoreBookRequest $request)
{
    $validatedData = $request->validated();
   
    // $validatedData = $request->validate([
    //     'name' => 'required|string',
    //     'auther_name' => 'required|string',
    //     'price' => 'required|numeric',
    //     'descreption' => 'required|string',
    //     'category_id' => 'required|exists:categories,id',
    // ]);

    Book::create([
        'name' => $validatedData['name'],
        'auther_name' => $validatedData['auther_name'],
        'price' => $validatedData['price'],
        'descreption' => $validatedData['descreption'],
        'category_id' => $validatedData['category_id'],
    ]);

    return response()->json('Book added successfully');
}
public function update(Request $request,$id)
{
    $validatedData = $request->validate([
        'name' => 'string',
        'auther_name' => 'string',
        'price' => 'numeric',
        'descreption' => 'string',
        'category_id' => 'exists:categories,id',
    ]);
    $book = Book::find($id);
    $book->update([
        'name' => $validatedData['name'],
        'auther_name' => $validatedData['auther_name'],
        'price' => $validatedData['price'],
        'descreption' => $validatedData['descreption'],
        'category_id' => $validatedData['category_id'],
    ]);
    return response()->json('book update successfuly');
}
public function delete(string $id)
{
    $book = Book::find($id);
    $book->delete();
    return response()->json('book delete successfully');
}
public function addCategory(Request $request)
{
   $validate= $request->validate([
        'name' => 'string'
    ]);
    Category::create([
        'name' => $validate['name']
    ]);
    return response()->json('category add successfully');
}
public function updateCategory(Request $request,string $id)
{
    $validate= $request->validate([
        'name' => 'string'
    ]);
    $category = Category::find($id);
    $category->update([
        'name' => $validate['name']
    ]);
    return response()->json('category update successfully');

}
public function deleteCategory(string $id)
{
    $category = Category::find($id);
    $category->delete();
    return response()->json('category delete successfully');
}

}
