<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use function Laravel\Prompts\error;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $profile=Profile::all();
return response()->json([
$profile    ], 200);    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        //
   if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $validated=$request->validated();
        $validated['user_id']=Auth::id();

        if($request->hasFile('image')){
                        $path = $request->file('image')->store('profile_images', 'public');
                                    $validated['image'] = $path;
        }
        
           $profile=profile::create($validated);
           return response()->json([
            'message' => 'Profile created successfully',
            'data' => $profile
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile=Profile::where('user_id',$id)->firstOrFail();
                return response()->json($profile, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProfileRequest $request)
    {
        //
        if(!Auth::check()){
      return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $validated=$request->validated();
        $validated['user_id']=Auth::id();

         if($request->hasFile('image')){
         $path = $request->file('image')->store('profile_images', 'public');
         $validated['image'] = $path;

            }
        $profile = Profile::update($validated);
                return response()->json([
            'message' => 'Profile update successfully',
            'data' => $profile
        ], 201);
    


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $profile = Profile::findOrFail($id);
                $profile->delete();
       return response()->json(['message' => 'Profile deleted successfully'], 200);


    }

}