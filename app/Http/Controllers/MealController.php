<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::with('category')->get();
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
        return response()->view('cms.subcategories.create',['subcategories' => $subcategories]);
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
            'subcategory_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $subcategory = new SubCategory();
            $subcategory->category_id= $request->input('category_id');
            $subcategory->title= $request->input('title');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName =  time().'_category_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/subcategories', $imageName);
                $imagePath = 'images/subcategories/' . $imageName;
                $subcategory->image = $imagePath;
            }
            $isSaved = $subcategory->save();
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
