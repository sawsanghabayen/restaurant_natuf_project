<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\favorite;
use App\Models\Meal;
use App\Models\resturant;
use Illuminate\Http\Request;

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
        $latestmeals=Meal::orderBy('created_at','ASC')->take(6)->get();
        $allcategories=Category::all();
        $categories=Category::paginate(6 ,['*'],'categories');
        $meals=Meal::paginate(6,['*'],'meals');
        $meals->when($name ,function($query , $name){
            return $query->where('name' ,'LIKE',"%{$name}%");
        });

        
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
        //
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
        //
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
