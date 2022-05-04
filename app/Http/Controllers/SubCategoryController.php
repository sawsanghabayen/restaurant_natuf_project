<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Resturant;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(SubCategory::class, 'subcategory'
        , ['except' => [ 'index']]);
    }

    public function index(Request $request)
    {
        if (Auth::guard('admin')->check()){
        $subcategories = SubCategory::with('category')->withCount('meals')->get();
        if($request->has('category_id')){
            $subcategories =SubCategory::where('category_id','=',$request->input('category_id'))->get();
        }
        return response()->view('cms.subcategories.index', ['subcategories' => $subcategories]);
    }
    else{
        $resturants=Resturant::all();
        $subCategories = SubCategory::paginate();
        $latestmeals=Meal::orderBy('created_at','ASC')->take(6)->get();

       if($request->has('id')){
           $subCategories =SubCategory::where('category_id','=',$request->input('id'))->paginate(6,['*'],'subCategories');
       }
       return response()->view('front.subcategories', ['subCategories' => $subCategories ,'resturants'=>$resturants,'latestmeals'=>$latestmeals]);
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
        return response()->view('cms.subCategories.create',['categories' => $categories]);
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
            'category_id' => 'required|numeric|exists:categories,id',
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return response()->view('cms.subCategories.edit', ['categories' => $categories , 'subCategory' => $subCategory]);
        // dd($subCategory);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validator = Validator($request->all(), [
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {


            $subCategory->category_id= $request->input('category_id');
            $subCategory->title= $request->input('title');
            if ($request->hasFile('image')) {
                   //Delete category previous image.
                   Storage::delete($subCategory->image);
                   //Save new image.
                $file = $request->file('image');
                $imageName =  time().'_subcategories_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/subcategories', $imageName);
                $imagePath = 'images/subcategories/' . $imageName;
                $subCategory->image = $imagePath;
            
            $isSaved = $subCategory->update($request->all());
            if ($isSaved) return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $deleted = $subCategory->delete();
        if ($deleted) {
            Storage::delete($subCategory->image);
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

