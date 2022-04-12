<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\SubCategory;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::with('subcategory')->get();
        return response()->view('cms.meals.index', ['meals' => $meals]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories=SubCategory::all();
        return response()->view('cms.meals.create',['subcategories' => $subcategories]);
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
            'active' => 'nullable|string|in:on',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(meal $meal)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(meal $meal)
    {
        //
    }
}
