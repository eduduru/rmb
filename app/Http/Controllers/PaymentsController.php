<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;

use App\Models\Payments;
use App\Models\Rawlogs;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;



class PaymentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function transfers(Request $request)
    {
        try{

            $validator = Validator::make($request->all(), [
                'file' => 'required'

            ]);

            if ($validator->fails()) {
              
                return response()->json(['status' => false, 'message' => 'file is required'], 401);
            }
return $request['file'];
            $payments = Payments::create($request->all());
            $Rawlogs = Rawlogs::create(['title' => 'raw', 'request' => json_encode($request->all()), 'response' => 'inserted successfully']);

            $encryption_key = '8660281B6051D071D94B5B230549F9DC851566DC';

            // Crypt::setKey($encryption_key);

            // $encrypted_message =  Crypt::encrypt( $request['file'] );

            $gpg = new gnupg();
            $gpg -> addencryptkey("8660281B6051D071D94B5B230549F9DC851566DC");
            $enc = $gpg -> encrypt("just a test");


            return $enc;
           
            return [
                "status" => true,
                "data" => $payments
            ];

        } catch (RequestException $e) {
            report($e);
            return $e;
        }




    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $blogs
        ];
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
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog = Blog::create($request->all());
        return [
            "status" => 1,
            "data" => $blog
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return [
            "status" => 1,
            "data" =>$blog
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog->update($request->all());

        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog deleted successfully"
        ];
    }
}