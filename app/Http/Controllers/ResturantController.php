<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\favorite;
use App\Models\Meal;
use App\Models\resturant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name=$request->query('name');
        $comments=Comment::all();
        $resturants=Resturant::all();
        $favorites=favorite::all();
        $latestmeals=Meal::orderBy('created_at','DESC')->take(6)->get();
        $allcategories=Category::all();
        $categories=Category::paginate(6 ,['*'],'categories');
        $meals=Meal::orderBy('created_at','DESC')->paginate(6,['*'],'meals');
  
        
        return response()->view('front.index',['allcategories'=>$allcategories,'resturants'=>$resturants,'comments'=>$comments ,'favorites'=>$favorites,'latestmeals'=>$latestmeals,'meals'=>$meals ,'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function show(resturant $resturant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function edit(resturant $resturant)
    {
        return response()->view('cms.editresturant',['resturant'=>$resturant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, resturant $resturant)
    {
        $validator = Validator($request->all(), [
            'rest_name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'telephone' => 'required',
            'mobile' => 'required|regex:/^\d{1,13}(\.\d{1,4})?$/',
            'email' =>  'required|email|unique:admins,email,'.$resturant->id,
            'address' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {


            $resturant->rest_name= $request->input('rest_name');
            $resturant->description= $request->input('description');
            $resturant->telephone= $request->input('telephone');
            $resturant->mobile= $request->input('mobile');
            $resturant->email= $request->input('email');
            $resturant->address= $request->input('address');
            if ($request->hasFile('image')) {
                //Delete user previous image.
                Storage::delete($resturant->image);
                //Save new image.
                $file = $request->file('image');
                //date_time_meal_image.extenssion
                $imageName = time(). '_resturant_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/resturant', $imageName);
                $imagePath = 'images/resturant/' . $imageName;
                $resturant->image = $imagePath;
            }
            
            $isSaved = $resturant->save();
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
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function destroy(resturant $resturant)
    {
        //
    }
}
