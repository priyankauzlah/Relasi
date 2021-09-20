<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment (Request $request, Post $post){
        $data = $request -> all();
        $comment = new Comment();
        $comment ->post_id = $post->id;
        $comment ->body = $data['body'];
        $comment ->save();
        $status = 'success create comment';
        return response()->json(compact('post', 'status'), 200);
    }

    public function updatePost(Request $request, Post $post)
    {
        $data = $request->all;
        if(isset($data['body']) && !empty($data['body'])){
            $post->body = $data['body'];
        }

        $post->save();
        $status = "success updating data post";
        return response()->json(compact('post', 'status'), 200);
    }

    public function updateComment(Request $request, Post $post, Comment $comment)
    {
        $comment->delete();
        $status = 'success delete comment';
        return response()->json(compact('status'), 200);
        
    }
}
