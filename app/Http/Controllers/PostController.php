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
}
