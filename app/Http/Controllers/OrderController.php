<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderMeal;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->authorizeResource(Order::class, 'order');
    // }
    public function index(Request $request)
    {
        if(auth('user')->check()){
            // $meals=$request->user()->meals->get();
            $orders=order::where('user_id' ,'=' ,$request->user()->id)->get();
            return response()->view('front.order',['orders'=>$orders]);
    }
         else{
            $orders=order::with('user')->get();
            return response()->view('cms.orders.index',['orders'=>$orders]);
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
        $validator = Validator($request->all(), [
            'total' => 'required',
            // 'date' => 'required',
        ]);

        if (!$validator->fails()) {
            $order = new Order();
            $order->total = $request->total;
            // $order->address_id = $request->input('');
            $order->date = Carbon::now()->format('Y-m-d');
            $isSaved = $request->user()->orders()->save($order);
            if($isSaved)
            $admins=Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }

            $cartmeals=Cart::where('user_id' ,'=' , $request->user()->id)->get();
            // dd($cartmeals);
            foreach($cartmeals as $cartmeal){
                $order_meal = new OrderMeal();

                    $order_meal->order_id = $order->id;
                    $order_meal->meal_id = $cartmeal->meal_id;
                    $order_meal->quantity = $cartmeal->quantity;
                    $isSaved = $order_meal->save();
            }

            Cart::destroy($cartmeals);
            return response()->json(
                ['message' => $isSaved ? 'Order Saved successfully' : 'Order Save failed!'],
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
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->authorize('update' ,$order);
        $validator = Validator($request->all(), [
            'status'=>'required|in:Waitting,Processing,Delivered',

        ]);

        if (!$validator->fails()) {
            $order->status = $request->input('status');
         
            $isSaved = $order->save();
            return response()->json(
                ['message' => $isSaved ? 'Status Updated successfully' : 'Status Upadate failed!'],
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
