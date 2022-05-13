<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Meal;
use App\Models\Resturant;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(auth('user')->check()){
            $resturants=Resturant::all();
            // $meals=Meal::all();
            $latestmeals=meal::orderBy('created_at','ASC')->take(6)->get();
            // $meals=$request->user()->meals->get();
            $carts=Cart::with('meal')->where('user_id' ,'=' ,$request->user()->id)->get();
            return response()->view('front.cart',['carts'=>$carts ,'resturants'=>$resturants ,'latestmeals'=>$latestmeals]);}
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
        
        $validator = Validator($request->all(), [
            'meal_id' =>'required|numeric|exists:meals,id',
            'price' => 'required',
            'quantity' => 'required|integer|between:1,100',
            

        ]);

        if (!$validator->fails()) {
            $meal = Meal::find($request->meal_id);
            if (!is_null($meal)) {
                if (!$request->user()->carts()->where('meal_id', $meal->id)->exists()) {
                    $cart = new Cart();
                    $cart->meal_id= $request->meal_id;
                    $cart->user_id= $request->user()->id;
                    $cart->price= $request->price;
                    $cart->quantity= $request->quantity;


                    $isSaved = $cart->save();
                    if ($isSaved)
                    return response()->json(['message' => 'Meal cart added']);
                
            } else {
                return response()->json(['message' => 'Meal Not Found']);
        }}
        else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
        }}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $validator = Validator($request->all(), [
            'quantity' => 'required|integer|between:1,100',
           
        ]);

        if (!$validator->fails()) {
        
            $cart->quantity = $request->input('quantity');

            $isSaved = $cart->save();
            return response()->json(
                ['message' => $isSaved ? 'quantity Updated successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Cart $cart)
    {
        $meal = $cart->meal;
        if (!is_null($meal)) {
    $deleted = $request->user()->mealscart()->detach($meal);
    return response()->json(
        [
            'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
            'text' => $deleted ? 'Category deleted successfully' : 'Category deleting failed!',
            'icon' => $deleted ? 'success' : 'error'
        ],
        $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
    
    );  
}}
    }

