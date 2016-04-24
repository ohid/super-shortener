<?php

namespace SShortener\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SShortener\Http\Requests;
use SShortener\User;
use SShortener\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct() 
    {
        $this->user = Auth::user();
        $this->middleware('auth', ['only' => ['edit', 'update']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user;
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|max:20|min:4',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::find($id);

        if($user) :
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('password'));
            $user->save();
        else:
            return redirect('/');
        endif;
            return redirect()->route('user.edit')->with('message', 'Your profile has been updated');

    }

}
