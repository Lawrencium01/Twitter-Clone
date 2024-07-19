<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IdeaController extends Controller
{
    use AuthorizesRequests;
    public function show(Idea $idea){
        return view('ideas.show', compact('idea'));
    }
    public function edit(Idea $idea){

        // if(auth()->user()->id !== $idea->user_id){
        //     abort(404);
        // }

        $this->authorize('update', $idea);

        $editing = true;
        return view('ideas.show', compact('idea','editing'));
    }
    public function update(UpdateIdeaRequest $request, Idea $idea){

        // if(auth()->user()->id !== $idea->user_id){
        //     abort(404);
        // }

        $this->authorize('update', $idea);

        $validated = $request->validated();
    
        $idea->update($validated);

        return redirect()->route('ideas.show',$idea->id)->with('success', 'Idea Updated successfully');
    }
    public function store(CreateIdeaRequest $request){

       $validated = $request->validated();

       $validated['user_id'] = auth()->user()->id;

       Idea::create($validated);

       return redirect()->route('dashboard')->with('success','Idea created successfully!');
    }

    public function destroy(Idea $idea){
        // if(auth()->user()->id !== $idea->user_id){
        //     abort(404);
        // }

        $this->authorize('delete', $idea);

        $idea->delete();
        return redirect()->route('dashboard')->with('success','Idea deleted successfully');
    }
}
