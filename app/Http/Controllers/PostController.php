<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //Create post
    public function createPost(Request $request)
    {
        $data = $request->all();
        $post = new Post;
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->url_image = $data['url_image'];
        $post->save();
        $post->comment();
        $status = 'success creating data post';
        return response()->json(compact('post', 'status'), 200);
    }

    public function getPost(Post $post){
        $post->comment;
        return response()->json(compact('post', 'status'), 200);
    }

    public function updatePost(Request $request, Post $post)
    {
        $data = $request->all;
        if(isset($data['title']) && !empty($data['title'])){
            $post->title = $data['title'];
        }

        if(isset($data['description'])){
            $post->title = $data['description'];
        }

        if(isset($data['url_image']) && !empty($data['url_image'])){
            $post->url_image = $data['url_image'];
        }

        $post->save();
        $status = "success updating data post";
        return response()->json(compact('post', 'status'), 200);
    }

    public function deletePost(Post $post){
        $comments = $post -> comment();
        foreach($comments as $comment){
            Comment::find($comment->id)->delete();
        }
        $post->delete();
        $status = "success deleting post";
        return response()->json(compact('status'), 200);
    }
}