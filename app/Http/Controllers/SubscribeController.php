<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'website_id'=>'exists:websites,id'
        ]);

        $datas=$request->all();
        $subscriber=Subscriber::where('website_id',$datas['website_id'])->where('email',$datas['email'])->first();
        if($subscriber!==null){
            return ResponseHelper::responseDataAlreadyExists();
        }

        $post=new Subscriber();
        $post->email=$datas["email"];
        $post->website_id=$datas["website_id"];
        $post->save();

        return ResponseHelper::responseOK($post,201);
    }
}
