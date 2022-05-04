<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\favorite;
use App\Models\Meal;
use App\Models\Resturant;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //   $admins=Favorite::all();
      $users_count=User::count();
      $admins_count=Admin::count();
    //   $categories=Category::all();
    //   $subcategories=SubCategory::all();
      $meals=Meal::all();
      $favorites=Favorite::withcount('user')->get();
      $mealsname="[";
      $userfavmeal_count="[";
      foreach($favorites as $favorite) {
        $userfavmeal_count.="'".$favorite->user_count."',";
        $mealsname.="'".$favorite->meal->title."',";
       }
       $userfavmeal_count.="]";
       $mealsname.="]";
    //    dd($users);

         
      return response()->view('cms.index',['favorites'=>$favorites ,'meals'=>$meals,'mealsname'=>$mealsname,'userfavmeal_count'=>$userfavmeal_count ,'users_count'=>$users_count,'admins_count'=>$admins_count]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request);
        // $validator = Validator( ['meal_id' =>'required|numeric|exists:meals,id']);
        
        $validator = Validator($request->all(), [
            'meal_id' =>'required|numeric|exists:meals,id'

        ]);

        if (!$validator->fails()) {
            

            $meal = Meal::find($request->meal_id);
            if (!is_null($meal)) {
                if (!$request->user()->favorites()->where('meal_id', $meal->id)->exists()) {
                    $isSaved = $request->user()->meals()->save($meal);
                    if ($isSaved)
                    return response()->json(['message' => 'Meal favorite added']);
                } else {

                    $isSaved = $request->user()->meals()->detach($meal);
                    if ($isSaved)
                    return response()->json(['message' => 'Meal favorite deleted']);
                }
            } else {
                return response()->json(['message' => 'Meal Not Found']);
        }}
        else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }
    
    // public function saveFavorite(Request $request)
    // {
    //     // dd($request->user());
    //     $validator = Validator( 
    //         ['meal_id' =>'required|numeric|exists:meals,id']);

    //     if(!favorite::where(['user_id'=>$request->user()->id ,'meal_id'=>$request->meal_id])->exists()){

    //     if (!$validator->fails()) {
    //         $favorite = new favorite();
    //         $favorite->meal_id= $request->meal_id;
    //         $favorite->user_id= $request->user()->id;
    //         $isSaved = $favorite->save();
    //         if ($isSaved)
    //            return  redirect()->route('rest.home');
    //         // if ($isSaved)
    //         //     return response()->json([
    //         //     'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
    //         // ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
         
    //      else {
    //         return response()->json(
    //             ['message' => $validator->getMessageBag()->first()],
    //             Response::HTTP_BAD_REQUEST
    //         );
    //     }  
    // }
    // }
    // return response()->json(['message' =>'already exists']);
    // }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(favorite $favorite ,Request $request)
    {
    
    }
}
    
// }
