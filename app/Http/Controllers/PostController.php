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

    public function show($post)
    {
        // Ensure the post exists
        $res = Post::where('slug', $post)
                ->with('user', 'comments.user', 'category')
                ->first();

                $res->setAttribute('added_at',$res->created_at->diffForHumans());
                // $res->setAttribute('comments_count',$res->comments()->count());
                //$res->formattedComments($res->comments);
        // Check if the post was found
        if (!$res) {
            return response()->json(['message' => 'Post not found'], 404);
        }

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
