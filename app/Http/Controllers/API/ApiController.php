<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\traits\apitrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    use apitrait;
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
       
         $this->middleware('permission:show all books|create book|edit book|delete book', ['only' => ['index','show']]);
         $this->middleware('permission:create book', ['only' => ['create','store']]);
         $this->middleware('permission:edit book', ['only' => ['edit','update']]);
         $this->middleware('permission:delete book', ['only' => ['destroy']]);
    }
    public function index(UserRequest $request)
    {
        $user = UserResource::collection(User::all());
        return response()->json($user,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = $request->validated();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->apiStore($user,'User added successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return $this->apiStore(new UserResource($user),'this is the user',200); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

     $user->update([
        'name' => $request->name??$request->name,
        'email' => $request->email??$request->email,
        'password' => Hash::make($request->password)??$request->password,

       ]);
       return response()->json($user);
       return $this->apiUpdate($user,'user updated successfully',200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
       $user->delete($id);
       return $this->apiDelete($user,'user deleted sucessfully',200);
    }
}
