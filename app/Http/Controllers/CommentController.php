<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentController extends Controller
{
    public function newComment(Request $request){
        try {
            Comments::create([
                'name' => $request->name,
                'comment' => $request->comment,
                'status' => 0
            ]);
            return json_encode(['status' => true, 'message' => 'Comment created']);
        } catch (\Throwable $th) {
            return json_encode(['status' => false, 'message' => 'Error creating comment']);
        }

    }

    public function getComments(){
        $comments = Comments::all();
        return json_encode($comments);
    }
}
