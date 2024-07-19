<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatCommentRequest;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CreatCommentRequest $request , Idea $idea){
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();
        $validated['idea_id'] = $idea->id;

        Comment::create( $validated );

        return redirect()->route("ideas.show", $idea->id)->with("success", 'Comment posted successfully');

    }
}
