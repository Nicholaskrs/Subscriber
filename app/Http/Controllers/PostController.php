<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Jobs\SendingEmail;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:255',
            'content'=>'required|max:255',
            'website_id'=>'exists:websites,id'
        ]);

        $datas=$request->all();

        $post=new Post();
        $post->title=$datas["title"];
        $post->description=$datas["description"];
        $post->content=$datas["content"];
        $post->website_id=$datas["website_id"];
        $post->save();

        $subscribers=Subscriber::where('website_id',$datas['website_id'])->get();
        foreach ($subscribers as $subscriber){
            SendingEmail::dispatch($subscriber, $post);
        }

        return ResponseHelper::responseOK($post,201);
    }


    //
}
