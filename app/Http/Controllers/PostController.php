<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts=Post::latest()->with('user')->get();
       foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
              $post->setAttribute('comments',$post->comments()->count());
        }



        return response()->json($posts);
    }

    public function show($post){
         $res=Post::where('slug',$post)->with('user','comments','category')->get();
    //    return $res;
        // return response()->json([
        //     'id'=>$post->id,
        //     'title'=>$post->title,
        //     'slug'=>$post->slug,
        //     'body'=>$post->body,
        //     'added_at'=>$post->created_at->diffForHumans(),
        //     'image'=>$post->image,
        //     'user'=>$post->user,
        //     'category'=>$post->category,
        //     'comments'=>$this->formattedComments($post->comments)
        // ]);
         return response()->json($res);
    }

    public function formattedComments($comments){
        $newComments=[];
        foreach($comments as $comment){
            array_push($newComments,[
                'id'=>$comment->id,
                'user'=>$comment->user->name,
                'body'=>$comment->body,
                'added_at'=>$comment->created_at->diffForHumans()
            ]);
        }
        return $newComments;

    }
}
