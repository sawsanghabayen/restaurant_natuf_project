<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\OrderMeal;
use App\Models\Resturant;
use Illuminate\Http\Request;

class OrderMealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('user')->check() || auth('admin')->check() ){
                $resturants=Resturant::all();
                $latestmeals=Meal::orderBy('created_at','ASC')->take(6)->get();
                if($request->has('order_id')){
                $detailsorders = OrderMeal::with(['order' ,'meal'])->where('order_id','=',$request->input('order_id'))->get();
            return response()->view('front.detailsorder',['detailsorders'=>$detailsorders ,'latestmeals'=>$latestmeals ,'resturants'=>$resturants]);
        }
    }
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
     * @param  \App\Models\OrderMeal  $orderMeal
     * @return \Illuminate\Http\Response
     */
    public function show(OrderMeal $orderMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderMeal  $orderMeal
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderMeal $orderMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderMeal  $orderMeal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderMeal $orderMeal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderMeal  $orderMeal
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderMeal $orderMeal)
    {
        //
    }
}
