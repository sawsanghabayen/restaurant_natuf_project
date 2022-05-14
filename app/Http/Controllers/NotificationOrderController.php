<?php

namespace App\Http\Controllers;

use App\Mail\notificationEmail;
use App\Mail\notificationMail;
use App\Models\Admin;
use App\Models\Notification;
// use App\Models\Notification;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification ;
// use Illuminate\Notifications\Notification ;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class NotificationOrderController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Notification::class, 'notification');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny' ,Notification::class);
        $notificationOrder=Auth()->user()->notifications()->where('type','=','App\Notifications\NewMessageNotification')->get();
        $notificationOrder->markAsRead();
        return response()->view('cms.notificationsorder',['notificationOrder'=>$notificationOrder]);
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
    public function store(Request $request )
    {
    
    }
    
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        // dd($id);
        $notificationsContact=Auth()->user()->notifications()->where('type','=','App\Notifications\NewMessageNotification')
        ->where('id' ,$id)->get();
        // dd($notifications);
        // $notifications=$request->user()->notifications()->get();
        $notificationsContact->markAsRead();
        return response()->view('cms.notifications',['notificationsContact'=>$notificationsContact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $notifications=request()->user()->notifications();
        $this->authorize('delete');
        $deleted = request()->user()->notifications()->where('id', '=', $id)->delete();
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'Message deleted successfully' : 'Message deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    }

   