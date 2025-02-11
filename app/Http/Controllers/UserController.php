<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view("users.show", compact("user","ideas"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {   
        $this->authorize('update',$user);

        $ideas = $user->ideas()->paginate(5);

        $editing  = true;
        return view("users.edit", compact("user","editing","ideas"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update',$user);
        $validated = $request->validated();

        if($request->has("image")){
            $imagePath = $request->file("image")->store('image','public');
            $validated['image'] = $imagePath;
        }

        Storage::disk('public')->delete($user->image);

        $user->update($validated );

        return redirect()->route("profile")->with("success","Profile Updated Successfully");
    }

    public function profile(){
        return $this->show(auth()->user());
    }

}
