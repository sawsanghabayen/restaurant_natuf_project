<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject' => 'required|string|min:3',
            'message' => 'required|string|min:3',
   
        ]);

        if (!$validator->fails()) {
            $contact = new Contact();
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->subject =  $request->input('subject');
            $contact->mobile = $request->input('mobile');
            $contact->message = $request->input('message');

            $isSaved = $contact->save();
            if ($isSaved)
                // Mail::to('saw@gmail.com')->send(new ContactMail($contact));
                 return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
         }else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }
    //     // dd($request);
    //     $request->validate([
    //         'name' => 'required|string|min:3',
    //         'email' => 'required|email',
    //         'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
    //         'subject' => 'required|string|min:3',
    //         'message' => 'required|string|min:3',
    //       ]);
  
    //       $data = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile'=>$request->mobile,
    //         'subject' => $request->subject,
    //         'message' => $request->message,
    //       ];
  
    //       Mail::to('saw@gmail.com')->send(new ContactMail($data));
    //        session()->flash('message', 'Thank you for your contact');
         
      
    //       return redirect()->route('rest.home');
    //   }
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
