<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Resturant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Meal::class, 'meal'
        , ['except' => [ 'index']]);
    }
    public function index(Request $request)
    {
        if (Auth::guard('admin')->check()){
        $meals = Meal::with('subcategory')->get();
        if($request->has('sub_category_id')){
            $meals =Meal::where('sub_category_id','=',$request->input('sub_category_id'))->get();
        }
        return response()->view('cms.meals.index', ['meals' => $meals]);
    }
    else{
         //front
        $favorites=Favorite::all();
        $resturants=Resturant::all();
        $meals = Meal::orderBy('created_at','DESC')->paginate(9 ,['*'],'meals');
        // dd($meals);
         $latestmeals=Meal::orderBy('created_at','ASC')->take(6)->get();
         if($request->has('id')){
             $meals =Meal::where('sub_category_id','=',$request->input('id'))->paginate();
         }
        return response()->view('front.meals', ['meals' => $meals ,'favorites'=>$favorites,'resturants'=>$resturants,'latestmeals'=>$latestmeals ]);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Category::all();
        return response()->view('cms.meals.create',['categories' => $categories]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            'active' => 'required|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $meal = new Meal();
            $meal->sub_category_id= $request->input('sub_category_id');
            $meal->title= $request->input('title');
            $meal->description= $request->input('description');
            $meal->price= $request->input('price');
            $meal->active= $request->input('active');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName =  time().'_meal_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/meals', $imageName);
                $imagePath = 'images/meals/' . $imageName;
                $meal->image = $imagePath;
            }
            $isSaved = $meal->save();
            if ($isSaved) return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(meal $meal)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(meal $meal)
    {
        $subcategories = SubCategory::all();

        return response()->view('cms.meals.edit', ['meal' => $meal ,'subcategories'=>$subcategories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, meal $meal)
    {
        $validator = Validator($request->all(), [
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            'active' => 'required|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {


            $meal->sub_category_id= $request->input('sub_category_id');
            $meal->title= $request->input('title');
            $meal->description= $request->input('description');
            $meal->price= $request->input('price');
            $meal->active= $request->has('active');
            if ($request->hasFile('image')) {
                //Delete user previous image.
                Storage::delete($meal->image);
                //Save new image.
                $file = $request->file('image');
                //date_time_meal_image.extenssion
                $imageName = time(). '_meal_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/meals', $imageName);
                $imagePath = 'images/meals/' . $imageName;
                $meal->image = $imagePath;
            }
            
            $isSaved = $meal->save();
            if ($isSaved) return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(meal $meal)
    {
        $deleted = $meal->delete();
        if ($deleted) {
            Storage::delete($meal->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    }
