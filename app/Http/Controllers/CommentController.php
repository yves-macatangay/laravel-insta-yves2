<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id){
        $request->validate([
            'comment_body'.$post_id => 'required|max:150'
        ], 
        [
            'comment_body'.$post_id.'.required' => 'You cannot post a blank comment',
            //comment_body2.required | [input name].[rule]
            'comment_body'.$post_id.'.max' => 'Maximum of 150 characters only'
        ]);

        $this->comment->post_id = $post_id;
        $this->comment->user_id = Auth::user()->id;
        $this->comment->body = $request->input('comment_body'.$post_id);
        $this->comment->save();

        return redirect()->back(); // go back to previous page
    }

    public function destroy($id){
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
