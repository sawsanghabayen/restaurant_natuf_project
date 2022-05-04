<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Resturant;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->authorizeResource(Category::class, 'category'
        , ['except' => [ 'index']]);
    }
    public function index()
    {
        if (Auth::guard('admin')->check()){
            $categories = Category::withcount('subcategories')->get();
         return response()->view('cms.categories.index', ['categories' => $categories]);}
         else{
            $resturants=Resturant::all();
            $latestmeals=Meal::orderBy('created_at','ASC')->take(6)->get();
            $categories = Category::paginate(6,['*'],'categories');
            return response()->view('front.categories', ['categories' => $categories ,'resturants'=>$resturants,'latestmeals'=>$latestmeals ]);
         }
    }

    // public function showSubCategories(Request $request , Category $category)
    // {
    //     $subcategories = Category::where('id',$category->id)->first()->subcategories;
    //     return response()->view('cms.subcategories.index', ['subcategories' => $subcategories]);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return response()->view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('create' ,Permission::class);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $category = new Category();
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName =  time().'_category_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/categories', $imageName);
                $imagePath = 'images/categories/' . $imageName;
                $category->image = $imagePath;
            }
            $isSaved = $category->save();
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // if (Auth::guard('admin')){
        // $subCategories =$category->subCategories;
        //     return response()->json(['message'=>'success' , 'data' => $subCategories]);}
        //     else{
        //         $subCategories =$category->subCategories;
        //             return response()->json(['message'=>'success' , 'data' => $subCategories]);
        //     }
       
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // $this->authorize('update' ,$category);
        return response()->view('cms.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // $this->authorize('update' ,$category);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            if ($request->hasFile('image')) {
                //Delete category previous image.
                Storage::delete($category->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time(). '_category_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/categories', $imageName);
                $imagePath = 'images/categories/' . $imageName;
                $category->image = $imagePath;
            }
            $isSaved = $category->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $deleted = $category->delete();
        if ($deleted) {
            Storage::delete($category->image);
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

