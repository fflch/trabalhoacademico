<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
        $query = User::orderBy('name','asc');

        if($request->busca != null){
            $query->orWhere('codpes', "$request->busca");
            $query->orWhere('name', 'LIKE', "%$request->busca%");
            $query->orWhere('email', 'LIKE', "%$request->busca%");
        }
        $users = $query->paginate(50);
        if ($users->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $this->authorize('admin');
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $user->update($validated);
        return redirect("/users");
    }
}
